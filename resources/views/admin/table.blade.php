@extends('layouts.admin')
@section('content')

<!-- Title -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Table</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Table</li>
            </ol>
        </div>
    </div>
</div>

<!-- Content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h4 class="card-title">---Dont know should write what---</h4>
                    </div>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-rounded btn-outline-success" data-toggle="modal" data-target=".bd-example-modal-lg">Create</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="tree-view">

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="info">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-permission table-responsive">
                        <div class="d-flex align-items-center justify-content-end" style="margin: 0 25px 10px 0;">
                            All &nbsp; <input type="checkbox" id="select-all">
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">&nbsp;</th>
                                    <th>Admin</th>
                                    <th>Branch</th>
                                    <th>Agent</th>
                                    <th>Member</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center">Register</th>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Edit</th>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Delete</th>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Deposit</th>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Withdraw</th>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Transfer</th>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                    <td><input type="checkbox"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Branch Modal -->
<form action="{{ url('post-registration') }}" method="POST" class="form-horizontal form-material">
    {{ csrf_field() }}
    <input type="hidden" name="account_id" id="account_id" value="1" min="0">
    <input type="hidden" name="currency" id="currency" value="MYR">
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Register Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="loginID">Login ID</label>
                                <input type="text" name="loginID" id="loginID" class="form-control form-control-line" placeholder="Enter Your User Name Here">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control form-control-line" placeholder="Enter Your Email Here">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-line" placeholder="Enter Your Password Here">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="passwordConfirm">Confirm Password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-line" placeholder="Confirm YourPassword">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Created Date</label>
                                <input type="date" name="join_date" id="date" class="form-control form-control-line" readonly value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="created-by">Created By</label>
                                <input type="text" name="created_by" class="form-control form-control-line" readonly @if(Session::has('adminData')) value="1" @endif>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="creditLimit">Credit Limit</label>
                                <input type="number" name="credit_limit" id="credit_limit" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="accountLevel">Role</label>
                            <select name="accountLevel" id="accountLevel" class="form-control form-control-line">
                                @if(auth()->user()->isAdmin())
                                    <option value="10">Sub Account</option>
                                    <option value="2">Branch</option>
                                @elseif(auth()->user()->isBranch())
                                    <option value="10">Sub Account</option>
                                    <option value="3">Agent</option>
                                @elseif(auth()->user()->isAgent())
                                    <option value="10">Sub Account</option>
                                    <option value="4" selected="">Member</option>
                                @endif
                            </select>
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

<script>
    $(document).ready(function(){
        document.getElementById("date").valueAsDate = new Date();
    });
</script>

<script>
    $('#select-all').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
        
    }); 
</script>

@endsection