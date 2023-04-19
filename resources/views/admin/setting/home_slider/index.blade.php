@extends('layouts.admin',['tbl'=>true])

@section('content')
    <style>
        table *
        {
            /*font-size: 13px;*/
        }
        table.dataTable tbody td, table.dataTable thead td
        {
            padding: 6px!important;
        }
        table.dataTable tbody th, table.dataTable thead th
        {
            padding: 10px 6px!important;
            /*font-size: 13px!important;*/
        }
    </style>
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="w-100">
                        {{$title}}

                        @can('slider_create')
                        <a href="{{route('admin.home-slider.create')}}" class="btn btn-primary float-left">افزودن</a>
                        @endcan
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="tbl_1">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">ردیف</th>
{{--                                <th class="border-bottom-0">عنوان زرد</th>--}}
                                {{-- <th class="border-bottom-0">  عنوان اصلی</th> --}}
                                <th class="border-bottom-0">نوع</th>
                                <th class="border-bottom-0">تصویر</th>

{{--                                @can('slider_status')--}}
{{--                                <th class="border-bottom-0">وضعیت</th>--}}
{{--                                @endcan--}}
                                @canany(['slider_edit','slider_delete'])
                                <th class="border-bottom-0">عملیات</th>
                                @endcan    
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    {{-- <td>
                                       {{$item->title1}}
                                    </td> --}}
                                    <td>
                                        @if($item->type=='slider1')
                                            اسلایدر اول
                                        @elseif($item->type=='slider2')
                                            اسلایدر دوم
                                        @elseif($item->type=='slider3')
                                            اسلایدر سوم
                                        @elseif($item->type=='slider4')
                                            اسلایدر چهارم
                                        @elseif($item->type=='slider5')
                                            اسلایدر پنجم
                                        @else
                                            بنر اصلی
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->photo && is_file($item->photo->path))
                                            <img src="{{url($item->photo->path)}}" height="100px">
                                        @else
                                            ثبت نشده
                                        @endif
                                    </td>
{{--                                    @can('slider_status')--}}
{{--                                    <td>--}}
{{--                                        @if($item->status=='active')--}}
{{--                                            <span class="text-success ml-1">انتشار</span>--}}
{{--                                            <a href="{{route('admin.slider.status',[$item->id,'status','pending'])}}">--}}
{{--                                                <i class="fa fa-close text-danger"></i>--}}
{{--                                            </a>--}}
{{--                                        @else--}}
{{--                                            <span class="text-danger ml-1">عدم انتشار</span>--}}
{{--                                            <a href="{{route('admin.slider.status',[$item->id,'status','active'])}}">--}}
{{--                                                <i class="fa fa-check text-success"></i>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    @endcan--}}
                                    @canany(['slider_edit','slider_delete'])
                                        <td>
                                            <div class="d-flex">
                                                @can('slider_edit')
                                                    <a href="{{route('admin.home-slider.edit',$item->id)}}"
                                                       class="action-btns1">
                                                        <i class="feather feather-edit-2  text-success"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="ویرایش"></i>
                                                    </a>
                                                @endcan
                                                    @can('slider_delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.home-slider.destroy', $item->id] ]) !!}
                                                    <button class="action-btns1" data-toggle="tooltip"
                                                            data-placement="top" title="حذف"
                                                            onclick="return confirm('برای حذف مطمئن هستید؟')">
                                                        <i class="feather feather-trash-2 text-danger"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                    @endcan
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
