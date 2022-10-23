@extends('front.layout.master')
@section('title','Result')

@section('body')
    <div class="container">
        <div class="row">
            <p style="font-size: 28px;padding: 40px 0">{{$notification}}</p>
            <a href="./shop">Continue Shopping</a>
        </div>
    </div>
@endsection
