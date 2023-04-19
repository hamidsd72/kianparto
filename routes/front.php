<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\Contact\ContactController;
use App\Http\Controllers\Front\About\AboutController;
use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\Product\CategoryController;
use App\Http\Controllers\Front\Product\ProductController;
use App\Http\Controllers\Front\ZarinPallController;
use App\Http\Controllers\Front\PaymentController;

Route::get('lang/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang_set');


// Route::get('operation-show/{id}', [HomeController::class,'operation_show'])->name('operation.show');
// Route::post('/operation-show/comment', [HomeController::class,'operation_comment'])->name('operation-comment.create');
// Route::post('/operation-show/consultation', [HomeController::class,'operation_consultation'])->name('operation-consultation');
// Route::get('/our-doctors/', [HomeController::class,'doctors_list'])->name('doctors.list');
// Route::get('/doctor/show/{id}', [HomeController::class,'doctor_show'])->name('doctor.show');
// Route::get('/contact-us', [HomeController::class,'contact'])->name('contact.us');
// // about us
// Route::get('/about-us', [HomeController::class,'about'])->name('about.us');

//index
// Route::get('/تأجير-السيارات-في-اسطنبول', [HomeController::class,'landingar'])->name('landing.ar');
// Route::get('/اجاره-خودرو-در-استانبول', [HomeController::class,'landingfa'])->name('landing.fa');
// Route::get('/rent-a-estate-in-istanbul', [HomeController::class,'landingen'])->name('landing.en');
// Route::get('/аренда-автомобиля-в-стамбуле', [HomeController::class,'landingru'])->name('landing.ru');

// Route::get('/filter-estate', [HomeController::class,'filter_estate'])->name('filter.estate');
// Route::get('/reserve-estate/{id}/{set?}', [HomeController::class,'reserve_estate'])->name('reserve.estate');
// Route::get('/rent-estate/level-1/{id}/{from}/{to}/{place}/{reserve_crm?}', [HomeController::class,'rent_estate_level1'])->name('rent.estate.level.1');
// Route::get('/rent-estate/level-1/{id}/show', [HomeController::class,'rent_estate_level1_show'])->name('rent.estate.level.1.show');
// Route::post('/rent-estate/level-1/post/{id}/{from}/{to}/{place}/{reserve_crm?}', [HomeController::class,'rent_estate_level1_post'])->name('rent.estate.level.1.post');

// Route::get('/filter-estate-type/{id}', [HomeController::class,'filter_estate_id'])->name('filter.estate.id');
// //send message estate
// Route::post('/message/estate/{id}/post', [HomeController::class,'estate_post'])->name('message.estate.post');
// //payment
// Route::get('/payment/send/{item_id}', [PaymentController::class,'send'])->name('payment.send');
// Route::any('/payment/back', [PaymentController::class,'back'])->name('payment.back');
// //zarinpal
// Route::get('/zarin_pall/pay/{item_id}', [ZarinPallController::class,'pay'])->name('zarin_pall.pay');
// Route::any('/zarin_pall/verify', [ZarinPallController::class,'verify'])->name('zarin_pall.verify');
// // complete info
// Route::get('/information/complete/{id}', [HomeController::class,'information_get'])->name('information.complete.get');
// Route::post('/information/complete/post/{id}', [HomeController::class,'information_post'])->name('information.complete.post');
// // Receipt
// Route::get('/receipt/{id}', [HomeController::class,'receipt'])->name('receipt');


// // Conditions
// Route::get('/rental_conditions', [HomeController::class,'rental_conditions'])->name('rental_conditions');

// // faqs
// Route::get('/faqs', [HomeController::class,'faq'])->name('faq');

// // contact us
// //Route::get('/contact-us', [HomeController::class,'contact'])->name('contact.us');
// Route::post('/contact-us/post', [HomeController::class,'contact_post'])->name('contact.us.post');


// //blogs
// Route::get('/blogs/{type?}', [HomeController::class,'blog_list'])->name('blog.list');
// Route::get('/blog/show/{id}', [HomeController::class,'blog_show'])->name('blog.show');

// //services
// Route::get('/services', [HomeController::class,'service_list'])->name('service.list');

// // gallery image&video
// Route::get('/gallery', [HomeController::class,'gallery'])->name('gallery');


//index
Route::get('/', [HomeController::class,'index'])->name('index');


// contact
Route::get('/contact', [ContactController::class,'index'])->name('contact.index');


// about
Route::get('/about', [AboutController::class,'index'])->name('about.index');


// blog
Route::get('/blogs/{type?}', [BlogController::class,'index'])->name('blog.index');
Route::get('/blog/{id}/{slug}', [BlogController::class,'show'])->name('blog.show');
Route::post('/blogs/search/', [BlogController::class,'search'])->name('blog.search');


// product
Route::get('/category/{id?}/{slug?}', [CategoryController::class,'show'])->name('category.show');
Route::get('/product/{id}/{slug}', [ProductController::class,'show'])->name('product.show');
