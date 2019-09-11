<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload', function (Request $request) {
    $image =$request->file('avatar');
    $filenamewithextension = $image->getClientOriginalName();
    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    $extension = $image->getClientOriginalExtension();

    $bearer = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImViMjAzMWZkZWU3YjhmZjRmZjhjODEyODU1NDBkZGY0ZDE4MmI3NzdlZWFkNzI5ODU2NTEwZjQzZjEwOWMzOWI0YWEyNmVhZWRiZWYwMDU1In0.eyJhdWQiOiIyIiwianRpIjoiZWIyMDMxZmRlZTdiOGZmNGZmOGM4MTI4NTU0MGRkZjRkMTgyYjc3N2VlYWQ3Mjk4NTY1MTBmNDNmMTA5YzM5YjRhYTI2ZWFlZGJlZjAwNTUiLCJpYXQiOjE1NjgyMTc2ODQsIm5iZiI6MTU2ODIxNzY4NCwiZXhwIjoxNTk5ODQwMDg0LCJzdWIiOiIzNiIsInNjb3BlcyI6W119.CDqNuAtwQLvEiThzUZOABVWozq6Jqp3rL0G74w2J8Y7NPho0CWZMzO_Y-4QWkGk20Nn6vTwdwpUvPFOIVieCReu03VIcCcTm6lRLCd6xFiuWEcyO9K2tzMdowBG9tWoi75xzrTa2TmjaJgGhk_KKCCzbuXIuZ1b6mIYPYeqD5SgM99HufBe1fBo2Cm8S2MMMlhYp_tYqe_OJwEykowikV8dQJMACncqlYB7sgrdvskNxYYsOlF54zJmoDMf_ovXhznUm9jUNLKFSY6lr0ITjQ0ri3GAmtD8uMxuHrSZssTb15P8ECocCnFtHaxZugyJ3ew5DVk4ajl3zyR0ogrfDEmvrhXN6CAvquVyXKSAlsGDjihIFE86pWUZbXCm4Dp7jyMbxtudGLp_AqlJQ1rJ2gxwq9MPnE8ZeWDL4uncWmktLkzOnp09GGT9oUGK-uQlaPE8TNI6Q0gQexug7e_KpTn0-n5kU2I8ObXFnI38mOZKYBrAJlburu15lFJsARBqJrEM2ac06VLX4ObjNGbjQtlun6-wcaApvUTgHiJJR-rAQmt9PKITga9Sns5T3zF7JfTt_EB9uTOwAHKhGCVmqiF7DeXhjsM3MbueCaMLkYVR4Du1yJg3kanRW4F0EiUMY6nXQRVSoje0M4tzn5WHbec7fWsLQwpaxa8YiOVAz-J4';

    $header = array(
        "accept: application/json",
        "authorization: Bearer $bearer"
        // "cache-control: no-cache",
        // "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
    );
    // dd($filename);
    $response = Curl::to('https://api.nujek.co.id/admin-api/v1/operators/36/image')
        ->withData( array( 'id' => '36', 'avatar'=> $filenamewithextension ) )
        ->withHeaders($header)
        ->withFile( 'avatar', $image, $extension, $filenamewithextension )
        ->returnResponseObject()
        ->post();
    dd($response);

})->name('upload');
