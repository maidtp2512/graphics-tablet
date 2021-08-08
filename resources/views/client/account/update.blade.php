@extends('layouts.master')
@section('title', 'Graphics Tablet - Home')

@section('client')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{URL::asset('img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Cập nhật tài khoản</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <a href="/user/profile/<?=$user->id?>">Tài khoản</a>
                            <span>Cập nhật tài khoản</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    @if(Auth::user())
        <div class="container bootstrap snippets bootdey mb-5">
            <div class="row">
                <div class="profile-nav col-md-3">
                    <div class="panel">
                        <div class="user-heading round">
                            <a href="#">
                                <img src="{{URL::asset('/upload/users/'.$user->avatar)}}" alt="">
                            </a>
                            <h1 class="text-white font-weight-bold pt-2">{{ $user->name }}</h1>
                            <p class="text-white">{{ $user->email }}</p>
                        </div>
                        <ul class="nav-pills nav-stacked">
                            <li><a href="/user/profile/<?=$user->id?>"> <i class="fa fa-user text-danger"></i> Tài khoản</a></li>
                            <li  class="active"><a href="/user/profile/edit/<?=$user->id?>"> <i class="fa fa-edit text-danger"></i> Cập nhật tài khoản</a></li>
                            <li><a href="/user/profile/change-pass/<?=$user->id?>"> <i class="fa fa-unlock-alt text-danger" aria-hidden="true"></i> Đổi mật khẩu</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off text-danger" aria-hidden="true"></i>
                                    {{ __('Đăng xuất') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </ul>
                    </div>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="bio-graph-heading">
                            {{ $user->name }} thân mến. Mình chỉ muốn cảm ơn bạn bởi bạn là khách hàng quan trọng của chúng tôi. Nếu bạn có bất cứ điều gì hãy cho chúng tôi biết, chúng tôi sẽ cố gắng để đáp ứng nhu cầu của bạn.
                        </div>
                        <div class="panel-body bio-graph-info pl-3 pr-3">
                            <h1 class="mt-4 pl-2" style="border-left: 5px solid #E53935;">CẬP NHẬT TÀI KHOẢN</h1>
                            <div class="contact-form pt-0 pb-2">
                                <div class="container">
                                    <form action="/user/profile/update-profile/<?=$user->id?>" class="form-update-account" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 update-account-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?=$user->username?>" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 update-account-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Tên</span>
                                                    </div>
                                                    <input type="text" class="form-control"  value="<?=$user->name?>"  name="name" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 update-account-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?=$user->email?>" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 update-account-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?=$user->phone?>" name="phone" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 update-account-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?=$user->address?>" name="address" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 update-account-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?=$user->created_at?>" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <button type="submit" class="site-btn">CẬP NHẬT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop
