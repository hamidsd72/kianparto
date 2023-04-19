@extends('layouts.admin',['req'=>true,'editor'=>true,'file_upload'=>true])

@section('content')
  <style>
      .select2-container{
          direction: ltr;
      }
      .select2-container--default .select2-results__option--selected
      {
          display: none;
      }
  </style>
  <div class="row mt-5">
    <div class="col-xl-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header  border-0">
          <h4 class="card-title">
            {{$title}}
          </h4>
        </div>

        <div class="card-body">
          {{ Form::model($item,array('route' => array('admin.operation-topContent.update',$item->id),'id'=>'form_req', 'method' => 'PATCH','files'=>true)) }}
          {{Form::hidden('id', $item->id)}}
          <div class="row">
            <nav class="w-100">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-en-tab" data-toggle="tab" data-target="#nav-en" type="button"
                        role="tab" aria-controls="nav-en" aria-selected="true">EN
                </button>
                @foreach(tab_langs() as $lang)
                  <button class="nav-link" id="nav-{{$lang->lang}}-tab" data-toggle="tab"
                          data-target="#nav-{{$lang->lang}}" type="button" role="tab"
                          aria-controls="nav-{{$lang->lang}}" aria-selected="false">{{$lang->lang}}</button>
                @endforeach
              </div>
            </nav>
            <div class="tab-content w-100" id="nav-tabContent">
              <div class="tab-pane fade show active ltr_tab" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                <div class="container-fluid">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        {{Form::label('status', 'وضعیت  *')}}
                        {{ Form::select('status', ['active'=>'انتشار','pending'=>'عدم انتشار'], null, array('class' => 'form-control select2-show-search custom-select','required')) }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        {{Form::label('special', 'نمایش در محصولات ویژه  *')}}
                        {{ Form::select('special', ['active'=>'نمایش','pending'=>'عدم نمایش'], null, array('class' => 'form-control select2-show-search custom-select','required')) }}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        {{Form::label('title1', ' عنوان اصلی *')}}
                        {{Form::text('title1', null, array('class' => 'form-control text-left d-ltr','required'))}}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        {{Form::label('text1', '  متن عنوان اصلی ')}}
                        {{Form::textarea('text1',null, array('class' => 'form-control textarea_ltr'))}}
                      </div>
                    </div>
                    {{-- <div class="col-md-12">
                      <div class="form-group">
                        {{Form::label('title2', ' زیر عنوان ')}}
                        {{Form::text('title2', null, array('class' => 'form-control text-left d-ltr','required'))}}
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        {{Form::label('text2', '  متن زیر عنوان ')}}
                        {{Form::textarea('text2',null, array('class' => 'form-control textarea_ltr'))}}
                      </div>
                    </div> --}}

                  </div>
                </div>
              </div>
              @foreach(tab_langs() as $lang)
                <div class="tab-pane fade {{$lang->align=='ltr'?'ltr_tab':''}}" id="nav-{{$lang->lang}}" role="tabpanel"
                     aria-labelledby="nav-{{$lang->lang}}-tab">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          {{Form::label('status_'.$lang->lang, 'وضعیت  *')}}
                          {{ Form::select('status_'.$lang->lang, ['pending'=>'عدم انتشار','active'=>'انتشار'], read_lang($item,'status',$lang->lang), array('class' => 'form-control select2-show-search custom-select','required')) }}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          {{Form::label('special_'.$lang->lang, 'نمایش در محصولات ویژه  *')}}
                          {{ Form::select('special_'.$lang->lang, ['pending'=>'عدم نمایش','active'=>'نمایش'], read_lang($item,'status',$lang->lang), array('class' => 'form-control select2-show-search custom-select','required')) }}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          {{Form::label('title1_'.$lang->lang, ' عنوان اصلی *')}}
                          {{Form::text('title1_'.$lang->lang, read_lang($item,'title1',$lang->lang), array('class' => 'form-control  ','required'))}}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          {{Form::label('text1_'.$lang->lang, '  متن عنوان اصلی ')}}
                          {{Form::textarea('text1_'.$lang->lang,read_lang($item,'text1',$lang->lang), array('class' => 'form-control textarea_'.$lang->align))}}
                        </div>
                      </div>
                      {{-- <div class="col-md-12">
                        <div class="form-group">
                          {{Form::label('title2_'.$lang->lang, ' زیر عنوان ')}}
                          {{Form::text('title2_'.$lang->lang, null, array('class' => 'form-control'))}}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          {{Form::label('text2_'.$lang->lang, '  متن زیر عنوان ')}}
                          {{Form::textarea('text2_'.$lang->lang,null, array('class' => 'form-control textarea_'.$lang->align))}}
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              @endforeach
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

            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('operation_cat_id', 'دسته بندی *')}}
                <select name="operation_cat_id" class="form-control select2-show-search brand-select"
                        data-placeholder="انتخاب کنید" required >
                  @foreach($operationCats as $key=>$operationCat)
                    <option value="{{$operationCat->id}}"  {{$operationCat->id == $item->operation_cat_id ? 'selected':''}}>{{$operationCat->title}} {{$operationCat->col_name('title')}}</option>
                  @endforeach
                </select>
              </div>
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