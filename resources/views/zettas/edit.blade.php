@extends('layouts.app')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('zettas.show',$zetta)}}" class="btn btn-warning">
                    Back
                </a>
                <form method="POST" action="{{route('zettas.update',['zetta'=>$zetta])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                        <input name='title' type='text' id='form1Example1' class='form-control' value='{{$zetta->title}}'/><input name='body' type='text' id='form1Example1' class='form-control' value='{{$zetta->body}}'/>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </main>

@endsection
