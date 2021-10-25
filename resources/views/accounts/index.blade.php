@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">

            <h1>accounts</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new</h3>

        </div>

        <div class="d-flex justify-content-center">

            <form method="POST" action="{{route('accounts.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="">



                          <div class='input-group input-group-lg'><input name='title' type='text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='Title'></div>  <div class='input-group input-group-lg'><input name='body' type='text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='Body'></div>
                    <div class='input-group input-group-lg'><input name='customer_ID' type='text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='Customer_ID'></div>



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
                @foreach($accounts as $account)
                    <a href="{{route('accounts.show',$account)}}" class="list-group-item list-group-item-action ">
                        <div>
                            <h3>{{$account->title}}</h3>
                        </div>

                        <div>
                            Created at: {{$account->created_at}}
                        </div>

                    </a>
                @endforeach
            </div>
        </div>


    </div>

@endsection