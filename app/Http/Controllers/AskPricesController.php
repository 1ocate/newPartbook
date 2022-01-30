<?php

namespace App\Http\Controllers;

use App\Models\AskPrice;
use App\Models\AskPriceLine;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Exports\AskPriceExport;

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
        // Read user id
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

        //session::put('askPriceIdey', 'value');
        $request->session()->put('askPriceId', $askPriceId);
        return redirect()->route('askprices.result');
       
    }


    public function result(Request $request)
    {

        $askPriceId = $request->session()->get('askPriceId');
        $askPrice = AskPrice::find($askPriceId);

        //$request->session()->forget('askPriceId');
        return view('askprices.show', compact('askPrice'));

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
    
    public function export(Request $request)
    {
        //return Excel::download(new AskPriceExport, 'users.xlsx');
        $askPriceId = $request->session()->get('askPriceId');
        $request->session()->forget('askPriceId');
        //return Excel::download(new AskPriceExport, 'result.xlsx');
        $company = Auth::user()->company;
        $todayDate = date('ymd');
        return (new AskPriceExport($askPriceId))->download($company.'_'.$todayDate.'.xlsx');
        
    }
}
