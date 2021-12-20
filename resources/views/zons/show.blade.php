@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$zon->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$zon->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('zons.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("zons.edit",$zon)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('zons.destroy',$zon)}}" method="POST">
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
                        <h3> Name : @if($zon->name == 1 ) True @elseif($zon->name == 0) False @elseif($zon->name) {{$zon->name  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Surname : @if($zon->surname == 1 ) True @elseif($zon->surname == 0) False @elseif($zon->surname) {{$zon->surname  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> MidName : @if($zon->midName == 1 ) True @elseif($zon->midName == 0) False @elseif($zon->midName) {{$zon->midName  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> PetName : @if($zon->petName == 1 ) True @elseif($zon->petName == 0) False @elseif($zon->petName) {{$zon->petName  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Role : @if($zon->role == 1 ) True @elseif($zon->role == 0) False @elseif($zon->role) {{$zon->role  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Race : @if($zon->race == 1 ) True @elseif($zon->race == 0) False @elseif($zon->race) {{$zon->race  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
