@extends('layouts.admin')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Dashboard</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
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
                        <h4 class="card-title">---Dont know should write what---</h4>
                        <a href="#" class="btn btn-rounded btn-outline-success">Create</a>
                    </div>
                    <div class="ml-auto">
                        <select class="custom-select b-0">
                            <option value="1" selected="">All</option>
                            <option value="2">Branch</option>
                            <option value="3">Manager</option>
                            <option value="4">Member</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="txt-oflo">Hooi Ern</td>
                            <td><span class="label label-danger">Admin</span></td>
                            <td class="txt-oflo">April 18, 2017</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="txt-oflo">Jin Fatt</td>
                            <td><span class="label label-warning">Branch</span></td>
                            <td class="txt-oflo">April 18, 2017</td>
                            <td>
                                <a href="#" class="btn btn-rounded btn-outline-info">Edit</a>
                                <a href="#" class="btn btn-rounded btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="txt-oflo">Eugene</td>
                            <td><span class="label label-success">Manager</span></td>
                            <td class="txt-oflo">April 18, 2017</td>
                            <td>
                                <a href="#" class="btn btn-rounded btn-outline-info">Edit</a>
                                <a href="#" class="btn btn-rounded btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="txt-oflo">Jian An</td>
                            <td><span class="label label-info">Member</span></td>
                            <td class="txt-oflo">April 18, 2017</td>
                            <td>
                                <a href="#" class="btn btn-rounded btn-outline-info">Edit</a>
                                <a href="#" class="btn btn-rounded btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection