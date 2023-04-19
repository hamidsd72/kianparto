<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Access\PermissionCatController;
use App\Http\Controllers\Admin\Access\PermissionController;
use App\Http\Controllers\Admin\Access\RoleController;
use App\Http\Controllers\Admin\Form\AllFormController;
use App\Http\Controllers\Admin\Operation\OperationPicController;
use App\Http\Controllers\Admin\Operation\OperationBrandController;
use App\Http\Controllers\Admin\Operation\OperationCatController;
use App\Http\Controllers\Admin\Operation\OperationStoryController;
use App\Http\Controllers\Admin\Operation\OperationTopContentController;
use App\Http\Controllers\Admin\Operation\OperationTopContentSpecificationController;
use App\Http\Controllers\Admin\Operation\OperationSliderController;
use App\Http\Controllers\Admin\Operation\OperationArticleController;
use App\Http\Controllers\Admin\Operation\OperationTabController;
use App\Http\Controllers\Admin\Operation\OperationFaqController;
use App\Http\Controllers\Admin\Operation\OperationCommentController;
use App\Http\Controllers\Admin\Operation\OperationConsultationController;
use App\Http\Controllers\Admin\Other\AboutTabController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\Operation\OperationController;
use App\Http\Controllers\Admin\Operation\OptionController;
use App\Http\Controllers\Admin\OperationRent\RentController;
use App\Http\Controllers\Admin\Setting\LangSetController;
use App\Http\Controllers\Admin\Setting\ProfileController;
use App\Http\Controllers\Admin\Setting\HomeSliderController;
use App\Http\Controllers\Admin\Setting\MetaController;
use App\Http\Controllers\Admin\Setting\AboutController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Setting\ContactController;
use App\Http\Controllers\Admin\Setting\UploadController;
use App\Http\Controllers\Admin\Setting\SelectController;
use App\Http\Controllers\Admin\Setting\CrmLangController;
use App\Http\Controllers\Admin\Setting\SiteWordController;
use App\Http\Controllers\Admin\Setting\SeenController;
use App\Http\Controllers\Admin\User\UserWorkController;
use App\Http\Controllers\Admin\User\UserApiController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserAgentController;
use App\Http\Controllers\Admin\User\UserOtherController;
use App\Http\Controllers\Admin\Blog\ArticleController;
use App\Http\Controllers\Admin\Blog\NewsController;
use App\Http\Controllers\Admin\Other\ServiceController;
use App\Http\Controllers\Admin\Other\FaqController;
use App\Http\Controllers\Admin\Gallery\GalleryController;


use App\Http\Controllers\Admin\Other\AdController;
use App\Http\Controllers\Admin\Other\BannerController;
use App\Http\Controllers\Admin\Other\InterviewController;
use App\Http\Controllers\Admin\Other\MemoryController;
use App\Http\Controllers\Admin\Other\SoundController;
use App\Http\Controllers\Admin\Other\ReportController;
use App\Http\Controllers\Admin\Other\NoteController;


//Access
Route::resource('permissionCat', PermissionCatController::class);
Route::resource('permission', PermissionController::class);
Route::resource('role', RoleController::class);

//Setting
Route::get('seen-list', [SeenController::class,'index'])->name('seen.index');

//Setting
Route::get('profile', [ProfileController::class,'show'])->name('profile.show');
Route::patch('profile/{id}/update', [ProfileController::class,'update'])->name('profile.update');

Route::resource('lang-set', LangSetController::class);
Route::get('lang-set-status/{id}/{type}/{status}', [LangSetController::class,'status'])->name('lang-set.status');

Route::resource('meta', MetaController::class);
Route::get('meta-status/{id}/{type}/{status}', [MetaController::class,'status'])->name('meta.status');

Route::resource('crm-lang', CrmLangController::class);

Route::resource('about', AboutController::class);

Route::resource('setting', SettingController::class);
Route::post('setting/percent/{id}', [SettingController::class,'percent'])->name('setting.percent');
Route::get('pic-delete/{id}', [SettingController::class,'delete_pic'])->name('pic.delete');

Route::resource('contact', ContactController::class);

Route::resource('upload', UploadController::class);

Route::resource('site-word', SiteWordController::class);

Route::resource('select', SelectController::class);
Route::get('select-status/{id}/{type}/{status}', [SelectController::class,'status'])->name('select.status');

Route::resource('home-slider', HomeSliderController::class);
Route::get('slider-status/{id}/{type}/{status}', [SliderController::class,'status'])->name('slider1.status');
//Route::resource('slider2', SliderController::class);
//Route::get('slider2-status/{id}/{type}/{status}', [Slider2Controller::class,'status'])->name('slider2.status');
Route::get('home-sliders/{type}', [HomeSliderController::class,'slider_index'])->name('sliders.index');
Route::resource('home-slider', HomeSliderController::class);

//Operation
Route::get('operations', [OperationController::class,'index'])->name('operation.index');
Route::resource('operation-topContent', OperationTopContentController::class);
//Route::resource('operation', OperationController::class);
Route::resource('operation-brand', OperationBrandController::class);
Route::resource('operation-cat', OperationCatController::class);
Route::resource('operation-story', OperationStoryController::class);
Route::resource('operation-slider', OperationSliderController::class);
Route::resource('operation-article', OperationArticleController::class);
Route::resource('operation-tab', OperationTabController::class);
Route::resource('operation-faq', OperationFaqController::class);
Route::resource('operation-comment', OperationCommentController::class);
Route::resource('operation-consultation', OperationConsultationController::class);
Route::resource('doctor', DoctorController::class);
Route::resource('about-tab', AboutTabController::class);
Route::get('delete_story_pic/{id}', [OperationStoryController::class,'delete_story_pic'])->name('pic.delete.story');


