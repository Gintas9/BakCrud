@extends('dashboard')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('items.show',$item)}}" class="btn btn-warning">
                    Back
                </a>
                <form enctype="multipart/form-data" method="POST" action="{{route('items.update',['item'=>$item])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                          <div class='input-group input-group-lg'><input name='name' id='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$item->name}}' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='email' id='email' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$item->email}}' placeholder='email'></div>  <div class='input-group input-group-lg'><input name='age' id='age' type='Number' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$item->age}}' placeholder='age'></div>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </main>

@endsection
