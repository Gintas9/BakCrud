@extends('layouts.app')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('temps.show',$temp)}}" class="btn btn-warning">
                    Back
                </a>
                <form method="POST" action="{{route('temps.show',['temp'=>$temp])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>
                        <input type="text" id="form1Example1" class="form-control" value="{{$temp->title}}"/>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </main>

@endsection
