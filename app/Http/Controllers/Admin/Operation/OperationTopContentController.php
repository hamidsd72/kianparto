<?php

namespace App\Http\Controllers\Admin\Operation;

use App\Models\Operation;
use App\Models\OperationTopContent;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\Photo;
use App\Http\Requests\Operation\OperationTopContentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class OperationTopContentController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'محتوای بالا ';
                break;
            case 'create':
                return 'افزودن محتوای بلا';
                break;
            case 'edit':
                return 'ویرایش محتوای بالا';
                break;
            case 'url_back':
                return route('admin.operation-topContent.index');
                break;
            default:
                return '';
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('permission:operation_topContent_list', ['only' => ['index','show']]);
        $this->middleware('permission:operation_topContent_create', ['only' => ['create','store']]);
        $this->middleware('permission:operation_topContent_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:operation_topContent_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $items=OperationTopContent::orderByDesc('id')->get();
        return view('admin.operation.topContent.index', compact('items'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {

    }
    public function create()
    {
        $url_back=$this->controller_title('url_back');
        $operationCats = OperationCat::where('parent_id' ,'!=', 0)->orderByDesc('id')->get();
        return view('admin.operation.topContent.create',compact('url_back','operationCats'), ['title' => $this->controller_title('create')]);


    }
    public function store(OperationTopContentRequest $request)
    {
        try {
            $item = OperationTopContent::create([
                'title1' => $request->title1,
                'title2' => $request->title2,
                'text1' => $request->text1,
                'text2' => $request->text2,
                'operation_cat_id' => $request->operation_cat_id,
                'status' => $request->status,
                'special' => $request->special,
            ]);

            //create pic
            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/operation/top-content/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            store_lang($item,$request,['title1','title2','text1','text2','status','special','operation_cat_id'],'create');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {
        $url_back=$this->controller_title('url_back');
        $item=OperationTopContent::findOrFail($id);
        $operationCats = OperationCat::where('parent_id' ,'!=', 0)->orderByDesc('id')->get();
        return view('admin.operation.topContent.edit',compact('url_back','item','operationCats'), ['title' => $this->controller_title('edit')]);
    }
    public function update(Request $request,$id)
    {
        $item=OperationTopContent::findOrFail($id);

        try {
            OperationTopContent::where('id',$id)->update([
                'title1' => $request->title1,
                'title2' => $request->title2,
                'text1' => $request->text1,
                'text2' => $request->text2,
                'operation_cat_id' => $request->operation_cat_id,
                'status' => $request->status,
                'special' => $request->special,
            ]);

            if ($request->hasFile('photo')) {
                if($item->photo)
                {
                    if(is_file($item->photo->path)) File::delete($item->photo->path);
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/operation/top-content/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            store_lang($item,$request,['title1','title2','text1','text2','status','special','operation_cat_id'],'edit');
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=OperationTopContent::find($id);
        try {
            foreach ($item->allSpecifications as $specification) $specification->delete();
            $item->delete();
            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }




}
