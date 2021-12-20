@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$teast->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$teast->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('teasts.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("teasts.edit",$teast)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('teasts.destroy',$teast)}}" method="POST">
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
                        <h3> Name : @if($teast->name == 1 ) True @elseif($teast->name == 0) False @elseif($teast->name) {{$teast->name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Body : @if($teast->body == 1 ) True @elseif($teast->body == 0) False @elseif($teast->body) {{$teast->body  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Gender : @if($teast->gender == 1 ) True @elseif($teast->gender == 0) False @elseif($teast->gender) {{$teast->gender  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
