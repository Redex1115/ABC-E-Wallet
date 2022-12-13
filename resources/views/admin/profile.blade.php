@extends('layouts.admin')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    {{QrCode::generate($user -> account_id)}}
                    <h4 class="card-title m-t-10">{{$user -> loginID}}</h4>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4">
                            <a href="#" class="link">
                                <font class="font-medium">Account Balance {{number_format($user -> balance/100,2)}}</font>
                            </a>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Tab panes -->
            <div class="card-body">
                <form action="{{ url('update/profile') }}" class="form-horizontal form-material" method="POST">
                    @csrf
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Account ID</label>
                                <input type="text" value="{{$user -> account_id}}" class="form-control form-control-line" name="accID" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{$user -> loginID}}" class="form-control form-control-line" name="loginID" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{$user -> email}}" class="form-control form-control-line" name="email" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone No</label>
                                <input type="text" value="{{$user -> hpNo}}" class="form-control form-control-line" name="hpNo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IC No</label>
                                <input type="text" value="{{$user -> ic}}" class="form-control form-control-line" name="ic">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Address</label>
                        <div class="col-md-12">
                            <input type="text" value="{{$user -> address}}" class="form-control form-control-line" name="address">
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Remark</label>
                                <input type="text" value="{{$user -> remark}}" class="form-control form-control-line" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" value="{{$user -> status}}" class="form-control form-control-line" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection