<?php

namespace App\Http\Controllers;

use App\Models\AskPrice;
use App\Models\AskPriceLine;
use Auth;
use Illuminate\Http\Request;

class AskPricesController extends Controller
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
        $request->merge(['user_id' => Auth::user()->id ]);

        $askPrice = AskPrice::create($request->all());
        $askPriceId = $askPrice->id;

        foreach( $request['partname'] as $key => $n ) {
            $askpriceline =[
                'ask_price_id' => $askPriceId,
                'partname' => $request['partname'][$key],
                'machine' => $request['machine'][$key],
                'quality' => $request['quality'][$key],
                'qty' => $request['qty'][$key],

            ];
            AskPriceLine::create($askpriceline);
        }

        return redirect()->route('askprices.result', ['askPrice' => $askPriceId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AskPrice  $askPrice
     * @return \Illuminate\Http\Response
     */
    public function show(AskPrice $askPrice)
    {
        return view('askprices.show', ['askPrice' => 1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AskPrice  $askPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(AskPrice $askPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AskPrice  $askPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AskPrice $askPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AskPrice  $askPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(AskPrice $askPrice)
    {
        //
    }
}
