<!-- resources/views/teams/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <h1 class="text-center">Update Team</h1>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New team Form -->
        <form action="{{ url('team/'.$team->id) }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <!-- team Name -->
            <div class="form-group">
                <label for="team-name" class="col-sm-3 control-label">Team Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="team-name" class="form-control" value="{{$team->name}}">
                </div>
            </div>

            <!-- team Description -->
            <div class="form-group">
                <label for="team-description" class="col-sm-3 control-label">Team Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="team-description" class="form-control">{{$team->description}}</textarea>
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update Team
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
