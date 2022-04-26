<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class XmlController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:xml',
        ],$messages = [
            'mimes' => 'Please upload xml file only'
        ]);

        $xmlDataString  = file_get_contents($request->file('file'));
        $xmlObject      = simplexml_load_string($xmlDataString);
                
        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json, true);

        if(count($phpDataArray['contact']) > 0){

            $dataArray = array();
            
            foreach($phpDataArray['contact'] as $index => $data) {
                $dataArray[] = [
                    "name"          => $data['name'],
                    "lastname"      => $data['lastName'],
                    "phone"         => $data['phone']
                ];
            }

            Contact::insert($dataArray);

            return back()->with('success', 'Data saved successfully!');
        }
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
        //
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
