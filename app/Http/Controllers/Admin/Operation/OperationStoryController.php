<?php

namespace App\Http\Controllers\Admin\Operation;

use App\Models\Operation;
use App\Models\OperationStory;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\Photo;
use App\Http\Requests\Operation\OperationStoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class OperationStoryController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'استوری ها';
                break;
            case 'create':
                return 'افزودن استوری';
                break;
            case 'edit':
                return 'ویرایش استوری';
                break;
            case 'url_back':
                return route('admin.operation-story.index');
                break;
            default:
                return '';
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('permission:operation_story_list', ['only' => ['index','show']]);
        $this->middleware('permission:operation_story_create', ['only' => ['create','store']]);
        $this->middleware('permission:operation_story_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:operation_story_delete', ['only' => ['destroy']]);
        $this->middleware('permission:operation_story_status', ['only' => ['status']]);
    }

    public function index()
    {
        $items=OperationStory::orderByDesc('id')->get();
        return view('admin.operation.story.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {

    }
    public function create()
    {
        $url_back=$this->controller_title('url_back');
        $operationCats = OperationCat::where('parent_id' ,'!=', 0)->orderByDesc('id')->get();
        return view('admin.operation.story.create',compact('url_back','operationCats'), ['title' => $this->controller_title('create')]);


    }
    public function store(OperationStoryRequest $request)
    {
        $exist= OperationStory::where('operation_cat_id',$request->operation_cat_id)->where('type',$request->type);
        if($exist){
            return redirect()->back()->withInput()->with('err_message',  'برای این دسته بندی استوری'.' '.$request->type.' '.' موجود است !');
        }
        try {
            $item = OperationStory::create([
                'operation_cat_id' => $request->operation_cat_id,
                'status' => $request->status,
                'type' => $request->type,

            ]);


//            create gallery
            if ($request->hasFile('photos'))
            {
                foreach ($request->photos as $photo)
                {
                    $photos = new Photo();
                    $photos->type = 'photos';
                    $photos->path = file_store($photo, 'assets/uploads/operation/story/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photos-');
                    $item->photos()->save($photos);
                }
            }

            store_lang($item,$request,['status','type'],'create');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {

        $url_back=$this->controller_title('url_back');

        $item=OperationStory::with('photos')->findOrFail($id);

//            dd($item);
        $operationCats = OperationCat::where('parent_id' ,'!=', 0)->orderByDesc('id')->get();
        return view('admin.operation.story.edit',compact('url_back','item','operationCats'), ['title' => $this->controller_title('edit')]);
    }
    public function update(OperationStoryRequest $request,$id)
    {
//        return ($request->photos);
        $item=OperationStory::findOrFail($id);
        try {
            OperationStory::where('id',$id)->update([
                'operation_cat_id' => $request->operation_cat_id,
                'status' => $request->status,
                'type' => $request->type,
            ]);

//            edit pic
            if ($request->hasFile('photos'))
            {
                foreach ($request->photos as $photo)
                {
                    $photos = new Photo();
                    $photos->type = 'photos';
                    $photos->path = file_store($photo, 'assets/uploads/operation/story/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photos-');
                    $item->photos()->save($photos);
                }
            }
            store_lang($item,$request,['status','type','operation_cat_id'],'edit');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=OperationStory::findOrFail($id);
        try {
            $item->delete();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }

    public function delete_story_pic($id)
    {
        $item = Photo::findOrFail($id);
        try {
            if (is_file($item->path)) {
                File::delete($item->path);
            }
            $item->delete();
            return redirect()->back()->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
}
