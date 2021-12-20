@extends('dashboard')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">

            <h1>Moderators</h1>

        </div>

        <div class="d-flex justify-content-center">

            <h3>Create new</h3>

        </div>

        <div class="d-flex justify-content-center">
@if(\App\Models\Moderator::isModerator(Auth::id()) == true )  @endif
            <form method="POST" enctype="multipart/form-data" action="{{route('moderators.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
                {{csrf_field()}}
                <div class="">

                    <label for="userID">Select user to make Moderator</label>
                    <select class="form-select" name="userID" id="user">
                        @foreach($users as $user)
                            <option  value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>


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
                    <th scope="col">Name</th>

                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($moderators as $moderator)
                <tr>
                    <th scope="row">{{$moderator->id}}</th>
                    <td>{{\App\Http\Controllers\ModeratorController::getUserName($moderator->userID)->name}}</td>

                    <td>
                        <!-- Call to action buttons -->
                        <ul class="list-inline m-0">

                            <li class="list-inline-item">
                                <form onsubmit="return confirm('Do you really want to delete the item?');"
                                      action="{{route('moderators.destroy',$moderator)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger list-inline-item">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>


        </div>

        <div class="d-flex justify-content-center m-5">

            <h1>Banned</h1>

        </div>
        <div class="d-flex justify-content-center">
        <form method="POST" enctype="multipart/form-data" action="{{route('bans.store')}}" onsubmit="return confirm('Do you really want to create the item?');">
            {{csrf_field()}}
            <div class="">

                <label for="userID">Select user to ban</label>
                <select class="form-select" name="userID" id="user">
                    @foreach($bans as $user)
                        <option  value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>


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

        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>

                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banned as $ban)
                    <tr>
                        <th scope="row">{{$ban->userID}}</th>
                        <td>{{\App\Http\Controllers\ModeratorController::getUserName($ban->userID)->name}}</td>

                        <td>
                            <!-- Call to action buttons -->
                            <ul class="list-inline m-0">

                                <li class="list-inline-item">
                                    <form onsubmit="return confirm('Do you really want to delete the item?');"
                                          action="{{route('bans.destroy',$ban)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger list-inline-item">Delete</button>
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