Route::resource('operation-story',OperationStoryController::class);
Route::get('estate-export-excel/{rand}', [OperationController::class,'export_excel'])->name('export.excel.estate');
Route::get('Operation-ajax/{type}/{id}', [EstateController::class,'ajax'])->name('ajax.estate');
Route::get('estate-nerkh/{id}', [OperationController::class,'nerkh_get'])->name('nerkh.get.estate');
Route::post('estate-nerkh/{id}', [OperationController::class,'nerkh_post'])->name('nerkh.post.estate');
Route::get('estate-img-list/{id}', [OperationController::class,'img_list'])->name('estate.img.list');
Route::get('estate-img-delete/{id}', [OperationController::class,'img_delete'])->name('estate.img.delete');
Route::get('estate-img-update/{id}', [OperationController::class,'img_update'])->name('estate.img.update');

Route::resource('estate-option', OptionController::class);

Route::resource('operation-pic', OperationPicController::class);
Route::get('operation-pic-status/{id}/{type}/{status}', [OperationPicController::class,'status'])->name('estate-pic.status');

//EstateRent
Route::get('estate-rent-company/{status}/{status_record}/{status_reserve?}', [RentController::class,'index'])->name('estate.rent.index');
Route::get('estate-rent-colleague', [RentController::class,'index_colleague'])->name('estate.rent.colleague.index');
Route::get('estate-rent-show/{id}', [RentController::class,'show'])->name('estate.rent.show');
Route::get('estate-rent-message', [RentController::class,'message'])->name('estate.rent.message');

//UserCustomer
Route::resource('user-customer', UserController::class);
Route::get('user-customer-status/{id}/{type}/{status}', [UserController::class,'status'])->name('user-customer.status');

//UserWork
Route::resource('user-work', UserWorkController::class);
Route::get('user-work-status/{id}/{type}/{status}', [UserWorkController::class,'status'])->name('user-work.status');

//UserApi
Route::resource('user-api', UserApiController::class);
Route::get('user-api-status/{id}/{type}/{status}', [UserApiController::class,'status'])->name('user-api.status');

//UserAgent
Route::resource('user-agent', UserAgentController::class);
Route::get('user-agent-status/{id}/{type}/{status}', [UserAgentController::class,'status'])->name('user-agent.status');

//UserOther
Route::resource('user-other', UserOtherController::class);
Route::get('user-other-status/{id}/{type}/{status}', [UserOtherController::class,'status'])->name('user-other.status');

//Form
Route::get('form/contact/list', [AllFormController::class,'contact'])->name('form.contact.index');

//Blog
Route::resource('article', ArticleController::class);
Route::resource('news', NewsController::class);

//other
Route::resource('service', ServiceController::class);

//faq
Route::resource('faq', FaqController::class);

//Gallery
Route::resource('gallery', GalleryController::class);
Route::get('gallery-status/{id}/{type}/{status}', [GalleryController::class,'status'])->name('gallery.status');
Route::post('gallery-sort/{id}', [GalleryController::class,'sort'])->name('gallery.sort');
Route::get('gallery-delete/{id}', [GalleryController::class,'delete'])->name('gallery.delete');


//Other
Route::resource('ads', AdController::class);
Route::get('ads-status/{id}/{type}/{status}', [AdController::class,'status'])->name('ads.status');

Route::resource('banner', BannerController::class);
Route::get('banner-status/{id}/{type}/{status}', [BannerController::class,'status'])->name('banner.status');

Route::resource('memory', MemoryController::class);
Route::get('memory-status/{id}/{type}/{status}', [MemoryController::class,'status'])->name('memory.status');
Route::post('memory-sort/{id}', [MemoryController::class,'sort'])->name('memory.sort');
Route::get('memory-delete/{id}', [MemoryController::class,'delete'])->name('memory.delete');

Route::resource('sound', SoundController::class);
Route::get('sound-status/{id}/{type}/{status}', [SoundController::class,'status'])->name('sound.status');


Route::get('operation-topContent/specification/{type}/{id}',        [OperationTopContentSpecificationController::class,'index'])->name('operation-top-content.specification.index');
Route::get('operation-topContent/specification/create/{type}/{id}', [OperationTopContentSpecificationController::class,'create'])->name('operation-top-content.specification.create');
Route::post('operation-topContent/specification/store',             [OperationTopContentSpecificationController::class,'store'])->name('operation-top-content.specification.store');
Route::get('operation-topContent/specification/item/{id}/edit',          [OperationTopContentSpecificationController::class,'edit'])->name('operation-top-content.specification.edit');
Route::patch('operation-topContent/specification/update/{id}',      [OperationTopContentSpecificationController::class,'update'])->name('operation-top-content.specification.update');
Route::delete('operation-topContent/specification/destroy/{id}',    [OperationTopContentSpecificationController::class,'destroy'])->name('operation-top-content.specification.destroy');
