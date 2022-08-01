<?php

namespace App\Http\Controllers;

use App\Models\phaseItem;
use App\Http\Requests\StorephaseItemRequest;
use App\Http\Requests\UpdatephaseItemRequest;

class PhaseItemController extends Controller
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
     * @param  \App\Http\Requests\StorephaseItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorephaseItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\phaseItem  $phaseItem
     * @return \Illuminate\Http\Response
     */
    public function show(phaseItem $phaseItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\phaseItem  $phaseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(phaseItem $phaseItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatephaseItemRequest  $request
     * @param  \App\Models\phaseItem  $phaseItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatephaseItemRequest $request, phaseItem $phaseItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\phaseItem  $phaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(phaseItem $phaseItem)
    {
        //
    }
}
