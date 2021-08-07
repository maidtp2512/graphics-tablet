@extends('layouts.master')
@section('title', 'Graphics Tablet - Home')

@section('client')

<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="{{URL::asset('img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{ $blog->title }}</h2>
                    <ul>
                        <li>By Michael Scofield</li>
                        <li>{{ $blog->created_at }}</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Tìm kiếm...">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    </div>
                <div class="blog__sidebar__item">
                    <h4>Bài viết mới</h4>
                    @foreach($blogs_other as $other)
                    <div class="blog__sidebar__recent pt-3">
                        <a href="/post/<?=$other->id?>" class="blog__sidebar__recent__item">
                            <div class="blog__sidebar__recent__item__pic">
                                <img src="{{URL::asset('upload/blogs/'.$other->image)}}" alt="" width="150px">
                            </div>
                            <div class="blog__sidebar__recent__item__text">
                                <h6>{{ $other->title }}</h6>
                                <span>{{ $other->created_at }}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="blog__sidebar__item">
                    <h4>Tags</h4>
                    <div class="blog__sidebar__item__tags">
                        <a href="#">Intuos</a>
                        <a href="#">Intuos Pro</a>
                        <a href="#">Cintiq & One</a>
                        <a href="#">Cintiq Pro</a>
                        <a href="#">MobileStudio Pro</a>
                        <a href="#">SmartPads</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <img src="{{URL::asset('upload/blogs/'.$blog->image)}}">
                    {!! $blog->content !!}
                </div>
                <div class="blog__details__content">
                    <div class="row">
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="blog__details__author">--}}
{{--                                <div class="blog__details__author__pic">--}}
{{--                                    <img src="img/blog/details/details-author.jpg" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="blog__details__author__text">--}}
{{--                                    <h6>Michael Scofield</h6>--}}
{{--                                    <span>Admin</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-12">
{{--                            <div class="blog__details__widget">--}}
{{--                                <ul>--}}
{{--                                    <li><span>Categories:</span> Food</li>--}}
{{--                                    <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>--}}
{{--                                </ul>--}}
{{--                                <div class="blog__details__social">--}}
{{--                                    <a href="#"><i class="fa fa-facebook"></i></a>--}}
{{--                                    <a href="#"><i class="fa fa-twitter"></i></a>--}}
{{--                                    <a href="#"><i class="fa fa-google-plus"></i></a>--}}
{{--                                    <a href="#"><i class="fa fa-linkedin"></i></a>--}}
{{--                                    <a href="#"><i class="fa fa-envelope"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="node-news-full-facebook-like">--}}
{{--                                <div class="node-news-full-facebook-like-container">--}}
{{--                                    <div--}}
{{--                                        class="node-news-full-facebook-like-container-inner">--}}
{{--                                        <div id="fb-root"></div>--}}
{{--                                        <div class="fb-like fb_iframe_widget"--}}
{{--                                             data-href=""--}}
{{--                                             data-layout="button_count"--}}
{{--                                             data-action="like" data-size="small"--}}
{{--                                             data-show-faces="true" data-share="true"--}}
{{--                                             fb-xfbml-state="rendered"--}}
{{--                                             fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=870&amp;href=https%3A%2F%2Ftugia.vn%2Fnode%2F281&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=small">--}}
{{--                                                                    <span--}}
{{--                                                                        style="vertical-align: bottom; width: 150px; height: 28px;"><iframe--}}
{{--                                                                            name="f299410e1a43518"--}}
{{--                                                                            width="1000px" height="1000px"--}}
{{--                                                                            data-testid="fb:like Facebook Social Plugin"--}}
{{--                                                                            title="fb:like Facebook Social Plugin"--}}
{{--                                                                            frameborder="0"--}}
{{--                                                                            allowtransparency="true"--}}
{{--                                                                            allowfullscreen="true"--}}
{{--                                                                            scrolling="no"--}}
{{--                                                                            allow="encrypted-media"--}}
{{--                                                                            src="https://www.facebook.com/v4.0/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df374c0413ed521%26domain%3Dtugia.vn%26origin%3Dhttps%253A%252F%252Ftugia.vn%252Ff10b0b09d60afec%26relation%3Dparent.parent&amp;container_width=870&amp;href=https%3A%2F%2Ftugia.vn%2Fnode%2F281&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=small"--}}
{{--                                                                            style="border: none; visibility: visible; width: 150px; height: 28px;"--}}
{{--                                                                            __idm_frm__="643" class=""></iframe></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="node-news-full-comment">--}}
{{--                                <div class="node-news-full-comment-container">--}}
{{--                                    <div class="node-news-full-comment-container-inner">--}}
{{--                                        <div id="fb-root"></div>--}}
{{--                                        <div--}}
{{--                                            class="fb-comments uk-visible-large fb_iframe_widget fb_iframe_widget_fluid_desktop"--}}
{{--                                            data-href=""--}}
{{--                                            data-width="100%" data-numposts="1"--}}
{{--                                            fb-xfbml-state="rendered"--}}
{{--                                            fb-iframe-plugin-query="app_id=&amp;container_width=870&amp;height=100&amp;href=https%3A%2F%2Ftugia.vn%2Fnode%2F281&amp;locale=en_US&amp;numposts=1&amp;sdk=joey&amp;version=v4.0&amp;width="--}}
{{--                                            style="width: 100%;"><span--}}
{{--                                                style="vertical-align: bottom; width: 100%; height: 204px;"><iframe--}}
{{--                                                    name="f363d6e065b36d8"--}}
{{--                                                    width="1000px" height="100px"--}}
{{--                                                    data-testid="fb:comments Facebook Social Plugin"--}}
{{--                                                    title="fb:comments Facebook Social Plugin"--}}
{{--                                                    frameborder="0"--}}
{{--                                                    allowtransparency="true"--}}
{{--                                                    allowfullscreen="true"--}}
{{--                                                    scrolling="no"--}}
{{--                                                    allow="encrypted-media"--}}
{{--                                                    src="https://www.facebook.com/v4.0/plugins/comments.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df1c84ff04b9c92%26domain%3Dtugia.vn%26origin%3Dhttps%253A%252F%252Ftugia.vn%252Ff10b0b09d60afec%26relation%3Dparent.parent&amp;container_width=870&amp;height=100&amp;href=https%3A%2F%2Ftugia.vn%2Fnode%2F281&amp;locale=en_US&amp;numposts=1&amp;sdk=joey&amp;version=v4.0&amp;width="--}}
{{--                                                    style="border: none; visibility: visible; width: 100%; height: 204px;"--}}
{{--                                                    __idm_frm__="644" class=""></iframe></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->


@stop
