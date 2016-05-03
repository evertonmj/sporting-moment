<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Event;
use app\Team;
use app\TeamEvent;
use Carbon\Carbon;

class EventController extends Controller
{
    public function __contruct() {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('datetime', 'desc')->get();
        $teams = Team::orderBy('name', 'asc')->get();

        return view('events.index', [
            'events' => $events,
            'teams' => $teams
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:2000',
            'datetime' => 'required',
            'localization' => 'required|max:1000',
            'latitude_coordinate' => 'required|max:100',
            'longitude_coordinate' => 'required|max:100',
            'team_a' => 'required',
            'team_b' => 'required'
          ]);

          $date_formatted = Carbon::createFromFormat('d/m/Y H:i', $request->datetime);
          $input = $request->all();
          $input['datetime'] = $date_formatted;

          $event  = Event::Create($input);
          //create team_event record
          if($event != null) {
            $team_event_a = new TeamEvent();
            $team_event_a->event_id = $event->id;
            $team_event_a->team_id = $request->team_a;
            $team_event_a->save();

            $team_event_b = new TeamEvent();
            $team_event_b->event_id = $event->id;
            $team_event_b->team_id = $request->team_b;
            $team_event_b->save();
          }

          return redirect('/event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $event->datetime);
        $event->datetime = $datetime->format('d/m/Y H:i');

        return view('events.update', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required|max:255',
        'description' => 'required|max:2000',
        'datetime' => 'required',
        'localization' => 'required|max:1000',
        'latitude_coordinate' => 'required|max:100',
        'longitude_coordinate' => 'required|max:100',
        'team_a' => 'required',
        'team_b' => 'required'
      ]);

      $date_formatted = Carbon::createFromFormat('d/m/Y H:i', $request->datetime);
      $input = [
        'name' => $request->name,
        'description' => $request->description,
        'datetime' => $date_formatted,
        'localization' => $request->localization,
        'latitude_coordinate' => $request->latitude_coordinate,
        'longitude_coordinate' => $request->longitude_coordinate];

      $event  = Event::where('id', $id)->update($input);

      //create team_event record
      if($event != null) {
        $team_event_a = new TeamEvent();
        $team_event_a->event_id = $event->id;
        $team_event_a->team_id = $request->team_a;
        $team_event_a->save();

        $team_event_b = new TeamEvent();
        $team_event_b->event_id = $event->id;
        $team_event_b->team_id = $request->team_b;
        $team_event_b->save();
      }

      return redirect('/event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        //$this->authorize('destroy', $event);

        $event->delete();

        return redirect('/event');
    }
}
