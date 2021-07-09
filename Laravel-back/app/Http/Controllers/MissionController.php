<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Organisation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = Mission::all();

        return view('mission.index', ['missions' => $missions]);
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
    public function store(Request $request, Organisation $organisation): RedirectResponse
    {
        $mission = $organisation->missions()->create([
            'id' => Str::uuid(),
            'reference' => $request->input('reference'),
            'title' => $request->input('title'),
            'comment' => $request->input('comment'),
            'deposit' => $request->input('deposit'),
            'ended_at' => $request->input('ended_at')
        ]);

        $mission->missionLines()->createMany($request->input('mission_lines'));

        return redirect()->route('organisations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id): View|Factory|Application
    {
        $mission = Mission::find($id);

        return view('mission.show', ['mission' => $mission]);
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
    public function update(Request $request, string $id): RedirectResponse
    {
        Mission::where('id', $id)
        ->update([
            'reference' => $request->reference,
            'organisation_id' => $request->organisation_id,
            'title' => $request->title,
            'comment' => $request->comment,
            'deposit' => $request->deposit,
            'ended_at' => $request->ended_at
        ]);

    return redirect()->route('missions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id): RedirectResponse
    {
        $mission = Organisation::find($id);

        $mission->delete();

        return redirect()->route('missions.index');
    }
}
