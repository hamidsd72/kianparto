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
                        @can(['estate_brand_create'])
                        <a href="{{route('admin.estate-brand.create')}}" class="btn btn-primary float-left">افزودن</a>
                        @endcan
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="tbl_3">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">ردیف</th>
                                <th class="border-bottom-0">عنوان</th>
                                @canany(['estate_brand_edit','estate_brand_delete'])
                                    <th class="border-bottom-0">عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                       {{$item->title}}
                                    </td>
                                    @canany(['estate_brand_edit','estate_brand_delete'])
                                        <td>
                                            <div class="d-flex">
                                                @can('estate_brand_edit')
                                                    <a href="{{route('admin.estate-brand.edit',$item->id)}}"
                                                       class="action-btns1">
                                                        <i class="feather feather-edit-2  text-success"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="ویرایش"></i>
                                                    </a>
                                                @endcan
                                                    @can('estate_brand_delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.estate-brand.destroy', $item->id] ]) !!}
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
                                @if(count($item->childs))
                                    @include('admin.estate.brand.includes',['item'=>$item,'key'=>$key])
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
