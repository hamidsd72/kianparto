<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Blog;
use App\Models\Photo;
use App\Http\Requests\Blog\BlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'اخبار';
                break;
            case 'create':
                return 'افزودن خبر';
                break;
            case 'edit':
                return 'ویرایش خبر';
                break;
            case 'url_back':
                return route('admin.news.index');
                break;
            default:
                return '';
                break;
        }
    }
    public function __construct()
    {
        $this->middleware('permission:news_list', ['only' => ['index','show']]);
        $this->middleware('permission:news_create', ['only' => ['create','store']]);
        $this->middleware('permission:news_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $items=Blog::where('type','news')->orderByDesc('id')->get();
        return view('admin.blog.news.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {

    }
    public function create()
    {
        $url_back=$this->controller_title('url_back');
        return view('admin.blog.news.create',compact('url_back'), ['title' => $this->controller_title('create')]);
    }
    public function store(BlogRequest $request)
    {
        try {
            $item = Blog::create([
                'type' => 'news',
                'title' => $request->title,
                'text' => $request->text,
                'author' => $request->author,
                'key_word' => $request->key_word,
                'description' => $request->description,
                'title_page' => $request->title_page,
                'status' => $request->status,
                'short_text' => $request->short_text,
            ]);
            //create pic
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/blog/news/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }
            store_lang($item,$request,['title','text','author','key_word','short_text','description','title_page','status'],'create');

            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {
        $url_back=$this->controller_title('url_back');
        $item=Blog::where('type','news')->where('id',$id)->firstOrFail();
        return view('admin.blog.news.edit',compact('url_back','item'), ['title' => $this->controller_title('edit')]);
    }
    public function update(BlogRequest $request,$id)
    {
        $item=Blog::where('type','news')->where('id',$id)->firstOrFail();
        try {
            Blog::where('id',$id)->update([
                'title' => $request->title,
                'text' => $request->text,
                'author' => $request->author,
                'key_word' => $request->key_word,
                'description' => $request->description,
                'title_page' => $request->title_page,
                'status' => $request->status,
                'short_text' => $request->short_text,
            ]);
            //edit pic
            if ($request->hasFile('photo')) {
                if($item->photo)
                {
                    if(is_file($item->photo->path))
                    {
                        File::delete($item->photo->path);
                    }
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/blog/news/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }
            store_lang($item,$request,['title','text','author','key_word','short_text','description','title_page','status'],'edit');

            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=Blog::where('type','news')->where('id',$id)->firstOrFail();
        try {
            $item->delete();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
}
