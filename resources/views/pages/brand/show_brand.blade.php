@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach($brand_by_name as $key => $br_n)
    <h2 class="title text-center">{{ $br_n->brand_name }}</h2>
    @endforeach
    @foreach($brand_by_id as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" width="84" height="250" alt="" />
                    <h2>{{ number_format($product->product_price).' '.'VND' }}</h2>
                    <p>{{ $product->product_name }}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{ number_format($product->product_price).' '.'VND' }}</h2>
                        <p>{{ $product->product_name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" 
                        class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>Details</a>
                    </div>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--features_items-->   
@endsection