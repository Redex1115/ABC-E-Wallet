@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
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
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Test</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Test</li>
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
                        <h4 class="card-title">Test</h4>
                    </div>
                    <div class="ml-auto">
                        <select class="custom-select b-0">
                            <option value="1">All</option>
                            <option value="2">A</option>
                            <option value="3">B</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div id="accordion" class="myaccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2>
                                <span class="fa-stack" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                </span>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                    <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Branch 1
                                                        <span class="fa-stack fa-2x">
                                                            <i class="fa fa-circle fa-stack-2x"></i>
                                                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                                                <div class="card-body">
                                                    <ul>
                                                        <li>Manager 1</li>
                                                        <li>Manager 2</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h2 class="mb-0">
                                                    <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Branch 2
                                                        <span class="fa-stack fa-2x">
                                                            <i class="fa fa-circle fa-stack-2x"></i>
                                                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour">
                                                <div class="card-body">
                                                    <ul>
                                                        <li><div class="card">
                                            <div class="card-header" id="headingFive">
                                                <h2 class="mb-0">
                                                    <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Manager 1
                                                        <span class="fa-stack fa-2x">
                                                            <i class="fa fa-circle fa-stack-2x"></i>
                                                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive">
                                                <div class="card-body">
                                                    <ul>
                                                        <li>Member 1</li>
                                                        <li>Member 2</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div></li>
                                                        <li>Manager 2</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Admin 2
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                            <div class="card-body">
                                <ul>
                                    <li>Branch 1</li>
                                    <li>Branch 2</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="treeview w-20 border">
  <h6 class="pt-3 pl-3">Folders</h6>
  <hr>
  <ul class="mb-1 pl-3 pb-2">
    <li><i class="fas fa-angle-right rotate"></i>
      <span><i class="far fa-envelope-open ic-w mx-1"></i>Mail</span>
      <ul class="nested">
        <li><i class="far fa-bell ic-w mr-1"></i>Offers</li>
        <li><i class="far fa-address-book ic-w mr-1"></i>Contacts</li>
        <li><i class="fas fa-angle-right rotate"></i>
          <span><i class="far fa-calendar-alt ic-w mx-1"></i>Calendar</span>
          <ul class="nested">
            <li><i class="far fa-clock ic-w mr-1"></i>Deadlines</li>
            <li><i class="fas fa-users ic-w mr-1"></i>Meetings</li>
            <li><i class="fas fa-basketball-ball ic-w mr-1"></i>Workouts</li>
            <li><i class="fas fa-mug-hot ic-w mr-1"></i>Events</li>
          </ul>
        </li>
      </ul>
    </li>
    <li><i class="fas fa-angle-right rotate"></i>
      <span><i class="far fa-folder-open ic-w mx-1"></i>Inbox</span>
      <ul class="nested">
        <li><i class="far fa-folder-open ic-w mr-1"></i>Admin</li>
        <li><i class="far fa-folder-open ic-w mr-1"></i>Corporate</li>
        <li><i class="far fa-folder-open ic-w mr-1"></i>Finance</li>
        <li><i class="far fa-folder-open ic-w mr-1"></i>Other</li>
      </ul>
    </li>
    <li><i class="fas fa-angle-right rotate"></i>
      <span><i class="far fa-gem ic-w mx-1"></i>Favourites</span>
      <ul class="nested">
          <li><i class="fas fa-pepper-hot ic-w mr-1"></i>Restaurants</li>
          <li><i class="far fa-eye ic-w mr-1"></i>Places</li>
          <li><i class="fas fa-gamepad ic-w mr-1"></i>Games</li>
          <li><i class="fas fa-cocktail ic-w mr-1"></i>Coctails</li>
          <li><i class="fas fa-pizza-slice ic-w mr-1"></i>Food</li>
        </ul>
    </li>
    <li><i class="far fa-comment ic-w mr-1"></i>Notes</li>
    <li><i class="fas fa-cogs ic-w mr-1"></i>Settings</li>
    <li><i class="fas fa-desktop ic-w mr-1"></i>Devices</li>
    <li><i class="fas fa-trash-alt ic-w mr-1"></i>Deleted Items</li>
  </ul>
</div>


<ul id="myUL">
    <li><span class="caret">Admin</span>
        <ul class="nested">
            <li><span class="caret">JB</span>
                <ul class="nested">
                    <li><span class="caret">JB Manager</span>
                        <ul class="nested">
                            <li>JB Member</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><span class="caret">JB</span>
                <ul class="nested">
                    <li><span class="caret">JB Manager</span>
                        <ul class="nested">
                            <li>JB Member</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

</ul>

<script type="text/javascript" src="node_modules/mdbootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>
<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target)
            .prev()
            .find("i:last-child")
            .toggleClass("fa-minus fa-plus");
    });

    // Treeview Initialization
$(document).ready(function() {
  $('.treeview-colorful').mdbTreeview();
});
</script>

<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>

@endsection