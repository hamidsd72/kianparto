<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\HomeSlider;
use App\Models\Photo;
use App\Http\Requests\Setting\SliderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use settingbon\settingbon;

class HomeSliderController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'اسلایدر';
                break;
            case 'create':
                return 'افزودن اسلایدر';
                break;
            case 'edit':
                return 'ویرایش اسلایدر';
                break;
            case 'url_back':
                return route('admin.home-slider.index');
                break;
            default:
                return '';
                break;
        }
    }
    public function __construct()
    {
        $this->middleware('permission:slider_list', ['only' => ['index','show']]);
        $this->middleware('permission:slider_create', ['only' => ['create','store']]);
        $this->middleware('permission:slider_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slider_delete', ['only' => ['destroy']]);
        $this->middleware('permission:slider_status', ['only' => ['status']]);
    }

    public function index()
    {
        $items=HomeSlider::orderBy('type')->get();

        return view('admin.setting.home_slider.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function slider_index()
    {
//        return $type;
        $items=HomeSlider::orderBy('sort')->get();
        return view('admin.setting.home_slider.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {

    }
    public function create()
    {
        $url_back=$this->controller_title('url_back');
        $sort=HomeSlider::count()+1;
        return view('admin.setting.home_slider.create',compact('url_back','sort'), ['title' => $this->controller_title('create')]);
    }
    public function store(SliderRequest $request)
    {
//        return $request;
        try {
            $item = HomeSlider::create([
                // 'title1' => $request->title1,
                // 'title2' => $request->title2,
                'type' => $request->type,
                'text' => $request->text,
                // 'text_button' => $request->text_button,
                'link' => $request->link,
                'sort' => $request->sort,
                'status' => $request->status,
            ]);
            //create slider
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/setting/slider/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            store_lang($item,$request,['type','text','status'],'create');
            // store_lang($item,$request,['title1','title2','type','text','status'],'create');

            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {
        $url_back=$this->controller_title('url_back');
        $item=HomeSlider::findOrFail($id);
        return view('admin.setting.home_slider.edit',compact('url_back','item'), ['title' => $this->controller_title('edit')]);
    }
    public function update(SliderRequest $request,$id)
    {
        $item=HomeSlider::findOrFail($id);
        try {
            HomeSlider::where('id',$id)->update([
                // 'title1' => $request->title1,
                // 'title2' => $request->title2,
                'type' => $request->type,
                'text' => $request->text,
                // 'text_button' => $request->text_button,
                'link' => $request->link,
                'sort' => $request->sort,
                'status' => $request->status,
            ]);
            //edit slider
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
                $photo->path = file_store($request->photo, 'assets/uploads/setting/Slider/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            store_lang($item,$request,['type','text','status'],'edit');
            // store_lang($item,$request,['title1','title2','type','text','status'],'edit');

            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=HomeSlider::findOrFail($id);
        try {
            $item->delete();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }

    public function status($id,$type,$status)
    {
        $item=HomeSlider::findOrFail($id);
        try {
            $item->$type=$status;
            $item->update();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت تغییر وضعیت شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای تغییر وضعیت به مشکل خوردیم، مجدد تلاش کنید');
        }
    }

}
