<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    private $orderService;
    private $oderDetailService;
    public function __construct(OrderRepositoryInterface $orderRepository, OrderDetailRepositoryInterface $oderDetailService)
    {
        $this->orderService = $orderRepository;
        $this->oderDetailService = $oderDetailService;
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request)
    {
        //Thêm đơn hàng
        $order = $this->orderService->create($request->all());
        //Thêm chi tiết đơn hàng
        $carts = Cart::content();

        if ($request->payment_type == 'pay_later') {

            foreach ($carts as $cart) {
                $data = [
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'qty' => $cart->qty,
                    'amount' => $cart->price,
                    'total' => $cart->price * $cart->qty
                ];
                $this->oderDetailService->create($data);
            }
            //Gửi email
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendMail($order, $total, $subtotal);

            //Xóa giỏ hàng
            Cart::destroy();
            //Trả về kết quả
            return redirect('checkout/result')->with('notification', 'Đơn hàng đã đặt thành công.Vui lòng kiểm tra mail để biết thêm chi tiết!');
        }

        if ($request->payment_type == 'online_payment') {
            //Lấy URL thanh toán VNpay
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Thanh toán nhanh...',
                'vnp_Amount' => Cart::total(0, '', '') * 23123
            ]);
            return redirect()->to($data_url);
        }
    }

    private function sendMail($order, $total, $subtotal)
    {
        $email_to = $order->email;
        Mail::send('front.checkout.email', compact('order', 'subtotal', 'total'), function ($message) use ($email_to) {
            $message->from('vuvietquyacn@gmail.com', 'Vũ Viết Quý');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }

    public function vnPayCheck(Request $request)
    {
        //01 lấy data từ URL do VNPay gửi về
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vpn_Amount = $request->get('vpn_Amount');
        //02 Kiểm tra giao dịch
        if ($vnp_ResponseCode != null) {
            if ($vnp_ResponseCode == 00) {
                //Gửi mail
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $order = Order::find($vnp_TxnRef);
                $this->sendMail($order, $total, $subtotal);
                //Xóa giỏ hàng
                Cart::destroy();
                //Thông báo kết quả
                return "Thành công";
            } else {
                Order::find($vnp_TxnRef)->delete();
                return redirect('checkout/result')->with('notification', 'Lỗi thanh toán');
            }
        }
    }

    public function result()
    {
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }
}
