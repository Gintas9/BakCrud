@extends('layouts.app')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('gamas.show',$gama)}}" class="btn btn-warning">
                    Back
                </a>
                <form method="POST" action="{{route('gamas.update',['gama'=>$gama])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                        <input name='title' type='text' id='form1Example1' class='form-control' value='{{$gama->title}}'/><input name='body' type='text' id='form1Example1' class='form-control' value='{{$gama->body}}'/><input name='age' type='text' id='form1Example1' class='form-control' value='{{$gama->age}}'/>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </main>

@endsection
