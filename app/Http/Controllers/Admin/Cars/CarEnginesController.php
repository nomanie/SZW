<?php

namespace App\Http\Controllers\Admin\Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Cars\StoreCarEngineRequest;
use App\Http\Requests\System\Cars\UpdateCarEngineRequest;
use App\Models\System\Cars\CarEngine;

class CarEnginesController extends Controller
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
     * @param  \App\Http\Requests\System\Cars\StoreCarEngineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarEngineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System\Cars\CarEngine  $carEngine
     * @return \Illuminate\Http\Response
     */
    public function show(CarEngine $carEngine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System\Cars\CarEngine  $carEngine
     * @return \Illuminate\Http\Response
     */
    public function edit(CarEngine $carEngine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\System\Cars\UpdateCarEngineRequest  $request
     * @param  \App\Models\System\Cars\CarEngine  $carEngine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarEngineRequest $request, CarEngine $carEngine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\Cars\CarEngine  $carEngine
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarEngine $carEngine)
    {
        //
    }
}
