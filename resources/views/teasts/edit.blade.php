@extends('dashboard')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('teasts.show',$teast)}}" class="btn btn-warning">
                    Back
                </a>
                <form enctype="multipart/form-data" method="POST" action="{{route('teasts.update',['teast'=>$teast])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                          <div class='input-group input-group-lg'><input name='name' id='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$teast->name}}' placeholder='name'></div><textarea class='input-group input-group-lg form-control' name='body' placeholder='body'>{{$teast->body}}</textarea>    <label ><h5>gender</h5></label> <br><input type="radio" id="gender" name="gender" value="male">
                    <label for="gender">male</label><br><input type="radio" id="gender" name="gender" value="female">
                    <label for="gender">female</label><br>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </main>

@endsection
