<!-- resources/views/moments/index.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <h1 class="text-center">Moments</h1>
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- update moment Form -->
        <form action="{{ url('moment/'.$moment->id) }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <!-- Event Id -->
            <div class="form-group">
                <label for="moment-event-id" class="col-sm-3 control-label">Event</label>

                <div class="col-sm-6">
                    <select id="moment-event_id" name="event_id" class="form-control">
                      <option value="0">---</option>
                      @foreach ($events as $event)
                        @if ($event->id == $moment->event_id)
                          <option value="{{$event->id}}" selected="selected">{{$event->name}}</option>
                        @else
                          <option value="{{$event->id}}">{{$event->name}}</option>
                        @endif
                      @endforeach
                    </select>
                </div>
            </div>

            <!-- moment Description -->
            <div class="form-group">
                <label for="moment-description" class="col-sm-3 control-label">Moment Description</label>

                <div class="col-sm-6">
                    <textarea name="description" id="moment-description" class="form-control">{{$moment->description}}</textarea>
                </div>
            </div>

            <!-- moment Date/Time -->
            <div class="form-group text-center">
                <label for="moment-time" class="col-sm-3 control-label">Moment Time</label>
                <div class='col-sm-6'>
                  <div class='input-group date' id='moment-time'>
                      <input type='text' name="time" class="form-control" value="{{$moment->time}}"/>
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
                    <input type="text" name="url" id="moment-url" class="form-control" value="{{$moment->url}}">
                </div>
            </div>

            <!-- moment Type -->
            <div class="form-group">
                <label for="moment-type" class="col-sm-3 control-label">Moment Type</label>

                <div class="col-sm-6">
                    @if ($moment->type == 'I')
                      <input type="radio" name="type" id="moment-type" class="form-control" value="I" checked="checked"> Image
                      <input type="radio" name="type" id="moment-type" class="form-control" value="V"> Video
                    @else
                      <input type="radio" name="type" id="moment-type" class="form-control" value="I"> Image
                      <input type="radio" name="type" id="moment-type" class="form-control" value="V" checked="checked"> Video
                    @endif
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update Moment
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#moment-time').datetimepicker({
              locale: 'pt-br',
              format: 'HH:mm'
            });
        });
    </script>
@endsection
