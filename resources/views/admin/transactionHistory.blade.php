@extends('layouts.admin')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Transaction History</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Transaction History</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h4 class="card-title">Transaction History</h4>
                    </div>
                    <div class="ml-auto">
                        <select class="custom-select b-0">
                            <option value="1">Withdraw</option>
                            <option value="2" selected="">Deposit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Type</th>
                            <th>Price (RM)</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop -> iteration}}</td>
                                <td>{{$user -> holderName}}</td>
                                <td>{{$user -> tType}}</td>
                                @if($user -> tAmount < 0 )
                                    <td><span class="text-danger">{{$user -> tAmount}}</span></td>
                                @elseif($user -> tAmount > 0 )
                                    <td><span class="text-success">{{$user -> tAmount}}</span></td>
                                @endif
                                <td><span class="text-info">{{$user -> balance}}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection