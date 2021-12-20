@extends('dashboard')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('alphas.show',$alpha)}}" class="btn btn-warning">
                    Back
                </a>
                <form enctype="multipart/form-data" method="POST" action="{{route('alphas.update',['alpha'=>$alpha])}}">
                    @method('PUT') @csrf
                    <br>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example1">Title</label>

                          <div class='input-group input-group-lg'><input name='name' id='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$alpha->name}}' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='age' id='age' type='Number' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$alpha->age}}' placeholder='age'></div>    <label ><h5>car</h5></label> <br><input type="radio" id="car" name="car" value="Volvo">
                    <label for="car">Volvo</label><br><input type="radio" id="car" name="car" value="Audi">
                    <label for="car">Audi</label><br><input type="radio" id="car" name="car" value="BMW">
                    <label for="car">BMW</label><br>
                        <input type="hidden" class="form-control" placeholder="Text" name="pid" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </main>

@endsection
