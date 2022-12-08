@extends('layouts.admin')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Member Balance</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Member Balance</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="8">Currency: MYR</th>
                    </tr>
                </thead>
                <thead class="thead-dark">
                    <tr>
                        <th>Account ID</th>
                        <th>Login ID</th>
                        <th>Currency</th>
                        <th>B/F</th>
                        <th>Transaction</th>
                        <th>Pay/Receive</th>
                        <th>Total Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parents as $parent)
                    <tr>
                        <td>{{$parent->account_id}}</td>
                        @if(count($parent->subparent))
                            <td><a href="{{url('admin/subTest',['id' => $parent->id])}}" target="_blank">{{$parent->loginID}}</a></td>
                        @else
                            <td>{{$parent->loginID}}</td>
                        @endif
                        <td>{{$parent->currency}}</td>
                        <td>00.00</td>
                        <td>00.00</td>
                        @if($parent->transactions->sum('amount') >= 0)
                            <td><a href="{{url('checkout/history',['id' => $parent -> account_id])}}" target="_blank"><span class="text-success">+{{number_format($parent->transactions->sum('amount')/100,2)}}</span></a></td>
                        @else
                            <td><a href="{{url('checkout/history',['id' => $parent -> account_id])}}" target="_blank"><span class="text-danger">{{number_format($parent->transactions->sum('amount')/100,2)}}</span></a></td>
                        @endif
                        <td>{{number_format($parent->balance/100,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
