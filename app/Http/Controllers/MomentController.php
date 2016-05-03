<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Event;
use app\Moment;
use Carbon\Carbon;

class MomentController extends Controller
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
        $moments = Moment::orderBy('time', 'desc')->get();

        return view('moments.index', [
            'events' => $events,
            'moments' => $moments
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
            'event_id' => 'required',
            'description' => 'required|max:2000',
            'time' => 'required',
            'url' => 'required|max:1000',
            'type' => 'required|max:1'
          ]);

          $time_formatted = Carbon::createFromFormat('H:i', $request->time);
          $input = $request->all();
          $input['time'] = $time_formatted;

          $moment  = Moment::Create($input);

          return redirect('/moment');
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
        $moment = Moment::find($id);
        $events = Event::orderBy('datetime', 'desc')->get();
        $time = Carbon::createFromFormat('H:i:s', $moment->time);
        $moment->time = $time->format('H:i');

        return view('moments.update', ['moment' => $moment, 'events' => $events]);
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
        'event_id' => 'required',
        'description' => 'required|max:2000',
        'time' => 'required',
        'url' => 'required|max:1000',
        'type' => 'required|max:1',
      ]);

      $time_formatted = Carbon::createFromFormat('H:i', $request->time);
      $input = [
        'event_id' => $request->event_id,
        'description' => $request->description,
        'time' => $time_formatted,
        'url' => $request->url,
        'type' => $request->type
      ];

      $moment  = Moment::where('id', $id)->update($input);

      return redirect('/moment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Moment $moment)
    {
        //$this->authorize('destroy', $moemnt);

        $moment->delete();

        return redirect('/moment');
    }
}
