<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\Request;

use Auth;
use Log;

class GoalController extends Controller
{
    /**
     * Marks a specific task as complete
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function markAsComplete(Request $request)
    {
        $goal = Goal::where('id', $request->id)->first();

        $goal->is_finished = true;
        
        if ($goal->save()) {
            return response()->json(200);
        }

        return response()->json(['error' => 'Goal could not be stored in the database.'], 500);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the goals where 'is_finished' is false
        // aka: get all unfinished goals!
        $goals = Goal::where('is_finished', false)
            ->get();

        return response()->json($goals);
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
        // Create a new Goal object, tack on all of the fields,
        // and save to the DB using Eloquent
        $goal = new Goal;
        $goal->user_id = Auth::user()->id;
        $goal->text = $request->text;
        $goal->is_finished = false;
        if ($goal->save()) {
            return response()->json(200);
        }

        return response()->json(['error' => 'Goal could not be stored in the database.'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        //
    }
}
