{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('layouts.layout1')
@section('title', 'Graphics Tablet - Home')
@section('hero')
    <div class="hero__item set-bg" data-setbg="img/banner/banner.jpg">
        <div class="hero__text">
            <a href="#" class="primary-btn">MUA NGAY</a>
        </div>
    </div>
@stop
@section('client')
    <!-- Featured Section Begin -->
    <section class="featured spad pt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                    {{--                    <div class="featured__controls">--}}
                    {{--                        <ul>--}}
                    {{--                            <li class="active" data-filter="*">Tất cả</li>--}}
                    {{--                            <li data-filter=".oranges">Bamboo</li>--}}
                    {{--                            <li data-filter=".fresh-meat">Intuos</li>--}}
                    {{--                            <li data-filter=".vegetables">Cintiq</li>--}}
                    {{--                            <li data-filter=".fastfood">Mobilestudio Pro</li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($product_outstanding as $outstanding)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{URL::asset('/upload/products/'.$outstanding->image)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="/product/<?=$outstanding->id?>">{{ $outstanding->name }}</a></h6>
                            <h5>{{ number_format($outstanding->price, 3, ".", "") }} ₫</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
    <!-- Banner Begin -->
    <div class="banner mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Categories Section Begin -->
    <section class="categories mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm khuyến mãi</h2>
                    </div>
                </div>
                <div class="categories__slider owl-carousel">
                    @foreach($product_discount as $discount)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="product__discount__item__pic set-bg"
                                 data-setbg="{{URL::asset('/upload/products/'.$discount->image)}}">
                                <div class="product__discount__percent">-{{ $discount->discount }}%</div>
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                {{--                                        <span>Dried Fruit</span>--}}
                                <h5><a href="/product/<?=$discount->id?>">{{ $discount->name }}</a></h5>
                                <div class="product__item__price">$30.00 ₫<span>{{ $discount->price }} ₫</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
    <!-- Blog Section Begin -->
    <section class="from-blog spad pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Bài viết mới nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{URL::asset('/upload/blogs/'.$blog->image)}}" alt="" class="img-object-fit">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at }}</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="/post/<?=$blog->id?>">{{ $blog->title }}</a></h5>
                            {!! Illuminate\Support\Str::limit($blog->content, 100, $end='...') !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@stop



