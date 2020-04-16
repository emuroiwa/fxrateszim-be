<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte;
use App\fxcounter;
use App\fxrate;

class FxrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crawler = Goutte::request('GET', 'https://www.marketwatch.co.zw');
        //get counters
        $crawler->filter('#tablepress-4 tr td.column-1')->each(function ($value, $key)  {
            
            if (\is_string($value->text())) {
                $variables = explode(" ", $value->text());
                //get the longer description
                if (\count($variables) == 4) {
                    $fxcounter = fxcounter::firstOrNew(['id' => $key+1]);
                    $fxcounter->base_currency = $variables[0];
                    $fxcounter->quote_currency = $variables[2];
                    $fxcounter->description = $value->text();
                    $fxcounter->fxsource = $variables[3];
                    $fxcounter->save();
                   }
                //get OMIR
                if (\count($variables) == 1) {
                    $fxcounter = fxcounter::firstOrNew(['id' => $key+1]);
                    $fxcounter->base_currency = $variables[0];
                    $fxcounter->quote_currency = $variables[0];
                    $fxcounter->description = $value->text();
                    $fxcounter->fxsource = $variables[0];
                    $fxcounter->save();
                }

            }
        });

        //get value
        $crawler->filter('#tablepress-4 tr td.column-2')->each(function ($value, $key)  {
            
            if (\is_numeric($value->text())) {
                $counter = fxcounter::find($key+1); 
                $rate = new fxrate;
                $rate->rate = $value->text();
                $counter = $counter->fxrate()->save($rate);
            }
        });


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

    public function setFXrates($counter)
    {
        # code...
    }
}
