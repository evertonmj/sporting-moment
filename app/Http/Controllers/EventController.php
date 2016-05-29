<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Event;
use app\Team;
use app\TeamEvent;
use app\UserEvent;
use app\Moment;
use Carbon\Carbon;
use DB;
use PDO;

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
        $result = ['success' => 0, 'message' => 'Whoops, we have an error'];
        $event = Event::find($id);

        if($event != null) {
            $result['success'] = 1;
            $result['message'] = 'Your event!';
            $result['event'] = $event->toArray();
            $result['event']['teams'] = $event->teams;
            $result['event']['moments'] = $event->moments;
        }
        //$moments = Moment::where('event_id', $id)->whereRaw("time > date_sub(now(), interval ? minute)", [$time_frame])->orderBy('time', 'desc')->get();

        return response()->json($result);

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
        //'team_a' => 'required',
        //'team_b' => 'required'
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
      /*if($event != null) {
        $team_event_a = new TeamEvent();
        $team_event_a->event_id = $event->id;
        $team_event_a->team_id = $request->team_a;
        $team_event_a->save();

        $team_event_b = new TeamEvent();
        $team_event_b->event_id = $event->id;
        $team_event_b->team_id = $request->team_b;
        $team_event_b->save();
      }*/

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

    /**
    * Checks if user is near event
    */
    public function checkIfUserIsNearEvent(Request $request, $latitude, $longitude, $distance_area) {
      $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

      $lat = $request->latitude;
      $lon = $request->longitude;
      $distance_area = $request->distance_area;

      $event = Event::selectRaw('*, (6371 * acos( cos( radians(?) )
                     * cos( radians( latitude_coordinate ) ) * cos( radians( longitude_coordinate ) - radians(?) )
                     + sin( radians(?) )
                     * sin( radians( latitude_coordinate ) ) ) ) AS distance', [$lat, $lon, $lat])
                   ->having('distance', '<=', $distance_area)
                   ->with('teams')
                   ->get();

      if($event != null) {
        $result['success'] = 1;
        $result['message'] = 'We have event(s)!';
        $result['event'] = $event;
        //$result['event']['teams'] = $event->teams;
      } else {
        $result['message'] = "Error - Event not found.";
      }

      return response()->json($result);
    }

    /**
    * Save user on event
    */
    public function saveUserOnEvent(Request $request) {
      $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

      if(isset($request->event_id, $request->user_id)) {
        $userEvent = new UserEvent();
        $userEvent->user_id = $request->user_id;
        $userEvent->event_id = $request->event_id;

        if($userEvent->save()) {
          $result['success'] = 1;
          $result['message'] = "Yes, user is on event!";
        }
      }
      return response()->json($result);
    }

    /**
    * Save user chair status
    */
    public function saveUserChairStatus(Request $request) {
      $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

      if(isset($request->user_id, $request->event_id, $request->on_chair)) {
        $userEvent = UserEvent::where(['event_id' => $request->event_id, 'user_id' => $request->user_id] )->first();

        if($userEvent != null) {
          $userEvent->is_on_chair = $request->on_chair;
          if($userEvent->save()) {
            $result['success'] = 1;
            $result['message'] = "Yes, user chair status updated";
          }
        }
      }

      return response()->json($result);
    }

    /**
    * Check if there's important moments and return count
    */
    public function checkIfImportantMomentHasOccured(Request $request, $id, $time_frame) {
      $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

      $event = Event::find($id);

      if($event != null) {
        $moments = Moment::where('event_id', $id)->whereRaw("time > date_sub(now(), interval ? minute)", [$time_frame])->get();

        if($moments->count() > 0) {
          $result['success'] = 1;
          $result['message'] = "Yes, we have important moments!";
          $result['moments'] = $moments->count();
        } else {
          $result['success'] = 1;
          $result['message'] = "No moments found!";
          $result['moments'] = 0;
        }
      }

      return response()->json($result);
    }

    public function getImportantMoments(Request $request, $id, $time_frame) {
      $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

      $event = Event::find($id);

      if($event != null) {
        $moments = Moment::where('event_id', $id)->whereRaw("time > date_sub(now(), interval ? minute)", [$time_frame])->orderBy('time', 'desc')->get();

        if($moments->count() > 0) {
          $result['success'] = 1;
          $result['message'] = "Yes, we have important moments!";
          $result['moments'] = $moments;
        } else {
          $result['success'] = 0;
          $result['message'] = "No moments found!";
        }
      }

      return response()->json($result);
    }

    public function getEventsToday(Request $request) {
      $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

      $events = Event::whereRaw('DATE(datetime) = ?', [date('Y-m-d')])->with('teams')->get();

      if($events->count() > 0) {
        $result['success'] = 1;
        $result['message'] = "Yes, we have events today!";

        $result['events'] = $events;
      } else {
        $result['success'] = 0;
        $result['message'] = "We have no events today...";
      }

      return response()->json($result);
    }
}
