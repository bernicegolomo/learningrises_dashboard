<?php

namespace App\Http\Controllers;

use App\Models\scores;
use App\Http\Requests\StorescoresRequest;
use App\Http\Requests\UpdatescoresRequest;

class ScoresController extends Controller
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
     * @param  \App\Http\Requests\StorescoresRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorescoresRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\scores  $scores
     * @return \Illuminate\Http\Response
     */
    public function show(scores $scores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\scores  $scores
     * @return \Illuminate\Http\Response
     */
    public function edit(scores $scores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatescoresRequest  $request
     * @param  \App\Models\scores  $scores
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatescoresRequest $request, scores $scores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\scores  $scores
     * @return \Illuminate\Http\Response
     */
    public function destroy(scores $scores)
    {
        //
    }
}
