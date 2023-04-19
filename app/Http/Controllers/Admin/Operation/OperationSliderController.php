<?php

namespace App\Http\Controllers\Admin\Operation;

use App\Models\Operation;
use App\Models\OperationSlider;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\Photo;
use App\Http\Requests\Operation\OperationCatRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class OperationSliderController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'اسلایدر ';
                break;
            case 'create':
                return 'افزودن اسلایدر';
                break;
            case 'edit':
                return 'ویرایش اسلایدر';
                break;
            case 'url_back':
                return route('admin.operation-slider.index');
                break;
            default:
                return '';
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('permission:operation_slider_list', ['only' => ['index','show']]);
        $this->middleware('permission:operation_slider_create', ['only' => ['create','store']]);
        $this->middleware('permission:operation_slider_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:operation_slider_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $items=OperationSlider::orderByDesc('sort')->get();
        return view('admin.operation.slider.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {

    }
    public function create()
    {
        $url_back=$this->controller_title('url_back');
        $operationCats = OperationCat::where('parent_id' ,'!=', 0)->orderByDesc('id')->get();
        $sort=OperationSlider::count()+1;
        return view('admin.operation.slider.create',compact('url_back','operationCats','sort'), ['title' => $this->controller_title('create')]);


    }
    public function store(Request $request)
    {
        try {
            $item = OperationSlider::create([
                'title1' => $request->title1,
                'title2' => $request->title2,
                'text' => $request->text,
                'operation_cat_id' => $request->operation_cat_id,
                'status' => $request->status,
                'sort' => $request->sort,
            ]);
//
            //create pic
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/operation/cat/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }
            store_lang($item,$request,['title1','title2','text','status'],'create');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {
        $url_back=$this->controller_title('url_back');
        $item=OperationSlider::findOrFail($id);
        $operationCats = OperationCat::where('parent_id' ,'!=', 0)->orderByDesc('id')->get();
        return view('admin.operation.slider.edit',compact('url_back','item','operationCats'), ['title' => $this->controller_title('edit')]);
    }
    public function update(Request $request,$id)
    {
        $item=OperationSlider::findOrFail($id);
        try {
            OperationSlider::where('id',$id)->update([
                'title1' => $request->title1,
                'title2' => $request->title2,
                'text' => $request->text,
                'operation_cat_id' => $request->operation_cat_id,
                'status' => $request->status,
                'sort' => $request->sort,
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
                $photo->path = file_store($request->photo, 'assets/uploads/operation/cat/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }
            store_lang($item,$request,['title1','title2','text','status','sort','operation_cat_id'],'edit');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=OperationSlider::findOrFail($id);
        try {
            $item->delete();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }


}
