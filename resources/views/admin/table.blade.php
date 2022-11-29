@extends('layouts.admin')
@section('content')

<style>
    ul, #myUL {
        list-style-type: none;
    }

    #myUL {
        margin: 0;
        padding: 0;
    }

    .caret {
        cursor: pointer;
        user-select: none;
    }

    .caret::before {
        content: "\25B6";
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .caret-down::before {
        transform: rotate(90deg);
    }

    .nested {
        display: none;
    }

    #opened{
        display: block !important;
    }

    .active {
        display: block;
    }

</style>

<!-- Title -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Member Entry</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Member Entry</li>
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
                <div class="col-md-3">
                    <div class="tree-view">
                        @foreach($parents as $parent)
                            <ul id="myUl">
                                <li><span class="caret"><a href="{{ url('admin/table',['id' => $parent->id])}}">{{$parent->loginID}}</a></span></span>
                                    <ul class="nested" id="opened">
                                        <li>
                                            @if(count($parent->subparent))
                                                @include('admin.subParent',['subparents' => $parent->subparent])
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-success">User Info</h3>
                            @foreach($users as $user)
                                <form action="{{ url('admin/update')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="userID" value="{{$user->id}}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="accID">Account ID</label>
                                            <input type="text" name="accID" id="accID" class="form-control form-control-outline" value="{{$user -> account_id}}" placeholder="Account ID" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="ic">IC No</label>
                                            <input type="text" name="ic" id="ic" class="form-control form-control-outline" value="{{$user -> userIc}}" placeholder="IC No">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phoneNO">Phone No</label>
                                            <input type="text" name="phoneNO" id="phoneNO" class="form-control form-control-outline" value="{{$user -> userHp}}" placeholder="Phone No">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="userName">User Name</label>
                                            <input type="text" class="form-control form-control-outline" value="{{$user -> loginID}}" placeholder="User Name" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control form-control-outline" value="{{$user -> email}}" placeholder="Email" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control form-control-outline" value="{{$user -> userAddress}}" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="">Credit Limit</label>
                                            <input type="text" class="form-control form-control-outline" value="{{$user -> credit_limit}}" placeholder="00000" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="joinDate">Join Date</label>
                                            <input type="text" class="form-control form-control-outline" value="{{$user -> join_date}}" placeholder="1111-11-11" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="status">Status</label>
                                            <input type="text" name="status" id="status" class="form-control form-control-outline" value="{{$user -> userStatus}}" placeholder="Good">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="created_by">Created By</label>
                                            <input type="text" class="form-control form-control-outline" value="{{$user -> created_by}}" placeholder="Admin" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="remark">Remark</label>
                                            <textarea name="remark" id="remark" class="form-control" row="1" value="" placeholder="{{$user -> userRemark}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="ml-auto">
                                            @if($user -> created_by == Auth::user()->id)
                                                <button type="submit" class="btn btn-rounded btn-outline-success">Update</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-permission table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Deposit</th>
                                            <th class="text-center">Withdraw</th>
                                            <th class="text-center">Transfer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><input type="checkbox"></td>
                                            <td class="text-center"><input type="checkbox"></td>
                                            <td class="text-center"><input type="checkbox"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                    <h5 class="modal-title text-center">Register</h5>
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
                                <input type="text" name="created_by" class="form-control form-control-line" readonly value="{{Auth::user()->id}}">
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
                <div class="modal-body">
                <div class="row">
                        <div class="col-md-12">
                            <div class="page-permission table-responsive">
                                <h3>Page Permission</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox">Deposit</td>
                                            <td><input type="checkbox">Withdraw</td>
                                            <td><input type="checkbox">Transfer</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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

<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            $(this).siblings("ul").slideToggle("slow");
            this.classList.toggle("caret-down");
        });
    }

</script>

@endsection