@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$human->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$human->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('humans.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("humans.edit",$human)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('humans.destroy',$human)}}" method="POST">
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
                        <h3> Name : @if($human->Name == 1 ) True @elseif($human->Name == 0) False @elseif($human->Name) {{$human->Name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Surname : @if($human->Surname == 1 ) True @elseif($human->Surname == 0) False @elseif($human->Surname) {{$human->Surname  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Email : @if($human->email == 1 ) True @elseif($human->email == 0) False @elseif($human->email) {{$human->email  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
