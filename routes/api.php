<?php

use App\Models\PartList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/part', function(Request $request) {

    if (!$request->term) {
        return response()->json("no data", 404);
    }
    
    $parts = PartList::select('partno', 'partname', 'partnameeng')
            ->distinct()
            ->where('partno', 'LIKE', '%'.$request->term.'%')
            ->wherenotnull('partname')
            ->limit(5)->get();

    $data = array();
    foreach ($parts as $part) {
        $data[] = $part->partno." ".$part->partname;
    }
    //return json data
    return json_encode($data);

    //$result = new QuestionAnswerResource(Catmento_question::find($id));

    // 한글 깨짐 방지
    //return json_encode($result, JSON_UNESCAPED_UNICODE);
});

Route::get('/machine', function(Request $request) {

    if (!$request->partno ) {
        return response()->json("no data", 404);
    }
    
    $parts = PartList::select('machine')
            ->distinct()
            ->where('partno', $request->partno)
            ->where('machine', 'LIKE', '%'.$request->term.'%')
            ->get();

    $data = array();
    foreach ($parts as $part) {

        $data[] = $part->machine;

    }

    //return json data
    return json_encode($data);

});
