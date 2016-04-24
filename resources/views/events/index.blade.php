<!-- resources/views/events/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Event Form -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
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
                    <input type="text" name="description" id="event-description" class="form-control">
                </div>
            </div>

            <!-- Event DateTime -->
            <div class="form-group">
                <label for="event-datetime" class="col-sm-3 control-label">Event Date/Time</label>

                <div class="col-sm-6">
                    <input type="text" name="datetime" id="event-datetime" class="form-control">
                </div>
            </div>

            <!-- Event Localization -->
            <div class="form-group">
                <label for="event-localization" class="col-sm-3 control-label">Event Localization</label>

                <div class="col-sm-6">
                    <input type="text" name="localization" id="event-localization" class="form-control">
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

    <!-- TODO: Current Tasks -->
@endsection
