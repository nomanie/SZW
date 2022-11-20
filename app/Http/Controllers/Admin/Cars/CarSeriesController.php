<?php

namespace App\Http\Controllers\Admin\Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Cars\StoreCarSeriaRequest;
use App\Http\Requests\System\Cars\UpdateCarSeriaRequest;
use App\Models\System\Cars\CarSeria;

class CarSeriesController extends Controller
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
     * @param  \App\Http\Requests\System\Cars\StoreCarSeriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarSeriaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System\Cars\CarSeria  $carSeria
     * @return \Illuminate\Http\Response
     */
    public function show(CarSeria $carSeria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System\Cars\CarSeria  $carSeria
     * @return \Illuminate\Http\Response
     */
    public function edit(CarSeria $carSeria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\System\Cars\UpdateCarSeriaRequest  $request
     * @param  \App\Models\System\Cars\CarSeria  $carSeria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarSeriaRequest $request, CarSeria $carSeria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\Cars\CarSeria  $carSeria
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarSeria $carSeria)
    {
        //
    }
}
