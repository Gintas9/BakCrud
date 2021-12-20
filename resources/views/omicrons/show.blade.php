@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$omicron->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$omicron->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('omicrons.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("omicrons.edit",$omicron)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('omicrons.destroy',$omicron)}}" method="POST">
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
                        <h3> Married : @if($omicron->married == 1 ) True @elseif($omicron->married == 0) False @elseif($omicron->married) {{$omicron->married  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Name : @if($omicron->name == 1 ) True @elseif($omicron->name == 0) False @elseif($omicron->name) {{$omicron->name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> LastName : @if($omicron->lastName == 1 ) True @elseif($omicron->lastName == 0) False @elseif($omicron->lastName) {{$omicron->lastName  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
