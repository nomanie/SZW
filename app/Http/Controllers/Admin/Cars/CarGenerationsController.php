<?php

namespace App\Http\Controllers\Admin\Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Cars\StoreCarGenerationRequest;
use App\Http\Requests\System\Cars\UpdateCarGenerationRequest;
use App\Models\System\Cars\CarGeneration;

class CarGenerationsController extends Controller
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
     * @param  \App\Http\Requests\System\Cars\StoreCarGenerationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarGenerationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System\Cars\CarGeneration  $carGeneration
     * @return \Illuminate\Http\Response
     */
    public function show(CarGeneration $carGeneration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System\Cars\CarGeneration  $carGeneration
     * @return \Illuminate\Http\Response
     */
    public function edit(CarGeneration $carGeneration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\System\Cars\UpdateCarGenerationRequest  $request
     * @param  \App\Models\System\Cars\CarGeneration  $carGeneration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarGenerationRequest $request, CarGeneration $carGeneration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\Cars\CarGeneration  $carGeneration
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarGeneration $carGeneration)
    {
        //
    }
}
