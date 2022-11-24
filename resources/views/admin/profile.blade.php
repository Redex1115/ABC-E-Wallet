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
                <center class="m-t-30"> <img src="{{asset('images/Adminprofile.jpg')}}" class="img-circle"
                        width="150" height="125"/>
                    <h4 class="card-title m-t-10">Hanna Gover</h4>
                    <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                    class="icon-people"></i>
                                <font class="font-medium">254</font>
                            </a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                    class="icon-picture"></i>
                                <font class="font-medium">54</font>
                            </a></div>
                    </div>
                </center>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    {{QrCode::generate('aaa')}}
                    <i class="bi bi-arrow-down-right-circle-fill"></i>
                    <h4 class="card-title m-t-10">Your User QrCode</h4>
                </center>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Tab panes -->
            <div class="card-body">
                <form class="form-horizontal form-material" method="POST">
                    <div class="form-group">
                        <label class="col-md-12">Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Nick Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="Redex_1115" class="form-control form-control-line" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone No</label>
                                <input type="text" placeholder="111111111" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IC No</label>
                                <input type="text" placeholder="11111-11-1111" class="form-control form-control-line">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Address</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="12,Taman ABC,Skudai,81300,Johor" class="form-control form-control-line">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-12">Select Country</label>
                        <div class="col-sm-12">
                            <select class="form-control form-control-line">
                                <option>London</option>
                                <option>India</option>
                                <option>Usa</option>
                                <option>Canada</option>
                                <option>Thailand</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection