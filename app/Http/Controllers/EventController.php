<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Event;
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

        return view('events.index', [
            'events' => $events
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
            'longitude_coordinate' => 'required|max:100'
          ]);

          $request->datetime = $date_formatted;
          $input = $request->all();
          $input['datetime'] = $date_formatted;

          $event  = Event::Create($input);

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
        //
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
        //
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
