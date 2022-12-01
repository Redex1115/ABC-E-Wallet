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
                            <th colspan="5">Currency: MYR</th>
                        </tr>
                    </thead>
                    <thead class="thead-dark">
                        <tr>
                            <th>Account ID</th>
                            <th>Login ID</th>
                            <th>Currency</th>
                            <th>B/F</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subparents as $subparent)
                        <tr>
                            <td>{{$subparent->account_id}}</td>
                            @if(count($subparent->subparent))
                                <td><a href="{{url('admin/subTest',['id' => $subparent->id])}}" target="_blank">{{$subparent->loginID}}</a></td>
                            @else
                                <td>{{$subparent->loginID}}</td>
                            @endif
                            <td>{{$subparent->currency}}</td>
                            <td>00.00</td>
                            <td>{{number_format($subparent->balance/100,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection
