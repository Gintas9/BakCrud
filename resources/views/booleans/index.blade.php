@extends('dashboard')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">

            <h1>booleans</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new</h3>

        </div>

        <div class="d-flex justify-content-center">

            <form method="POST" action="{{route('booleans.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="">



                            <label for="married">married</label>
                    <select class="form-select" name="married" id="married">
                      <option  value=1>True</option><option  value=0>False</option>
                    </select>   <div class='input-group input-group-lg'><input name='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='lastName' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='lastName'></div>



                    <div class="d-flex  justify-content-center">
                        <input type="submit" value="Submit" class="btn btn-primary" href=""></input>
                    </div>

                </div>


                @if(count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </form>


        </div>

        @if (!empty($success))
            <br>
            <div class="d-flex justify-content-center">
                <div class="alert alert-success" role="alert">
                    {{$success}}
                </div>
            </div>
        @endif


        <div class="d-flex  justify-content-center">
            <div class="list-group col-lg-4 ">
                @foreach($booleans as $boolean)
                    <a href="{{route('booleans.show',$boolean)}}" class="list-group-item list-group-item-action ">
                        <div>
                            <h3>{{$boolean->name}}</h3>
                        </div>

                        <div>
                            Created at: {{$boolean->created_at}}
                        </div>

                    </a>
                @endforeach
            </div>
        </div>


    </div>

@endsection
