@extends('dashboard')
@section('content')

    <main class="">

        <div class="container d-flex justify-content-center">
            <br>
            <div class=" justify-content-center topics col-lg-5">
                <a href="{{route('admins.show',$admin)}}" class="btn btn-warning">
                    Back
                </a>
                <form enctype="multipart/form-data" method="POST" action="{{route('admins.update',['admin'=>$admin])}}">
                    @method('PUT') @csrf
                    <br>


                    <div class="row">

                        <div class="col-12 ">

                            <div class='input-group input-group-lg'>
                                <label for="baseName">Database Name</label>
                                <input  name='baseName' id='baseName' type='Text' class='form-control' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$admin->baseName}}' placeholder='baseName'></div>
                            <div class='input-group input-group-lg'>
                                <label for="vars">Variables</label>
                                <input  name='vars' id='vars' type='Text' class='form-control varFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$admin->vars}}' placeholder='Variables'>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class='input-group input-group-lg'>
                                <label for="validation">Validation</label>
                                <input  name='validation' id='validation' type='Text' class='form-control valFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$admin->validation}}' placeholder='validation'></div>
                            <div class='input-group input-group-lg'>
                                <label for="inputs">Inputs</label>
                                <input  name='inputs' id='inputs' type='Text' class='form-control inputFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$admin->inputs}}' placeholder='inputs'></div>

                        </div>
                        <div class='input-group input-group-lg'>
                            <label for="foreignKey">foreignKey</label>
                            <input  name='foreignKey' id='foreignKey' type='Text' class='form-control inputFRM' aria-label='Large' aria-describedby='inputGroup-sizing-sm' value='{{$admin->foreignKey}}' placeholder='foreignKey'></div>

                    </div>



                        <div class="d-flex  justify-content-center">
                            <input type="submit" value="Submit" class="btn btn-primary" href=""></input>
                        </div>

                    </div>

                </form>
            </div>

        </div>

    </main>
    <br>
    <hr>
    <div class="container d-flex justify-content-center">
    <a href="{{route('controllerAdmin',$admin)}}" class="btn btn-primary ">Resubmit Controller</a>
    <a href="{{route('viewAdmin',$admin)}}" class="btn btn-danger ">Resubmit View</a>
    <a href="{{route('migrateAdmin',$admin)}}" class="btn btn-warning ">Resubmit Migration</a>

    </div>
@endsection
