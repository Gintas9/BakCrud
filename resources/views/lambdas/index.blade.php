@extends('dashboard')

@section('content')

    <div class="container  ">
        <div class="d-flex justify-content-center">

            <h1>lambdas</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new</h3>

        </div>

        <div class="d-flex justify-content-center">

            <form method="POST" enctype="multipart/form-data" action="{{route('lambdas.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="">



                          <div class='input-group input-group-lg'>
  <label for='name'>name</label>
  <input name='name' id='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='name'></div>  <div class='input-group input-group-lg'>
  <label for='surname'>surname</label>
  <input name='surname' id='surname' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='surname'></div>  <div class='input-group input-group-lg'>
  <label for='town'>town</label>
  <input name='town' id='town' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='town'></div>



                    <div class="d-flex  justify-content-center">
                        <input type="submit" value="Submit" class="btn btn-primary" href=""></input>
                    </div>

                </div>


                @if(count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </form>


        </div>

        @if (!empty($success))
            <br>
            <div class="d-flex justify-content-center">
                <div class="alert alert-success" role="alert">
                    {{$success}}
                </div>
            </div>
        @endif





<style>
            body{margin-top:20px;}


            /* USER LIST TABLE */
            .user-list tbody td > img {
                position: relative;
                max-width: 50px;
                float: left;
                margin-right: 15px;
            }
            .user-list tbody td .user-link {
                display: block;
                font-size: 1.25em;
                padding-top: 3px;
                margin-left: 60px;
            }
            .user-list tbody td .user-subhead {
                font-size: 0.875em;
                font-style: italic;
            }

            /* TABLES */
            .table {
                border-collapse: separate;
            }
            .table-hover > tbody > tr:hover > td,
            .table-hover > tbody > tr:hover > th {
                background-color: #eee;
            }
            .table thead > tr > th {
                border-bottom: 1px solid #C2C2C2;
                padding-bottom: 0;
            }
            .table tbody > tr > td {
                font-size: 0.875em;
                background: #f5f5f5;
                border-top: 10px solid #fff;
                vertical-align: middle;
                padding: 12px 8px;
            }
            .table tbody > tr > td:first-child,
            .table thead > tr > th:first-child {
                padding-left: 20px;
            }
            .table thead > tr > th span {
                border-bottom: 2px solid #C2C2C2;
                display: inline-block;
                padding: 0 5px;
                padding-bottom: 5px;
                font-weight: normal;
            }
            .table thead > tr > th > a span {
                color: #344644;
            }
            .table thead > tr > th > a span:after {
                content: "\f0dc";
                font-family: FontAwesome;
                font-style: normal;
                font-weight: normal;
                text-decoration: inherit;
                margin-left: 5px;
                font-size: 0.75em;
            }
            .table thead > tr > th > a.asc span:after {
                content: "\f0dd";
            }
            .table thead > tr > th > a.desc span:after {
                content: "\f0de";
            }
            .table thead > tr > th > a:hover span {
                text-decoration: none;
                color: #2bb6a3;
                border-color: #2bb6a3;
            }
            .table.table-hover tbody > tr > td {
                -webkit-transition: background-color 0.15s ease-in-out 0s;
                transition: background-color 0.15s ease-in-out 0s;
            }
            .table tbody tr td .call-type {
                display: block;
                font-size: 0.75em;
                text-align: left;
            }
            .table tbody tr td .first-line {
                line-height: 1.5;
                font-weight: 400;
                font-size: 1.125em;
                text-align: left;
            }
            .table tbody tr td .first-line span {
                font-size: 0.875em;
                color: #969696;
                font-weight: 300;
            }
            .table tbody tr td .second-line {
                font-size: 0.875em;
                line-height: 1.2;
                text-align: left;
            }
            .table tbody tr td .second-line {
                font-size: 0.875em;
                line-height: 1.2;
                text-align: left;
            }
            .table a.table-link {
                margin: 0 5px;
                font-size: 1.125em;
            }
            .table a.table-link:hover {
                text-decoration: none;
                color: #2aa493;
            }
            .table a.table-link.danger {
                color: #fe635f;
            }
            .table a.table-link.danger:hover {
                color: #dd504c;
            }

            .table-products tbody > tr > td {
                background: none;
                border: none;
                border-bottom: 1px solid #ebebeb;
                -webkit-transition: background-color 0.15s ease-in-out 0s;
                transition: background-color 0.15s ease-in-out 0s;
                position: relative;
            }
            .table-products tbody > tr:hover > td {
                text-decoration: none;
                background-color: #f6f6f6;
            }
            .table-products .name {
                display: block;
                font-weight: 600;
                padding-bottom: 7px;
            }
            .table-products .price {
                display: block;
                text-decoration: none;
                width: 50%;
                float: left;
                font-size: 0.875em;
            }
            .table-products .price > i {
                color: #8dc859;
            }
            .table-products .warranty {
                display: block;
                text-decoration: none;
                width: 50%;
                float: left;
                font-size: 0.875em;
            }
            .table-products .warranty > i {
                color: #f1c40f;
            }
            .table tbody > tr.table-line-fb > td {
                background-color: #9daccb;
                color: #262525;
            }
            .table tbody > tr.table-line-twitter > td {
                background-color: #9fccff;
                color: #262525;
            }
            .table tbody > tr.table-line-plus > td {
                background-color: #eea59c;
                color: #262525;
            }
            .table-stats .status-social-icon {
                font-size: 1.9em;
                vertical-align: bottom;
            }
            .table-stats .table-line-fb .status-social-icon {
                color: #556484;
            }
            .table-stats .table-line-twitter .status-social-icon {
                color: #5885b8;
            }
            .table-stats .table-line-plus .status-social-icon {
                color: #a75d54;
            }
        </style>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>



                                <tr>
                                    <th><span>#</span></th>
                                           <th><span>name</span></th>      <th><span>surname</span></th>      <th><span>town</span></th>
                                    <th><span>Actions</span></th>

                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lambdas as $lambda)

                                    <tr>
                            <td style="text-align: left;">{{$lambda->id}}</td>
                                      <td style="text-align: left;">{{$lambda->name}}</td><td style="text-align: left;">{{$lambda->surname}}</td><td style="text-align: left;">{{$lambda->town}}</td>



                                    <td style="width: 20%;">
                                        <a href="{{route('lambdas.show',$lambda)}}" class="table-link">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>
                                        <a href="{{route("lambdas.edit",$lambda)}}" class="table-link">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
									</span>
                                        </a>

                                        <span class="table-link">
										<form onsubmit="return confirm('Do you really want to delete the item?');"
                                                                                  action="{{route('lambdas.destroy',$lambda)}}" method="POST" class="fa-stack">
                                                            @method('DELETE')
                                                @csrf
                                            <button type="submit" value=""   class="btn-danger" style="border-radius: 20%;"><i class="glyphicon glyphicon-trash"></i></button>


                                                        </form>
                                        </span>



                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>





    </div>

@endsection
