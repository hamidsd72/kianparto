<?php

namespace App\Http\Controllers\Admin\Operation;

use App\Models\Operation;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\Photo;
use App\Http\Requests\Operation\OperationCatRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class OperationCatController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'دسته بندی ';
                break;
            case 'create':
                return 'افزودن دسته بندی دسته';
                break;
            case 'edit':
                return 'ویرایش دسته بندی';
                break;
            case 'url_back':
                return route('admin.operation-cat.index');
                break;
            default:
                return '';
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('permission:operation_cat_list', ['only' => ['index','show']]);
        $this->middleware('permission:operation_cat_create', ['only' => ['create','store']]);
        $this->middleware('permission:operation_cat_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:operation_cat_delete', ['only' => ['destroy']]);
        $this->middleware('permission:operation_cat_status', ['only' => ['status']]);
    }

    public function index()
    {
        $items=OperationCat::where('parent_id',0)->orderByDesc('id')->get();
        return view('admin.operation.cat.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {

    }
    public function create()
    {
        $url_back=$this->controller_title('url_back');
//        $operations=Operation::orderByDesc('id')->get();
        $parentCats = OperationCat::where('parent_id' , 0)->orderByDesc('id')->get();
        return view('admin.operation.cat.create',compact('url_back','parentCats'), ['title' => $this->controller_title('create')]);


    }
    public function store(OperationCatRequest $request)
    {
//        return $request;
        try {
            $item = OperationCat::create([
                'title' => $request->title,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
                'service_view' => $request->service_view,
                'home_view' => $request->home_view,
                'slug' => str_replace(['_',' ','/','-','?'],'-',$request->title),
            ]);
//            create join
//            foreach ($request->operation_id as $operation){
//                operationJoin::create([
//                    'operation_id' => $operation,
//                    'cat_id' => $item->id,
//                ]);
//            }
            //create pic
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/operation/cat/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }
            store_lang($item,$request,['title','status','slug'],'create');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {
        $url_back=$this->controller_title('url_back');
        $item=OperationCat::findOrFail($id);
//        return $item;
        $parentCats=OperationCat::where('parent_id',0)->orderByDesc('id')->get();
        return view('admin.operation.cat.edit',compact('url_back','item','parentCats'), ['title' => $this->controller_title('edit')]);
    }
    public function update(OperationCatRequest $request,$id)
    {
//        return $request;
        $item=OperationCat::findOrFail($id);
        try {
            OperationCat::where('id',$id)->update([
                'title' => $request->title,
                'parent_id' => $request->parent_id,
                'service_view' => $request->service_view,
                'home_view' => $request->home_view,
                'status' => $request->status,
                'slug' => str_replace(['_',' ','/','-','?'],'-',$request->title),
            ]);
////             delete old join
//            foreach ($item->joins as $join){
//                $join->delete();
//            }
////            create join new
//            foreach ($request->operation_id as $operation){
//                operationJoin::create([
//                    'operation_id' => $operation,
//                    'cat_id' => $item->id,
//                ]);
//            }
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
            store_lang($item,$request,['title','status','slug'],'edit');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=OperationCat::findOrFail($id);
        try {
            $item->delete();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }


}
