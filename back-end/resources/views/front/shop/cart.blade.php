@extends('front.layout.master')
@section('title','Cart')

@section('body')
    @if(Cart::count())
        <!-- Breadcrumb Section Begin -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <a href="index.html"><i class="fa-fa-home"></i>Home</a>
                            <a href="shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End -->

        <!-- Shopping Cart  Section Begin -->
        <div class="shopping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"
                                           onclick="confirm('Are you sure to delete all carts?') == true ? destroyCart():''"
                                           style="cursor: pointer"
                                        ></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                    <tr>
                                        <td class="cart-pic first-row"><img src="front/img/products/{{$cart->options->images[0]->path}}" alt=""></td>
                                        <td class="cart-title first-row">
                                            <h5>{{$cart->name}}</h5>
                                        </td>
                                        <td class="p-price first-row">${{$cart->price}}</td>
                                        <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{$cart->qty}}" data-rowid="{{$cart->rowId}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-price first-row">${{$cart->total}}</td>
                                        <td class="close-td first-row"><i onclick="confirm('Are you sure?') ==true ? window.location='./cart/delete/{{$cart->rowId}}':''" class="ti-close"></i></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="cart-buttons">
                                    <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                    <a href="#" class="primary-btn up-cart">Update cart</a>
                                </div>
                                <div class="discount-coupon">
                                    <h6>Discount Codes</h6>
                                    <form action="#" class="coupon-form">
                                        <input type="text" placeholder="Enter your codes">
                                        <button type="submit" class="site-btn coupon-btn">Apply</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-4">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="subtotal">Subtotal <span>${{$total}}</span></li>
                                        <li class="cart-total">Total <span>${{$subtotal}}</span></li>
                                    </ul>
                                    <a href="./checkout" class="proceed-btn">PROCEED TO CHECK OUT</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->
    @else
        <div class="container">
            <div class="row">

                <p style="font-size: 28px;padding: 40px 0">Your cart is empty.</p>
            </div>
        </div>
    @endif


@endsection
