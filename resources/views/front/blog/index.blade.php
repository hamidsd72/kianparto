@extends('layouts.front')
@section('body')

    <div class="container-fluid mb-4 mb-lg-5">
        <h1 class="pt-lg-4 text-darkness text-center">{{$type=='article' ? read_lang_word('صفحه-اصلی','article') : read_lang_word('صفحه-اصلی','news') }}</h1>

        <div class="col-12">

            <div class="row mb-5">
                
                <div class="col-lg-3">
                    <div class="pr-lg-5">
                        @include('front.category-partial')
                    </div>
                </div>
    
                @if ($items->count())
                    <div class="col-lg">
    
                        <div class="row">
                            @foreach ($items as $item)
                                
                                @if ($item->photo)
                                    <div class="col-md-6 col-xl-4 lorem-box-efss32323248 pt-4 pt-lg-5 text-center">
                                        <div class="swiper-slide" role="group">
                                            <div class="col-12 p-0 bg-success-light shadow-c1 redu-10 hover_c1 hover_c3">
                                                <img class="logo-box w-100 redu-up-10" src="{{url($item->photo->path)}}" alt="banner">
                                                <div class="mx-4 bg-white p-2 redu-10 rel-box">
                                                    <p class="fs-lg-24 mt-lg-3 fw-bold title">{{$item->col_name('title')}}</p>
                                                    <div class="text">{!! $item->col_name('short_text') !!}</div>
                                                    <a class="btn btn-success" href="{{ route('front.blog.show', [ app()->getLocale(), $item->id, str_replace( [' ','/','?','=','.'], '-', $item->title)]) }}">ادامه مطلب</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
        
                            @endforeach
                        </div>
                        <div class="laravel-pagination pt-4">
                            {{$items->links()}}
                        </div>
                    </div>
                @endif
            </div>
            
        </div>

    </div>
@endsection