@extends('layouts.front')
@section('body')

    <div class="container-fluid mb-4 mb-lg-5">
        
        <h1 class="py-lg-5 text-darkness text-center">{{$item->type=='article' ? read_lang_word('صفحه-اصلی','article') : read_lang_word('صفحه-اصلی','news') }}</h1>
        <div class="col-12">

            <div class="row pb-4">
                
                <div class="col-md-6 col-lg-9">
                    <div class="col-12 p-0 bg-success-light shadow-c1 redu-10 hover_c1 hover_c3 pb-4">
                        <img class="logo-box w-100 redu-up-10 max-height-c8" src="{{$item->photo ? url($item->photo->path) : ''}}" alt="banner">
                        <div class="mx-4 bg-white p-2 mt-4 redu-10 rel-box">
                            <p class="fs-lg-24 mt-lg-3 px-3 fw-bold title">{{$item->col_name('title')}}
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-auto p-1 p-lg-3 fs-sm-12">{{ my_jdate($item->updated_at,'d F Y') }} <i class="fa fa-calendar"></i> </div>
                                        <div class="col-auto p-1 p-lg-3 fs-sm-12">{{ $item->author }} <i class="fa fa-user"></i> </div>
                                        <div class="col-auto p-1 p-lg-3 fs-sm-12">{{ $item->type=='article' ? read_lang_word('صفحه-اصلی','blog') : read_lang_word('صفحه-اصلی','new') }} <i class="fa fa-folder"></i> </div>
                                    </div>
                                </div>
                            </p>
                            <div class="text px-3">{!! $item->col_name('text') !!}</div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="pr-lg-4 pr-xl-5">
                        @include('front.category-partial')
                    </div>
                </div>
                
            </div>

            <hr>
            <p class="fs-lg-24">{{read_lang_word('صفحه-اصلی','lastest-article') }}</p>
            
            <div class="row">
                @foreach ($lastest as $item)
                    
                    @if ($item->photo)
                        <div class="col-md-6 col-xl lorem-box-efss32323248 pt-4 text-center">
                            <div class="swiper-slide" role="group">
                                <div class="col-12 p-0 bg-success-light shadow-c1 redu-10 hover_c1 hover_c3">
                                    <img class="logo-box w-100 redu-up-10" src="{{url($item->photo->path)}}" alt="banner">
                                    <div class="mx-4 bg-white p-2 redu-10 rel-box">
                                        <p class="fs-lg-24 mt-lg-3 fw-bold title">{{$item->col_name('title')}}</p>
                                        <div class="text">{!! $item->col_name('text') !!}</div>
                                        <a class="btn btn-success" href="{{ route('front.blog.show', [ app()->getLocale(), $item->id, str_replace( [' ','/','?','=','.'], '-', $item->title)]) }}">ادامه مطلب</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>

        </div>

    </div>
@endsection
