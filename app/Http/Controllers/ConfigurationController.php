<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.configuration.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $configIdentifier = Configuration::all()->last();
        if(!is_null($configIdentifier->identifier)){
            $config = explode(' ',$configIdentifier->identifier);
            $identifier = $config[1]+1;
        }else{
            $identifier = 1;
        }
//        return $identifier;
        return view('admin.configuration.create',compact('identifier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function disable(Request $request){
        Configuration::where('status', 1)->update(['status'=>0]);
        return "Success";
    }

    public function store(Request $request)
    {
//        return $request;
       Configuration::create([
           'name'=>$request->name,
           'value'=>$request->value,
           'type'=>$request->type,
           'status' => 1,
           'identifier' => $request->identifier
       ]);
       return "Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        $configuration = Configuration::where('identifier', $configuration->identifier)->get();
        return view('admin.configuration.show', compact('configuration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
