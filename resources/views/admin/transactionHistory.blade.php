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
                            <option value="1" selected>All</option>
                            <option value="2">Withdraw</option>
                            <option value="3">Deposit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>UUID</th>
                            <th>Type</th>
                            <th>Pay/Receive</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $deposit)
                            @if($user -> id == $deposit -> payable_id)
                                <tr>
                                    <td>{{$deposit -> uuid}}</td>
                                    <td>{{$deposit -> type}}</td>
                                    <td><span class="text-success" id="balance">+{{number_format($deposit -> amount/100,2)}}</span></td>
                                    <td>{{$deposit -> created_at}}</td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach($withdraws as $withdraw)
                            @if($user -> id == $withdraw -> payable_id)
                                <tr>
                                    <td>{{$withdraw -> uuid}}</td>
                                    <td>{{$withdraw -> type}}</td>
                                    <td><span class="text-danger" id="balance">{{number_format($withdraw -> amount/100,2)}}</span></td>
                                    <td>{{$withdraw -> created_at}}</td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach($transfers as $transfer)
                            @if($user -> loginID == $transfer -> fromName || $user -> loginID == $transfer -> toName)
                                @if($user -> loginID == $transfer -> fromName)
                                    <tr>
                                        <td>{{$transfer -> uuid}}</td>
                                        <td>{{$transfer -> status}}</td>
                                        <td><span class="text-success" id="balance">+{{number_format($transfer -> dAmount/100,2)}}</span></td>
                                        <td>{{$transfer -> created_at}}</td>
                                    </tr>
                                @elseif($user -> loginID == $transfer -> toName)
                                    <tr>
                                        <td>{{$transfer -> uuid}}</td>
                                        <td>{{$transfer -> status}}</td>
                                        <td><span class="text-danger" id="balance">{{number_format($transfer -> wAmount/100,2)}}</span></td>
                                        <td>{{$transfer -> created_at}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        <tr>
                            <td></td>
                            <td>Total: </td>
                            @if($user->transactions->sum('amount') >= 0)
                                <td><span class="text-success">+{{number_format($user->transactions->sum('amount')/100,2)}}</span></td>
                            @else
                                <td><span class="text-danger">{{number_format($user->transactions->sum('amount')/100,2)}}</span></td>
                            @endif
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection