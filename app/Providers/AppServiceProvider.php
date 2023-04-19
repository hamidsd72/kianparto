<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\ApiCurl;
use App\Models\HomeSlider;
use App\Models\Meta;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\About;
use App\Models\SiteWord;
use App\Models\OperationRentList;
use App\Models\Operation;
use App\Models\OperationMessage;
use App\Models\OperationCat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->url = $request->fullUrl();
        Schema::defaultStringLength(191);
        view()->composer('layouts.front.nav', function ($view) {
            $view->with('logo', Setting::first()->logo);
            $view->with('slide', HomeSlider::where('status', 'active')->where('type', 'slider0')->first());
        });
        view()->composer('layouts.front.footer', function ($view) {
            $view->with('logo',     Setting::first()->logo);
            $view->with('about',    About::where('type', 'footer')->first());
            $view->with('contact',  Contact::first());
            $view->with('links',    OperationCat::where('parent_id', 0)->where('home_view', 'active')->get());
        });
        view()->composer('layouts.front', function ($view) {

             $sett=Setting::first();
             $seo = Meta::where('link', $this->url)->first();
             if (is_null($seo)) {
                 $seo = Meta::where('link', $this->url . '/')->first();
                 if (is_null($seo)) {
                     $seo = Meta::where('link', explode('?', $this->url)[0])->first();
                     if (is_null($seo)) {
                         $seo = Meta::where('link', explode('?', $this->url)[0] . '/')->first();
                     }
                 }
             }
             if (!is_null($seo)) {
                    $seo_set=false;
                   if(status_check($seo))
                    {
                       $seo_set=true;
                    }
                    if($seo_set)
                 {
                     $titleSeo = read_lang($seo,'title_page');
                     $keywordsSeo = read_lang($seo,'keyword');
                     $descriptionSeo = read_lang($seo,'description');
                 }
             }
             else {
                 $titleSeo =read_lang($sett,'title');
                 $keywordsSeo = read_lang($sett,'keywords');
                 $descriptionSeo = read_lang($sett,'description');
             }
             $view
                 ->with('urlPage', $this->url)
                 ->with('fav_icon', $sett->icon && is_file($sett->icon->path)?url($sett->icon->path):url('assets/front/img/favicon.png'))
                 ->with('logo', $sett->logo && is_file($sett->logo->path)?url($sett->logo->path):url('assets/front/img/logo.png'))
                 ->with('contact_info', Contact::first())
                 ->with('about_footer', About::where('type','footer')->first())
                 ->with('word_header', SiteWord::where('place_out','هدر')->get())
                 ->with('word_footer', SiteWord::where('place_out','فوتر')->get())
                 ->with('contact_home', Contact::first())
                 ->with('operation_cats', OperationCat::where('parent_id',0)->where('status','active')->get())
                 ->with('titleSeo', $titleSeo)
                 ->with('keywordsSeo', $keywordsSeo)
                 ->with('descriptionSeo', $descriptionSeo);
         });
        view()->composer('layouts.admin', function ($view) {
            if(Auth::check())
            {

                $operation_rental_all=OperationRentList::where('seen','no');
             if(Auth::user()->hasRole('User') || Auth::user()->hasRole('UserAgent'))
                    {
                        $operation_rental_all=$operation_rental_all->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $operation_rental_all=$operation_rental_all->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $operation_id=Operation::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $operation_rental_all=$operation_rental_all->whereIN('operation_system_id',$operation_id);
                    }
            $operation_rental_all=$operation_rental_all->count();
            
             $operation_rental_no=OperationRentList::where('status','active')->where('operation_type','company')->where('status_reserve','no')->where('status_record','site')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $operation_rental_no=$operation_rental_no->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $operation_rental_no=$operation_rental_no->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $operation_id=Operation::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $operation_rental_no=$operation_rental_no->whereIN('operation_system_id',$operation_id);
                    }
            $operation_rental_no=$operation_rental_no->count();
            
              $operation_rental_yes=OperationRentList::where('status','active')->where('operation_type','company')->where('status_reserve','yes')->where('status_record','site')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $operation_rental_yes=$operation_rental_yes->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $operation_rental_yes=$operation_rental_yes->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $operation_id=Operation::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $operation_rental_yes=$operation_rental_yes->whereIN('operation_system_id',$operation_id);
                    }
            $operation_rental_yes=$operation_rental_yes->count();
            
             $operation_rental_pending=OperationRentList::whereIN('status',['pending','blocked'])->where('operation_type','company')->where('status_record','site')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $operation_rental_pending=$operation_rental_pending->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $operation_rental_pending=$operation_rental_pending->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $operation_id=Operation::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $operation_rental_pending=$operation_rental_pending->whereIN('operation_system_id',$operation_id);
                    }
            $operation_rental_pending=$operation_rental_pending->count();
            
             $operation_rental_api=OperationRentList::where('status_record','api')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $operation_rental_api=$operation_rental_api->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $operation_rental_api=$operation_rental_api->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $operation_id=Operation::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $operation_rental_api=$operation_rental_api->whereIN('operation_system_id',$operation_id);
                    }
            $operation_rental_api=$operation_rental_api->count();
            
               $operation_rental_col=OperationRentList::where('operation_type','colleague')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $operation_rental_col=$operation_rental_col->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $operation_rental_col=$operation_rental_col->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $operation_id=Operation::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $operation_rental_col=$operation_rental_col->whereIN('operation_system_id',$operation_id);
                    }
            $operation_rental_col=$operation_rental_col->count();
            
            $view
                ->with('operation_rental_all', $operation_rental_all)
                ->with('operation_rental_no', $operation_rental_no)
                ->with('operation_rental_yes', $operation_rental_yes)
                ->with('operation_rental_pending', $operation_rental_pending)
                ->with('operation_rental_api', $operation_rental_api)
                ->with('operation_rental_col', $operation_rental_col)
                ->with('operation_message', OperationMessage::where('seen','no')->count())
                ->with('contact_form', ContactForm::where('seen','no')->count())
                ->with('setting', Setting::first());
            }
            
        });
    }


}
