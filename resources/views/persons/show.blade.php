@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$person->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$person->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('persons.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("persons.edit",$person)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('persons.destroy',$person)}}" method="POST">
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
                        <h3> Name : @if($person->Name == 1 ) True @elseif($person->Name == 0) False @elseif($person->Name) {{$person->Name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Surname : @if($person->Surname == 1 ) True @elseif($person->Surname == 0) False @elseif($person->Surname) {{$person->Surname  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Nickname : @if($person->nickname == 1 ) True @elseif($person->nickname == 0) False @elseif($person->nickname) {{$person->nickname  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
