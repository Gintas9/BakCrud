@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$bkey->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$bkey->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('bkeys.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("bkeys.edit",$bkey)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('bkeys.destroy',$bkey)}}" method="POST">
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
                        <h3> Name : {{(string)$bkey->name }}</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Pkeyid : {{(string)$bkey->pkeyid }}</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
