@extends('dashboard')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('omegas.show',$omega)}}" class="btn btn-warning">
                    Back
                </a>
                <form enctype="multipart/form-data" method="POST" action="{{route('omegas.update',['omega'=>$omega])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                          <div class='input-group input-group-lg'><input name='name' id='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$omega->name}}' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='lastName' id='lastName' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$omega->lastName}}' placeholder='lastName'></div>  <div class='input-group input-group-lg'><input name='filePath' id='filePath' type='File' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$omega->filePath}}' placeholder='filePath'></div>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </main>

@endsection
