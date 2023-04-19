<?php

namespace App\Http\Controllers\Front;

use App\Models\ApiCurl;
use App\Models\Operation;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\OperationSlider;
use App\Models\HomeSlider;
use App\Models\AboutTab;
use App\Models\helpers;
use App\Models\OperationReserve;
use App\Models\OperationRentList;
use App\Models\User;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\CountryCode;
use App\Models\EstateOption;
use App\Models\OperationRentOptionList;
use App\Models\About;
use App\Models\Blog;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\GalleryCategory;
use App\Models\OperationSeen;
use App\Models\UserComplete;
use App\Models\OperationMessage;
use App\Models\OperationTopContent;
use App\Models\OperationStory;
use App\Models\OperationComment;
use App\Models\OperationConsultation;

use App\Mail\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index($lang='en')
    {
        // $sliders = $sliders->filter(function ($slider) {
        //     if (status_check($slider)) {
        //         return $slider;
        //     }
        // });
        $sliders = HomeSlider::where('status', 'active')->whereIn('type', ['slider1','slider2','slider3','slider4','slider5'])->get();
        $sliderOne  = $sliders->where('type', 'slider1')->sortBy('sort');
        $sliderTwo  = $sliders->where('type', 'slider2')->sortBy('sort');
        $sliderTree = $sliders->where('type', 'slider3')->sortBy('sort');
        $sliderFour = $sliders->where('type', 'slider4')->sortBy('sort');
        $sliderFive = $sliders->where('type', 'slider5')->sortBy('sort');
        
        $about      = About::where('type', 'home')->first();
        // $contact_home = Contact::first();
        // $services = OperationCat::where('service_view','active')->take(4)->get();
        // $services = $services->filter(function ($service) {
        //     if (status_check($service)) {
        //         return $service;
        //     }
        // });
        $blogs = Blog::orderByDesc('id')->get();

        // $story_cats= OperationCat::where('home_view','active')->get();
        // $services = $story_cats->filter(function ($story_cat) {
        //     if (status_check($story_cat)) {
        //         return $story_cat;
        //     }
        // });

        $logo   = Setting::first()->logo;

        return view('front.index', compact('logo','sliderOne','sliderTwo','sliderTree','sliderFour','sliderFive','blogs','sliders', 'about'), ['title' => 'index']);
    }


    public function landingfa()
    {
        $sliders = EstateSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
        session()->put('locale', "FA");
        return view('front.landing.fa', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
public function landingar()
    {
        $sliders = EstateSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
                session()->put('locale', "AR");
        return view('front.landing.ar', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
    public function landingru()
    {
        $sliders = EstateSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
                session()->put('locale', "RU");
        return view('front.landing.ru', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
    public function landingen()
    {
        $sliders = EstateSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
                session()->put('locale', "EN");

        return view('front.landing.en', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }


    public function contact_post($lang='en',Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'subject' => 'required|max:250',
            'message' => 'required',
            'captcha' => 'required',
        ]);
        if($request->captcha!=session('captcha_code'))
        {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_captcha'));
        }
        try {
            $item = ContactForm::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            return redirect()->back()->with('flash_message', read_lang_word('پیام', 'success_form'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }


    public function blog_list($lang='en')
    {
        $items = Blog::orderByDesc('id')->get();
        $items = $items->filter(function ($item) {
            if (status_check($item)) {
                return $item;
            }
        });
        $title = $title = read_lang_word('هدر-صفحات-داخلی', 'blog');
        return view('front.blog.index', compact('items'), ['title' => $title]);
    }

    public function blog_show($lang='en',$id)
    {
        $item = Blog::where('id', $id)->firstOrFail();
        $blogs = Blog::where('status','active')->orderByDesc('id')->take(5)->get();
        $cats = OperationCat::where('status','active')->where('parent_id','!=',0)->orderByDesc('id')->take(5)->get();
        $item->seen += 1;
        $item->update();

        return view('front.blog.show', compact('item','blogs','cats'), ['title' => read_lang($item, 'title')]);
    }

    public function gallery($lang='en')
    {
        $items = GalleryCategory::orderBy('sort')->get();
        $items = $items->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
        return view('front.gallery.index', compact('items'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'gallery')]);
    }


    public function filter_car_id($lang='en',Request $request,$slug)
    {
        try {
            $cat=CarCat::where('slug',$slug)->firstOrFail();
            if (!status_check($cat)) {
                abort(404);
            }
            $car_cats=CarCat::where('id','!=',$cat->id)->whereHas('photo')->get();
            $car_cats = $car_cats->filter(function ($cat) {
                if (status_check($cat)) {
                    return $cat;
                }
            });
            $car_joins=CarJoin::where('cat_id',$cat->id)->select('car_id')->get()->toArray();
            $cars=Car::whereIN('id',$car_joins)->get();
            if (count($cars) <= 0) {
                return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e'));
            }

            $whatsapp_car = Contact::first()->whatsapp_car;

            CarSeen::create([
                'type' => 'list_cat',
                'title_cat' => $cat->title,
                'ip' => ip_address(),
                'country' => country_ip(),
                'car_id' => 0,
            ]);

            $title=read_lang($cat,'title');
            return view('front.car.index_2', compact('cars','car_cats', 'whatsapp_car'), ['title' => $title]);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e'));
        }
    }


    public function rental_conditions($lang='en')
    {
        $item = About::where('type', 'conditions')->first();
        return view('front.conditions', compact('item'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'conditions')]);
    }





    public function receipt($lang='en',$id)
    {
        $tl2rial = Setting::first() ? Setting::first()->rial : 2000;
        $item = CarRentList::where('rent_code', $id)->firstOrFail();

        $price = $item->final_price;
        if (auth()->check() && auth()->user()->hasRole('UserAgent') && auth()->id() == $item->customer_system_id) {
            if ($item->pay_type == 'paynkolay') {
                $price = (int)$item->price_all + (int)$item->off_price;
            } else {
                $price = (int)$item->price_all + (int)$item->off_price;
                $price = $price * $tl2rial;
            }
        }
        $car = $item->car;
        if (!$car) {
            abort(404);
        }
        return view('front.receipt', compact('item', 'car', 'price'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'chap')]);
    }



    public function operation_show($lang='en', $id){
        $item = OperationCat::findOrFail($id);
        $blogs = Blog::orderByDesc('id')->take(3)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $storybf=$item->stories->where('type','B/A Photos')->first();
        $story_experiences =$item->stories->where('type','experiences')->first();
        $story_reviews=$item->stories->where('type','reviews')->first();
        $topContents =$item->topContents;
        $topContents = $topContents->filter(function ($topContent) {
            if (status_check($topContent)) {
                return $topContent;
            }
        });
        $sliders =$item->sliders;
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $articles =$item->articles;
        $articles = $articles->filter(function ($article) {
            if (status_check($article)) {
                return $article;
            }
        });
        $tabs =$item->tabs;
        $tabs = $tabs->filter(function ($tab) {
            if (status_check($tab)) {
                return $tab;
            }
        });
        $faqs =$item->faqs;
        $faqs = $faqs->filter(function ($faq) {
            if (status_check($faq)) {
                return $faq;
            }
        });
        $whatsapp=Contact::first()->get('whatsapp');

                $comments=$item->comments;
        $comments = $comments->filter(function ($comment) {
            if (status_check($comment)) {
                return $comment;
            }
        });
        return view('front.operation.show',compact('topContents','comments','whatsapp','faqs','tabs','articles','sliders','item','blogs','storybf','story_experiences','story_reviews'));

    }

    public function operation_comment($lang='en',Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email',
            'message' => 'required',
            'captcha' => 'required',
        ]);
        if($request->captcha!=session('captcha_code'))
        {
            return redirect()->back() ->withInput()->withErrors([ 'login' => 'لطفا کد امنیتی را صحیح وارد کنید', ]);}
        try {
            $item = OperationComment::create([
                'name' => $request->name,
                'email' => $request->email,
                'operation_cat_id' => $request->operation_cat_id,
                'message' => $request->message,
            ]);
            if (!function_exists('del_img')) {
                function del_img()
                {
                    foreach (range(100,199) as $i)
                    {
                        if(is_file($i.'.png'))
                        {
                            File::delete($i.'.png');
                        }
                    }
                }
            }
            return redirect()->back()->with('flash_message', read_lang_word('پیام', 'success_form'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }

    public function operation_consultation($lang='en',Request $request)
    {
//        return $request;
        $this->validate($request, [
            'name' => 'required|max:200',
            'surname' => 'required|max:200',
            'email' => 'required|email',
            'message' => 'required',
            'captcha' => 'required',
        ]);
        if($request->captcha!=session('captcha_code'))
        {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_captcha'));
        }
        try {
            $item = OperationConsultation::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'operation_cat_id' => $request->operation_cat_id ==0 ? null:$request->operation_cat_id,
                'message' => $request->message,
            ]);

            $sett = Setting::first();
            if ($request->operation_cat_id==0){
                $page_name='صفحه اصلی';
            }else{
                $operation = OperationCat::findOrFail($request->operation_cat_id);
                $page_name=$operation->title;
            }
            if ($sett && !blank($sett->email)) {
                $text = '<p>';
                $text .= 'نام: ';
                $text .= '<strong>';
                $text .= $item->name;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'نام خانوادگی: ';
                $text .= '<strong>';
                $text .= $item->surname;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'دسته بندی: ';
                $text .= '<strong>';
                $text .= $page_name;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'پیام: ';
                $text .= '<strong>';
                $text .= $item->message;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'ایمیل: ';
                $text .= '<strong dir="ltr">';
                $text .= $item->email;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= 'تاریخ ثبت: ';
                $text .= '<strong dir="ltr">';
                $text .= $item->created_at;
                $text .= '</strong>';
                $text .= '</p>';
                $mail_data = [
                    'subject' => 'فرم درخواست مشاوره',
                    'title' => 'ارسال فرم درخواست مشاوره جدید ',
                    'body' => $text,
                ];

                \Mail::to($sett->email)->send(new Mail($mail_data));
            }

            return redirect()->back()->with('flash_message', read_lang_word('پیام', 'success_form'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }


    public function doctors_list($lang='en')
    {
        $items = Doctor::orderByDesc('id')->get();
        $items = $items->filter(function ($item) {
            if (status_check($item)) {
                return $item;
            }
        });
        $title = $title = read_lang_word('هدر-صفحات-داخلی', 'doctor');

        return view('front.doctor.index', compact('items'), ['title' => $title]);
}
    public function doctor_show($lang='en',$id)
    {
        $item = Doctor::where('id', $id)->firstOrFail();

        return view('front.doctor.show', compact('item'), ['title' => read_lang($item, 'title')]);
    }
    public function contact($lang='en')
    {
        $item = Contact::first();
        return view('front.contact', compact('item'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'contact')]);
    }
    public function about($lang='en')
    {
        $item = About::where('type', 'about')->first();
        return view('front.about', compact('item'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }
}
