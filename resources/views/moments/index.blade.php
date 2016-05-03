<!-- resources/views/moments/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <h1 class="text-center">Moments</h1>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Moment Form -->
        <form action="{{ url('moment') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Moment Name -->
            <div class="form-group">
                <label for="moment-event-id" class="col-sm-3 control-label">Event</label>

                <div class="col-sm-6">
                    <select id="moment-event_id" name="event_id" class="form-control">
                      <option value="0">---</option>
                      @foreach ($events as $event)
                        <option value="{{$event->id}}">{{$event->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <!-- moment Description -->
            <div class="form-group">
                <label for="moment-description" class="col-sm-3 control-label">Moment Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="moment-description" class="form-control"></textarea>
                </div>
            </div>

            <!-- moment Date/Time -->
            <div class="form-group text-center">
                <label for="moment-time" class="col-sm-3 control-label">Moment Time</label>
                <div class='col-sm-6'>
                  <div class='input-group date' id='moment-time'>
                      <input type='text' name="time" class="form-control" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
            </div>

            <!-- moment Url -->
            <div class="form-group">
                <label for="moment-url" class="col-sm-3 control-label">Moment Url</label>

                <div class="col-sm-6">
                    <input type="text" name="url" id="moment-url" class="form-control">
                </div>
            </div>

            <!-- moment Type -->
            <div class="form-group">
                <label for="moment-type" class="col-sm-3 control-label">Moment Type</label>

                <div class="col-sm-6">
                    <input type="radio" name="type" id="moment-type" class="form-control" value="I"> Image
                    <input type="radio" name="type" id="moment-type" class="form-control" value="V"> Video
                </div>
            </div>

            <!-- Add Moment Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Moment
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Tasks -->
    @if (count($moments) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Moments
            </div>

            <div class="panel-body">
                <table class="table table-striped moment-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Event Name</th>
                        <th>Moment Description</th>
                        <th>Moment Time</th>
                        <th>Moment Url</th>
                        <th>Moment Type</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($moments as $moment)
                            <tr>
                                <!-- Event Name -->
                                <td class="table-text">
                                    <div>{{ $moment->event->name }}</div>
                                </td>

                                <!-- Moment Description -->
                                <td class="table-text">
                                    <div>{{ $moment->description }}</div>
                                </td>

                                <!-- Moment DateTime -->
                                <td class="table-text">
                                    <div>{{ $moment->time }}</div>
                                </td>

                                <!-- Moment Url -->
                                <td class="table-text">
                                    <div>{{ $moment->url }}</div>
                                </td>

                                <!-- Moment Type -->
                                <td class="table-text">
                                    <div>{{ $moment->type == 'I' ? 'Image' : 'Video' }}</div>
                                </td>

                                <td>
                                  <form action="{{ url('moment/'.$moment->id.'/edit') }}" method="GET">
                                      {!! csrf_field() !!}

                                      <button type="submit" id="update-moment-{{ $moment->id }}" class="btn">
                                          <i class="fa fa-btn fa-edit"></i>Edit
                                      </button>
                                  </form>

                                  <form action="{{ url('moment/'.$moment->id) }}" method="POST">
                                      {!! csrf_field() !!}
                                      {!! method_field('DELETE') !!}

                                      <button type="submit" id="delete-moment-{{ $moment->id }}" class="btn btn-danger">
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
    <script type="text/javascript">
        $(function () {
            $('#moment-time').datetimepicker({
              locale: 'pt-br',
              format: 'HH:mm'
            });
        });
    </script>
@endsection
