@extends('dashboard')

@section('content')

    <div class="container ">

        <div class="d-flex justify-content-center ">

            <h1>{{$admin->title}}</h1>

        </div>
        <div class="d-flex justify-content-center">

            <p>Created at: {{$admin->created_at}}</p>

        </div>

        <div class="d-flex justify-content-center list-inline m-2">
            <a href="{{route('admins.index')}}" class="btn btn-warning list-inline-item">
                Back
            </a>

            <a href="{{route("admins.edit",$admin)}}" class="btn btn-primary list-inline-item">Edit</a>


            <form onsubmit="return confirm('Do you really want to delete the item?');"
                  action="{{route('admins.destroy',$admin)}}" method="POST">
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
                        <h3> BaseName : @if($admin->baseName == 1 ) True @elseif($admin->baseName == 0) False @elseif($admin->baseName) {{$admin->baseName  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Vars : @if($admin->vars == 1 ) True @elseif($admin->vars == 0) False @elseif($admin->vars) {{$admin->vars  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Validation : @if($admin->validation == 1 ) True @elseif($admin->validation == 0) False @elseif($admin->validation) {{$admin->validation  }}@else NULL @endif</h3>
                    </div>
                </div><div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Inputs : @if($admin->inputs == 1 ) True @elseif($admin->inputs == 0) False @elseif($admin->inputs) {{$admin->inputs  }}@else NULL @endif</h3>
                    </div>
                </div>

                <div href='' class='list-group-item list-group-item-action '>
                    <div>
                        <h3> Inputs : @if($admin->foreignKey == 1 ) True @elseif($admin->foreignKey == 0) False @elseif($admin->inputs) {{$admin->inputs  }}@else NULL @endif</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
