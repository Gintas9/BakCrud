@extends('layouts.app')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$alpha->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$alpha->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('alphas.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("alphas.edit",$alpha)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('alphas.destroy',$alpha)}}" method="POST">
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
                        <h3> Title : @if($alpha->title ) {{$alpha->title  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Body : @if($alpha->body ) {{$alpha->body  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
