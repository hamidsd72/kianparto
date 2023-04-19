@extends('layouts.admin',['req'=>true,'editor'=>true,'file_upload'=>true])

@section('content')
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="card-title">
                        {{$title}}
                    </h4>
                </div>

                <div class="card-body">
                    {{ Form::model($item,array('route' => array('admin.home-slider.update',$item->id),'id'=>'form_req', 'method' => 'PATCH','files'=>true)) }}
                    {{Form::hidden('id', $item->id)}}
                    <div class="row">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-en-tab" data-toggle="tab" data-target="#nav-en" type="button" role="tab" aria-controls="nav-en" aria-selected="true">EN</button>
                                @foreach(tab_langs() as $lang)
                                    <button class="nav-link" id="nav-{{$lang->lang}}-tab" data-toggle="tab" data-target="#nav-{{$lang->lang}}" type="button" role="tab" aria-controls="nav-{{$lang->lang}}" aria-selected="false">{{$lang->lang}}</button>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content w-100" id="nav-tabContent">
                            <div class="tab-pane fade show active ltr_tab" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                                <div class="container-fluid">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{Form::label('status', 'وضعیت  *')}}
                                                {{ Form::select('status', ['active'=>'انتشار','pending'=>'عدم انتشار'], null, array('class' => 'form-control select2-show-search custom-select','data-placeholder'=>'انتخاب کنید',)) }}
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('title1', 'عنوان زرد در اسلایدر اول و ویدیو / توضحیات استپ در اسلایدر دوم * ')}}
                                                {{Form::text('title1',null, array('class' => 'form-control','required'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('title2', 'عنوان bold * ')}}
                                                {{Form::text('title2',null, array('class' => 'form-control','required'))}}
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                {{Form::label('text', 'متن ')}}
                                                {{Form::textarea('text',null, array('class' => 'form-control textarea_ltr'))}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('text_button', ' متن دکمه در اسلایدر اول / نام در اسلایدر دوم')}}
                                                {{Form::text('text_button',null, array('class' => 'form-control'))}}
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            @foreach(tab_langs() as $lang)
                                <div class="tab-pane fade {{$lang->align=='ltr'?'ltr_tab':''}}" id="nav-{{$lang->lang}}" role="tabpanel" aria-labelledby="nav-{{$lang->lang}}-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{Form::label('status_'.$lang->lang, 'وضعیت  *')}}
                                                    {{ Form::select('status_'.$lang->lang, ['pending'=>'عدم انتشار','active'=>'انتشار'], read_lang($item,'status',$lang->lang), array('class' => 'form-control select2-show-search custom-select','data-placeholder'=>'انتخاب کنید',)) }}
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('title1_'.$lang->lang, 'عنوان زرد در اسلایدر اول و ویدیو / توضحیات استپ در اسلایدر دوم ')}}
                                                    {{Form::text('title1_'.$lang->lang,read_lang($item,'title1',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('title2_'.$lang->lang, 'عنوان bold ')}}
                                                    {{Form::text('title2_'.$lang->lang,read_lang($item,'title2',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div> --}}
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    {{Form::label('text_'.$lang->lang, 'متن ')}}
                                                    {{Form::textarea('text_'.$lang->lang,read_lang($item,'text',$lang->lang), array('class' => 'form-control '.$lang->align=='ltr'?'textarea_ltr':'textarea_rtl'))}}
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('text_button_'.$lang->lang, ' متن دکمه در اسلایدر اول / نام در اسلایدر دوم')}}
                                                    {{Form::text('text_button_'.$lang->lang,null, array('class' => 'form-control'))}}
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('link', 'لینک ')}}
                                {{Form::url('link',null, array('class' => 'form-control d-ltr text-left'))}}
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('type', 'نوع  *')}}
                                {{ Form::select('type', ['slider1'=>'اسلایدر اول (چهارتایی سبز)','slider2'=>'اسلایدر دوم(دوتایی سرمه ای)','slider3'=>'اسلایدر سوم(محصولات پرفروش)','slider4'=>'اسلایدر چهار(چهارتایی رنگی)','slider5'=>'اسلایدر پنجم(همکاران ما)','slider0'=>'بنر سایت'], null, array('class' => 'form-control select2-show-search custom-select','data-placeholder'=>'انتخاب کنید',)) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('sort', 'ترتیب ')}}
                                {{Form::number('sort',null, array('class' => 'form-control d-ltr text-left'))}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('photo', 'تصویر ')}}
                                {{Form::file('photo', array('class' => 'dropify','data-height'=>'180','accept' => '.jpg,.jpeg,.png','data-default-file'=>$item->photo && is_file($item->photo->path)?url($item->photo->path):null))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 2MG می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر معادل عرض 300 پیکسل در ارتفاع 280 پیکسل می باشد</small>
                            </p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید JPG,JPEG,PNG باشد</small></p>
                        </div>


                        <div class="col-md-12 text-left">
                            <hr/>
                            {{Form::submit('ویرایش',array('class'=>'btn btn-primary','onclick'=>"return confirm('برای ارسال فرم مطمئن هستید؟')"))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection
@push('in_tag_script')

@endpush