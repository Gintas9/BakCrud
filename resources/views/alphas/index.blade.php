@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">

            <h1>alphas</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new</h3>

        </div>

        <div class="d-flex justify-content-center">

            <form method="POST" action="{{route('alphas.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="">



                          <div class='input-group input-group-lg'><input name='title' type='text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='Title'></div>  <div class='input-group input-group-lg'><input name='body' type='text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='Body'></div>



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
                @foreach($alphas as $alpha)
                    <a href="{{route('alphas.show',$alpha)}}" class="list-group-item list-group-item-action ">
                        <div>
                            <h3>{{$alpha->title}}</h3>
                        </div>

                        <div>
                            Created at: {{$alpha->created_at}}
                        </div>

                    </a>
                @endforeach
            </div>
        </div>


    </div>

@endsection
