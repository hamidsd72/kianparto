<?php

namespace App\Http\Controllers\Admin\Operation;

use App\Models\Operation;
use App\Models\OperationTopContentSpecification;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\Photo;
use App\Http\Requests\Operation\OperationTopContentSpecificationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class OperationTopContentSpecificationController extends Controller
{
    public function controller_title($type, $url=null)
    {
        switch ($type)
        {
            case 'index':
                return 'لیست';
                break;
            case 'create':
                return 'افزودن';
                break;
            case 'edit':
                return 'ویرایش';
                break;
            case 'url_back':
                return route('admin.operation-top-content.specification.index', $url);
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

    public function index($type, $id)
    {
        $items  = OperationTopContentSpecification::where('operation_content_id', $id)->where('type', $type)->orderByDesc('id')->get();
        return view('admin.operation.topContentSpecification.index', compact('items','type','id'), ['title' => $this->controller_title('index')]);
    }
    public function show($id)
    {
    }
    public function create($type, $id)
    {
        $url_back   = $this->controller_title('url_back', [$type, $id]);
        return view('admin.operation.topContentSpecification.create',compact('url_back','type','id'), ['title' => $this->controller_title('create')]);
    }
    public function store(OperationTopContentSpecificationRequest $request)
    {
        try {
            $item   = OperationTopContentSpecification::create([
                'operation_content_id'  => $request->operation_content_id,
                'title'                 => $request->title,
                'text'                  => $request->text,
                'type'                  => $request->type,
                'status'                => $request->status,
            ]);

            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/operation/top-content-specification/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            store_lang($item,$request,['title','text','status','operation_content_id'],'create');
            return redirect( $this->controller_title('url_back', [$item->type, $item->operation_content_id]) )->with('flash_message', 'اطلاعات با موفقیت افزوده شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای افزودن به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function edit($id)
    {
        $item       = OperationTopContentSpecification::findOrFail($id);
        $url_back   = $this->controller_title('url_back', [$item->type, $item->id]);
        return view('admin.operation.topContentSpecification.edit',compact('url_back','item'), ['title' => $this->controller_title('edit')]);
    }
    public function update(Request $request,$id)
    {
        $item=OperationTopContentSpecification::findOrFail($id);

        try {
            OperationTopContentSpecification::where('id',$id)->update([
                'title'     => $request->title,
                'text'      => $request->text,
                'status'    => $request->status,
            ]);


            if ($request->hasFile('photo')) {
                if($item->photo)
                {
                    if(is_file($item->photo->path)) File::delete($item->photo->path);
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/operation/top-content-specification/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            store_lang($item,$request,['title','text','status'],'edit');
            return redirect( $this->controller_title('url_back', [$item->type, $item->operation_content_id]) )->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }
    public function destroy($id)
    {
        $item=OperationTopContentSpecification::find($id);
        try {
            $item->delete();
            return redirect( $this->controller_title('url_back', [$item->type, $item->operation_content_id]) )->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }




}
