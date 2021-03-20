<?php

namespace App\Http\Controllers;

use App\Jobs\publishforspeaker;
use App\recordings;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;
use RealRashid\SweetAlert\Facades\Alert;

class recordingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersIndex()
    {

        $List = recordings::all();

        return view('recordings.RecordingsList')->with([
            'List' => $List
        ]);

    }


    public function CreateRecording(Request $request)
    {


        $request->validate([
            "rid" => "nullable",
            "title" => "required",
            "description" => "required",
            "speakers" => "required",
            "play_url" => "string|nullable",
            "download_url" => "string|nullable",
            "active" => "required",

        ]);


        if (\request()->has('rid')) {

            $recording = recordings::where('id', $request->rid)->get()->first();

            if ($recording == null) {

                Alert::error('error');
                return redirect()->back();
            }

            $recording->title = $request->title;
            $recording->description = $request->description;
            $recording->speakers = $request->speakers;
            $recording->play_url = $request->play_url;
            $recording->download_url = $request->download_url;


            $recording->save();

            Alert::success('Recording Updated Successfully');

            return redirect()->back();


        }


        recordings::create([

            "title" => $request->title,
            "description" => $request->description,
            "speakers" => $request->speakers,
            "active" => true,
            "download_url" => $request->download_url,
            "play_url" => $request->play_url,
        ]);

        Alert::success('Recording Created Successfully');

        return redirect()->back();

    }

    public function adminIndex()
    {

        $user = Zoom::user()->find('info@ime-europe.eu');
        $zoom_recordings = [];
        $zoom_files = [];

        $my_index = 0;

        foreach ($user->recordings as $record){

            $recording = json_decode($record, true);
            $zoom_recordings[] = array( $recording["topic"] => [] );



            foreach ($recording["recording_files"] as $files){


                $zoom_files[] = $recording["topic"] . " (PLAY URL): " . $files["play_url"];
                $zoom_files[] = $recording["topic"] . " (DOWNLOAD URL): " . $files["download_url"];
            }



        }



        $current_recording = "";

        if (\request()->has('id')) {

            $current_recording = recordings::where('id', \request()->id)->get()->first();

        }



        return view('recordings.manage')->with([
            'zoom_recordings' => $zoom_files,
            'current_recording' => $current_recording,


        ]);


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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\recordings $recordings
     * @return \Illuminate\Http\Response
     */
    public function show(recordings $recordings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\recordings $recordings
     * @return \Illuminate\Http\Response
     */
    public function edit(recordings $recordings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\recordings $recordings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recordings $recordings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\recordings $recordings
     * @return \Illuminate\Http\Response
     */
    public function destroy(recordings $recordings)
    {
        //
    }
}
