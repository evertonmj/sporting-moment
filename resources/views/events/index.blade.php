<!-- resources/views/events/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <h1 class="text-center">Events</h1>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Event Form -->
        <form action="{{ url('event') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Event Name -->
            <div class="form-group">
                <label for="event-name" class="col-sm-3 control-label">Event Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="event-name" class="form-control">
                </div>
            </div>

            <!-- Event Description -->
            <div class="form-group">
                <label for="event-description" class="col-sm-3 control-label">Event Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="event-description" class="form-control"></textarea>
                </div>
            </div>

            <!-- Event Date/Time -->
            <div class="form-group text-center">
                <label for="event-datetime" class="col-sm-3 control-label">Event Date/Time</label>
                <div class='col-sm-6'>
                  <div class='input-group date' id='event-datetime'>
                      <input type='text' name="datetime" class="form-control" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
            </div>

            <!-- Event Localization -->
            <div class="form-group">
                <label for="event-localization" class="col-sm-3 control-label">Event Localization</label>

                <div class="col-sm-6">
                    <textarea name="localization" id="event-localization" class="form-control"></textarea>
                </div>
            </div>

            <!-- Event Coordinates -->
            <div class="form-group">
                <label for="event-coordinates" class="col-sm-3 control-label">Event Coordinates (Lat/Lon)</label>

                <div class="col-sm-6">
                    Latitude: <input type="text" name="latitude_coordinate" id="event-coordinates" class="form-control">
                    Longitude: <input type="text" name="longitude_coordinate" id="event-coordinates" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Event
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Tasks -->
    @if (count($events) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Events
            </div>

            <div class="panel-body">
                <table class="table table-striped event-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Event Name</th>
                        <th>Event Description</th>
                        <th>Event Localization</th>
                        <th>Event Date/Time</th>
                        <th>Event Latitude Coordinate</th>
                        <th>Event Longitude Coordinate</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <!-- Event Name -->
                                <td class="table-text">
                                    <div>{{ $event->name }}</div>
                                </td>

                                <!-- Event Description -->
                                <td class="table-text">
                                    <div>{{ $event->description }}</div>
                                </td>

                                <!-- Event Localization -->
                                <td class="table-text">
                                    <div>{{ $event->localization }}</div>
                                </td>

                                <!-- Event DateTime -->
                                <td class="table-text">
                                    <div>{{ $event->datetime }}</div>
                                </td>

                                <!-- Event Latitude -->
                                <td class="table-text">
                                    <div>{{ $event->latitude_coordinate }}</div>
                                </td>

                                <!-- Event Longitude -->
                                <td class="table-text">
                                    <div>{{ $event->longitude_coordinate }}</div>
                                </td>

                                <td>
                                  <form action="{{ url('event/'.$event->id.'/edit') }}" method="GET">
                                      {!! csrf_field() !!}

                                      <button type="submit" id="update-event-{{ $event->id }}" class="btn">
                                          <i class="fa fa-btn fa-edit"></i>Edit
                                      </button>
                                  </form>

                                  <form action="{{ url('event/'.$event->id) }}" method="POST">
                                      {!! csrf_field() !!}
                                      {!! method_field('DELETE') !!}

                                      <button type="submit" id="delete-event-{{ $event->id }}" class="btn btn-danger">
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
            $('#event-datetime').datetimepicker({
              locale: 'pt-br',
              format: 'DD/MM/YYYY HH:mm'
            });
        });
    </script>
@endsection
