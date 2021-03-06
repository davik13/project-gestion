<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Organisation;

class OrganisationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Appliaction|Factory|View
    {
        return view('auth.organisations.index', ['organisations' => Organisation::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        Organisation::create([
            'id' => Str::uuid(),
            'slug' => $request->slug,
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'type' => $request->type
        ]);

        return redirect()->route('organisations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function show(string $id): View|Factory|Application
    {
        $organisation = Organisation::find($id);

        return view('auth.organisation.show', ['organisation' => $organisation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisation $organisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        Organisation::where('id', $id)
        ->update([
            'slug' => $request->slug,
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'type' => $request->type
        ]);

    return redirect()->route('organisations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id): RedirectResponse
    {
        $organisation = Organisation::find($id);

        $organisation->delete();

        return redirect()->route('organisations.index');
    }
}
