@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$gamma->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$gamma->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('gammas.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("gammas.edit",$gamma)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('gammas.destroy',$gamma)}}" method="POST">
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
                        <h3> FilePath : {{(string)$gamma->filePath }}</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection