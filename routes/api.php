<?php

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Place;
use Illuminate\Support\Facades\Storage;
use App\User;
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

Route::get('/places', function (Request $request) {
    return Place::all();
});
Route::get('/place/{id}', function (Request $request, $id) {
    return Place::find($id);
});


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('test', function () {
        $user = \Auth::user();
        return $user;
    });
});

Route::post('/user/create', function(Request $request) {
    // dd($request);
    return User::create([
        'username' => $request->input('name'),
        'lat' => $request->input('lat'),
        'lng' => $request->input('lng'),
        'image_path' => $request->input('image_path'),
        'description' => $request->input('description')
    ]);
});
Route::post('/places/create', function(Request $request) {
    return $request->input('base64');
    if($request->input('base64')) {
        $data = $request->input('base64');
        list($extencion, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        list(, $extencion) = explode('/', $extencion);
        $data = base64_decode($data);
        $ts = date('Y_m_d_h_i_s');
        $n=rand(1, 100);
        $name = "{$ts}_{$n}";
        Storage::put("$name.$extencion", $data, "public");
        return json_encode(
            array(
                'url' => Storage::url("$name.$extencion")
            )
        );
    }
    // $base64 = $request->input('base64');
    // list($extencion, $decoded64) = explode(';', $base64);
    // list(, $decoded64) = explode(',', $decoded64);
    // list(, $extencion) = explode('/', $extencion);
    // $decoded64 = base64_decode($decoded64);
    // dd($_SERVER['DOCUMENT_ROOT']);
    // dd($request->input('name'));
    // if($request->input('token')) {
        // return Place::create([
        //     'name' => $request->input('name'),
        //     'lat' => $request->input('lat'),
        //     'lng' => $request->input('lng'),
        //     'image_path' => $request->input('image_path'),
        //     'description' => $request->input('description')
        // ]);
    // }
});