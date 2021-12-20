@extends('dashboard')
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

                          <div class='input-group input-group-lg'><input name='gender' type='Checkbox' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$zetta->gender}}' placeholder='gender'></div>  <div class='input-group input-group-lg'><input name='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$zetta->name}}' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='lastName' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$zetta->lastName}}' placeholder='lastName'></div>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </main>

@endsection
