<?php

namespace App\Http\Controllers\Front\Product;

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

class CategoryController extends Controller {


    public function show( $lang, $id=null, $slug=null ) {
        
        $links  = OperationCat::where('parent_id', 0)->where('status', 'active')->get();
        $items  = $links;
        $item   = null;
        if ($id && $slug) {
            $item   = OperationCat::where('status', 'active')->findOrFail($id);
            $items  = $item->children;
        }
        return view('front.product.category', compact('slug','item','items','links'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }

}