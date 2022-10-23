<div class="product-item item {{$product->tag}}">
    <div class="pi-pic">
        <img src="front/img/products/{{$product->productImages[0]->path}}" alt="">
        @if($product->discount!=null)
            <div class="sale pp-sale">Sale</div>
        @endif

        <div class="icon">
            <i class="icon_heart_alt"></i>
        </div>
        <ul>
            <li class="w-icon active"><a href="./cart/add/{{$product->id}}"><i class="icon_bag_alt"></i></a></li>
            <li class="quick-view"><a href="shop/product/{{$product->id}}">+ Quick View</a></li>
            <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
        </ul>
    </div>
    <div class="pi-text">
        <div class="catagory-name">{{$product->productCategory->name}}</div>
        <a href="shop/product/{{$product->id}}">
            <h5>{{$product->name}}</h5>
        </a>
        <div class="product-price">
            ${{$product->discount}}
            <span>${{$product->price}}</span>
        </div>
    </div>
</div>
