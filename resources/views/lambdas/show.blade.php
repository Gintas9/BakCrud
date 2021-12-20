@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$lambda->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$lambda->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('lambdas.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("lambdas.edit",$lambda)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('lambdas.destroy',$lambda)}}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger list-inline-item">Delete</button>
            </form>
        </div>

        @if (!empty($success))
            <div class="alert alert-success" role="alert">
                {{$success}}
            </div>
        @endif


        <div class="d-flex justify-content-center">

            <h2>Items</h2>

        </div>
        <div class="d-flex  justify-content-center">
            <div class="list-group col-lg-4 ">

                <div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Name : @if($lambda->name == 1 ) True @elseif($lambda->name == 0) False @elseif($lambda->name) {{$lambda->name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Surname : @if($lambda->surname == 1 ) True @elseif($lambda->surname == 0) False @elseif($lambda->surname) {{$lambda->surname  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Town : @if($lambda->town == 1 ) True @elseif($lambda->town == 0) False @elseif($lambda->town) {{$lambda->town  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
