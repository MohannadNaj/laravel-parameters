<?php

namespace Parameter\Http\Controllers;

use Parameter\Parameter\Parameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParameterController extends Controller
{
    public $supportedTypes = ['textfield','text','array','image','integer','boolean'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        set_active(['navbar'=>'index']);

        return view('parameters.index');
    }

    public function all()
    {
        set_active(['navbar'=>'all']);

        return view('parameters.all');
    }

    public function categories()
    {
        set_active(['navbar'=>'categories']);

        return view('parameters.categories');
    }

    public function logs()
    {
        set_active(['navbar'=>'logs']);

        return view('parameters.logs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        set_active(['navbar'=>'create']);

        $data['types'] = $this->supportedTypes;

        return view('parameters.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, \Parameter\Parameter\ParametersValidator::newRules($request->type));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Parameter\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Parameter\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter $parameter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Parameter\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Parameter\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        //
    }
}
