<?php

namespace App\Http\Controllers;

use App\Field;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Subscriber::with(['fields'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return [
            'states' => $Subscriber::$states,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Subscriber::$rules);

        Subscriber::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate(Subscriber::$rules);

        $existingRecord = Subscriber::find($id);

        if ($existingRecord) {
            $existingRecord->update($validatedData);
        }

        if ($request->input('fields')) {
            // Validator::make($request->input('fields'), [
            //     'fields.title' => 'required',
            //     'fields.type' => 'required',
            //     'fields.subscriber_id' => 'required',
            // ])->validate();
            foreach ($request->input('fields') as $field) {
                if ($field['id']) {
                    Field::find($field['id'])->update($field);
                } else {
                    Field::create($field);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
