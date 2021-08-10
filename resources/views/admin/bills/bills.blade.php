@extends('layouts.admin')
@section('title', 'Danh sách hóa đơn | Admin - Graphics Tablet')
@section('content')
    <!-- Static Table Start -->
    <div class="data-table-area mg-tb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Danh sách hóa đơn</h1>
                            </div>
                        </div>
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <div id="toolbar">
                                    <select class="form-control">
                                        <option value="">Xuất dữ liệu</option>
                                        <option value="all">Xuất tất cả</option>
                                        <option value="selected">Xuất theo tùy chọn</option>
                                    </select>
                                </div>
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                       data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id">ID</th>
                                        <th data-field="name" data-editable="true">Tên khách hàng</th>
                                        <th data-field="total" data-editable="true">Tổng tiền</th>
                                        <th data-field="date" data-editable="true">Ngày đặt hàng</th>
                                        <th data-field="count" data-editable="true">Số lượng sản phẩm</th>
{{--                                        <th data-field="date" data-editable="true">Ngày thanh toán</th>--}}
{{--                                        <th data-field="payment" data-editable="true">Phương thức thanh toán</th>--}}
                                        <th data-field="availability" data-editable="true">Trang thái thanh toán</th>
                                        <th data-field="availability" data-editable="true">Trang thái giao hàng</th>
                                        <th data-field="action"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($bills as $bill)
                                    <tr>
                                        <td></td>
                                        <td>{{$bill->id}}</td>
                                        <td>{{$bill->name}}</td>
                                        <td>{{ number_format($bill->total,3,".",".") }} đ</td>
                                        <td>{{$bill->created_at}}</td>
                                        <td>{{$bill->count}}</td>
                                        <td>{{$bill->payment_status}}</td>
                                        <td>{{$bill->delivery_status}}</td>
                                        <td>
                                            <a href="/admin/bills/detail" class="btn btn-primary">
                                                <i class="fa fa-info-circle text-white" aria-hidden="true"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <a href="/admin/bills/edit" class="btn btn-success">
                                                <i class="fa fa-pencil-square-o text-white" aria-hidden="true"></i>
                                            </a>
                                            <a href="" class="btn btn btn-danger">
                                                <i class="fa fa-trash-o text-white" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Static Table End -->
@stop
