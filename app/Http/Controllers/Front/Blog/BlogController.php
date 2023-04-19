<?php

namespace App\Http\Controllers\Front\Blog;

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
use App\Models\Lang;
use App\Mail\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BlogController extends Controller {

    public function index( $lang, $type=null ) {
        
        if ($type)  $items  = Blog::where('status', 'active')->where('type', $type)->orderByDesc('updated_at')->select(['id','title', 'text', 'author', 'key_word', 'description', 'title_page'])->paginate(10);
        else        $items  = Blog::where('status', 'active')->orderByDesc('updated_at')->select(['id','title', 'text', 'author', 'key_word', 'description', 'title_page'])->paginate(10);
        
        $links  = OperationCat::where('parent_id', 0)->where('status', 'active')->get();
        return view('front.blog.index', compact('type', 'items','links'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }

    public function show( $lang, $id, $slug ) {
        
        $item   = Blog::where('status', 'active')->select(['id','title', 'text', 'author', 'key_word', 'description', 'title_page','updated_at'])->find($id);
        $item->seen += 1;
        $item->update();
        $lastest= Blog::where('status', 'active')->orderByDesc('id')->select(['id','title', 'text', 'author', 'key_word', 'description', 'title_page'])->take(4)->get();
        
        $links  = OperationCat::where('parent_id', 0)->where('status', 'active')->get();
        return view('front.blog.show', compact('slug', 'item','lastest','links'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }

    public function search( $lang, Request $request ) {
        
        $type   = 'all';
        
        if (app()->getLocale()=='en') {
            $items  = Blog::orWhere('title', 'like', '%'.$request->search.'%')->orWhere('short_text', 'like', '%'.$request->search.'%')->orWhere('text', 'like', '%'.$request->search.'%')
            ->orderByDesc('updated_at')->select(['id','title', 'text', 'author', 'key_word', 'description', 'title_page','status']);
            $items  = $items->where('status', 'active')->paginate(10);

        } else {
            $items  = [];
            $lang   = strtoupper(app()->getLocale());
            $langs  = Lang::where('lang', $lang)->where('langs_type', 'App\Models\Blog')->where('text', 'like', '%'.$request->search.'%')->get('langs_id');
            if ($langs->count()) {
                $activeLangs    = Lang::whereIn('langs_id', $langs)->where('col_name', 'status')->where('text', 'active')->where('lang', $lang)->where('langs_type', 'App\Models\Blog')->get('langs_id');
                if ($activeLangs->count()) {
                    $items  = Blog::whereIn('id', $activeLangs)->orderByDesc('updated_at')->select(['id','title', 'text', 'author', 'key_word', 'description', 'title_page'])->paginate(10);
                }
            }
        }
        
        
        $links  = OperationCat::where('parent_id', 0)->where('status', 'active')->get();
        return view('front.blog.index', compact('type', 'items','links'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }

}
