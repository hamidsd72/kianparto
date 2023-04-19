<?php

namespace App\Http\Controllers\Front\About;

use App\Models\ApiCurl;
use App\Models\Operation;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\OperationSlider;
use App\Models\OperationReserve;
use App\Models\OperationRentList;
use App\Models\User;
use App\Models\Contact;
use App\Models\CountryCode;
use App\Models\ContactForm;
use App\Models\EstateOption;
use App\Models\OperationRentOptionList;
use App\Models\About;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\GalleryCategory;
use App\Models\OperationSeen;
use App\Models\UserComplete;
use App\Models\OperationMessage;
use App\Mail\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AboutController extends Controller {

    public function index() {
        $item = About::where('type', 'about')->first();
        return view('front.about.index', compact('item'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }
}
