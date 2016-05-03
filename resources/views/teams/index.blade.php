<!-- resources/views/teams/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <h1 class="text-center">Teams</h1>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Moment Form -->
        <form action="{{ url('team') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Moment Name -->
            <div class="form-group">
                <label for="team-name" class="col-sm-3 control-label">Team Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="team-name" class="form-control">
                </div>
            </div>

            <!-- team Description -->
            <div class="form-group">
                <label for="team-description" class="col-sm-3 control-label">Team Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="team-description" class="form-control"></textarea>
                </div>
            </div>

            <!-- Add Team Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Team
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Teams -->
    @if (count($teams) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Teams
            </div>

            <div class="panel-body">
                <table class="table table-striped team-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Team Name</th>
                        <th>Team Description</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <!-- Team Name -->
                                <td class="table-text">
                                    <div>{{ $team->name }}</div>
                                </td>

                                <!-- Team Description -->
                                <td class="table-text">
                                    <div>{{ $team->description }}</div>
                                </td>

                                <td>
                                  <form action="{{ url('team/'.$team->id.'/edit') }}" method="GET">
                                      {!! csrf_field() !!}

                                      <button type="submit" id="update-team-{{ $team->id }}" class="btn">
                                          <i class="fa fa-btn fa-edit"></i>Edit
                                      </button>
                                  </form>

                                  <form action="{{ url('team/'.$team->id) }}" method="POST">
                                      {!! csrf_field() !!}
                                      {!! method_field('DELETE') !!}

                                      <button type="submit" id="delete-team-{{ $team->id }}" class="btn btn-danger">
                                          <i class="fa fa-btn fa-trash"></i>Delete
                                      </button>
                                  </form>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
