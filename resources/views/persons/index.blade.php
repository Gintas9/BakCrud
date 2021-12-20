@extends('dashboard')

@section('content')

    <div class="container  ">
        <div class="d-flex justify-content-center">

            <h1>persons</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new</h3>

        </div>

        <div class="d-flex justify-content-center">

            <form method="POST" enctype="multipart/form-data" action="{{route('persons.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="">



                          <div class='input-group input-group-lg'><input name='name' id='name' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='name'></div>  <div class='input-group input-group-lg'><input name='surname' id='surname' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='surname'></div>  <div class='input-group input-group-lg'><input name='nickname' id='nickname' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='' placeholder='nickname'></div>



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

  <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                         <th scope="col">#</th>
                                        <th scope="col">Name</th><th scope="col">Surname</th><th scope="col">nickname</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($persons as $person)

                                    <tr>
                                    <td>{{$person->id}}</td>
                                      <td>{{$person->Name}}</td><td>{{$person->Surname}}</td><td>{{$person->nickname}}</td>




                                        <td>
                                            <!-- Call to action buttons -->
                                            <ul class="list-inline m-0 float-end">

                                                <li class="list-inline-item">
                                                <a href="{{route('persons.show',$person)}}" class="list-group-item list-group-item-action ">
                                                    <button class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-table">Show</i></button>
                                                     </a>
                                                </li>
                                                <li class="list-inline-item">
                                                        <a href="{{route("persons.edit",$person)}}" class="list-group-item list-group-item-action ">
                                                    <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit">Edit</i></button>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <form onsubmit="return confirm('Do you really want to delete the item?');"
                                                                      action="{{route('persons.destroy',$person)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm rounded-0">Delete</button>
                                                                </form>
                                                </li>

                                            </ul>
                                        </td>
                                    </tr>
  @endforeach
                                </tbody>
                            </table>

                        </div>








    </div>

@endsection
