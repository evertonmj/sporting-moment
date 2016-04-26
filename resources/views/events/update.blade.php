<!-- resources/views/events/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <h1 class="text-center">Events</h1>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Event Form -->
        <form action="{{ url('event/'.$event->id) }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <!-- Event Name -->
            <div class="form-group">
                <label for="event-name" class="col-sm-3 control-label">Event Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="event-name" class="form-control" value="{{$event->name}}">
                </div>
            </div>

            <!-- Event Description -->
            <div class="form-group">
                <label for="event-description" class="col-sm-3 control-label">Event Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="event-description" class="form-control">{{$event->description}}</textarea>
                </div>
            </div>

            <!-- Event Date/Time -->
            <div class="form-group">
                <label for="event-datetime" class="col-sm-3 control-label">Event Date/Time</label>
                <div class='col-sm-6'>
                  <div class='input-group date' id='event-datetime'>
                      <input type='text' name="datetime" class="form-control" value="{{$event->datetime}}"/>
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
                    <textarea name="localization" id="event-localization" class="form-control">{{$event->localization}}</textarea>
                </div>
            </div>

            <!-- Event Coordinates -->
            <div class="form-group">
                <label for="event-coordinates" class="col-sm-3 control-label">Event Coordinates (Lat/Lon)</label>

                <div class="col-sm-6">
                    Latitude: <input type="text" name="latitude_coordinate" id="event-coordinates" class="form-control" value="{{$event->latitude_coordinate}}">
                    Longitude: <input type="text" name="longitude_coordinate" id="event-coordinates" class="form-control" value="{{$event->longitude_coordinate}}">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update Event
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#event-datetime').datetimepicker({
              locale: 'pt-br',
              format: 'DD/MM/YYYY HH:mm'
            });
        });
    </script>
@endsection
