<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Team;

class TeamController extends Controller
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
      $teams = Team::orderBy('name', 'asc')->get();

      return view('teams.index', [
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
        ]);

        $input = $request->all();

        $team  = Team::Create($input);

        return redirect('/team');
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
      $team = Team::find($id);

      return view('teams.update', ['team' => $team]);
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
    ]);

    $input = [
      'name' => $request->name,
      'description' => $request->description
    ];

    $team  = Team::where('id', $id)->update($input);

    return redirect('/team');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, Team $team)
  {
      //$this->authorize('destroy', $team);

      $team->delete();

      return redirect('/team');
  }

  public function getAllTeams(Request $request) {
    $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

    $teams = Team::get();

    if($teams->count()) {
      $result['success'] = 1;
      $result['message'] = 'Here are our teams!';
      $result['teams'] = $teams;
    } else {
      $result['success'] = 0;
      $result['message'] = 'We have no teams';
    }

    return response()->json($result);
  }

  public function getAllTeamEvents(Request $request, $team_id) {
    $result = ['success' => 0, 'message' => 'Whoops, we have an error'];

    $team = Team::find($team_id);

    if($team->events->count() > 0) {
      $results['success'] = 1;
      $result['message'] = "Yes, we have events!";
      $result['events'] = $team->events;
    } else {
      $result['success'] = 0;
      $result['message'] = "No events found!";
    }

    return response()->json($result);
  }
}
