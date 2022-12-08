@extends('layouts.admin')
@section('content')

<!-- Title -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Wallet Overview</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Wallet Overview</li>
            </ol>
        </div>
    </div>
</div>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h4 class="card-title">Wallet Overview</h4>
                    </div>
                    <div class="ml-auto">
                    @if(Auth::user()->isAdmin())
                        <button type="button" class="btn btn-rounded btn-outline-warning" data-toggle="modal" data-target="#depositModal">Deposit</button>
                        <button type="button" class="btn btn-rounded btn-outline-warning" data-toggle="modal" data-target="#withdrawModal">Withdraw</button>
                        <button type="button" class="btn btn-rounded btn-outline-warning" data-toggle="modal" data-target="#transferModal">Transfer</button>
                    @else
                        @foreach($user_permissions as $user_permission)
                            @if(Auth::user()->account_id == $user_permission -> user_id && $user_permission -> pName == "can_deposit")
                                <button type="button" class="btn btn-rounded btn-outline-warning" data-toggle="modal" data-target="#depositModal">Deposit</button>
                                @break
                            @endif
                        @endforeach

                        @foreach($user_permissions as $user_permission)
                            @if(Auth::user()->account_id == $user_permission -> user_id && $user_permission -> pName == "can_withdraw")
                                <button type="button" class="btn btn-rounded btn-outline-warning" data-toggle="modal" data-target="#withdrawModal">Withdraw</button>
                                @break
                            @endif
                        @endforeach

                        @foreach($user_permissions as $user_permission)
                            @if(Auth::user()->account_id == $user_permission -> user_id && $user_permission -> pName == "can_transfer")
                                <button type="button" class="btn btn-rounded btn-outline-warning" data-toggle="modal" data-target="#transferModal">Transfer</button>
                                @break
                            @endif
                            
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Balance</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wallets as $wallet)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$wallet->uName}}</td>
                                <td><span class="text-info">{{number_format($wallet->balance/100,2 )}}</span></td>
                                <td><a href="" class="btn btn-rounded btn-outline-info">History</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Deposit Modal -->
<form action="{{ url('check-out/deposit') }}" method="POST">
    @csrf
    <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="depositModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Deposit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Select User: </label>
                            <select name="userID" id="userID" class="form-control form-control-line">
                                @foreach($self as $user)
                                    <option value="{{$user -> id}}">{{$user -> loginID}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Deposit Amount</label>
                            <input type="number" name="amount" id="amount" step="0.01" min="0" class="form-control form-control-line"> 
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Withdraw Modal -->
<form action="{{ url('check-out/withdraw') }}" method="POST">
    @csrf
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Withdraw Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Select User: </label>
                            <select name="userID" id="userID" class="form-control form-control-line">
                                @foreach($self as $user)
                                    <option value="{{$user -> id}}">{{$user -> loginID}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Withdraw Amount</label>
                            <input type="number" name="amount" id="amount" step="0.01" min="0" class="form-control form-control-line"> 
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Transfer Modal -->
<form action="{{ url('check-out/transfer') }}" method="POST">
    @csrf
    <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Transfer Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Select User: </label>
                            <select name="userID" id="userID" class="form-control form-control-line">
                                @foreach($others as $user)
                                    <option value="{{$user -> id}}">{{$user -> loginID}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Transfer Amount</label>
                            <input type="number" name="amount" id="amount" step="0.01" min="0" class="form-control form-control-line"> 
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection