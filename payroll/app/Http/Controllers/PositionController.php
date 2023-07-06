<?php

namespace App\Http\Controllers;

use App\Models\position;
use App\Http\Requests\StorepositionRequest;
use App\Http\Requests\UpdatepositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorepositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepositionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\position  $postion
     * @return \Illuminate\Http\Response
     */
    public function show(position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepositionRequest  $request
     * @param  \App\Models\position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepositionRequest $request, position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(position $position)
    {
        //
    }
}
