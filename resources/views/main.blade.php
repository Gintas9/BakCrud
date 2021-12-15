@extends('dashboard')

@section('content')
<style>

    .single {
        padding: 30px 15px;
        margin-top: 40px;
        background: #fcfcfc;
        border: 1px solid #f0f0f0; }
    .single h3.side-title {
        margin: 0;
        margin-bottom: 10px;
        padding: 0;
        font-size: 20px;
        color: #333;
        text-transform: uppercase; }
    .single h3.side-title:after {
        content: '';
        width: 60px;
        height: 1px;
        background: #ff173c;
        display: block;
        margin-top: 6px; }

    .single ul {
        margin-bottom: 0; }
    .single li a {
        color: #666;
        font-size: 14px;
        text-transform: uppercase;
        border-bottom: 1px solid #f0f0f0;
        line-height: 40px;
        display: block;
        text-decoration: none; }
    .single li a:hover {
        color: #ff173c; }
    .single li:last-child a {
        border-bottom: 0; }

</style>

    <div class="container justify-content-center">
        <div class="row justify-content-center">

            <div class="col-sm-4" align="center">
            <h1 style="font-">CRUD GENERATOR</h1>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <!-- Category -->
                <div class="single category">
                    <h3 class="side-title" align="center">CRUD ITEMS</h3>
                    <ul class="list-unstyled">
                        @foreach($admins as $admin)
                        <li align="center"><a href="{{route(strtolower($admin->baseName).'s.index')}}" title="" >{{$admin->baseName}} </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @endsection