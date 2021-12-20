@extends('dashboard')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('booleans.show',$boolean)}}" class="btn btn-warning">
                    Back
                </a>
                <form method="POST" action="{{route('booleans.update',['boolean'=>$boolean])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                            <label for="married">married</label>
                    <select class="form-select" name="married" id="married">
                      <option  value=1>True</option><option  value=0>False</option>
                    </select>   <div class='input-group input-group-lg'><input name='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$boolean->name}}' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='lastName' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$boolean->lastName}}' placeholder='lastName'></div>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </main>

@endsection
