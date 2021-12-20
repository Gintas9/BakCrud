@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$fail->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$fail->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('fails.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("fails.edit",$fail)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('fails.destroy',$fail)}}" method="POST">
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
                        <h3> Name : @if($fail->name == 1 ) True @elseif($fail->name == 0) False @elseif($fail->name) {{$fail->name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> FilePath : @if($fail->filePath == 1 ) True @elseif($fail->filePath == 0) False @elseif($fail->filePath) {{$fail->filePath  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
