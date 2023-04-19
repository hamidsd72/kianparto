@extends('layouts.front')
@section('body')

    @if ($sliderOne->count())
        <div class="container">
            <div class="lorem-box-efss32323244 px-4 px-lg-0">
                <div class="row dir-rtl">
                    @foreach ($sliderOne as $one => $sOne)
                        <div class="col-6 col-lg-3 p-0 text-center {{$one%2==0 ? 'bg-success-light' : 'bg-success-dark'}}">
                            @if ($sOne->photo) <img class="logo-box my-lg-3" src="{{url($sOne->photo->path)}}" alt="banner"> @endif
                            <p class="fs-sm-12 m-0 pb-3">{!! $sOne->col_name('text') !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
        

    @if ($sliderTwo->count())
        <div class="container">
            <div class="lorem-box-efss32323245">
                <div class="row dir-rtl">
                    @foreach ($sliderTwo as $sTwo)
                        <div class="col text-center">
                            <div class="m-lg-5 p-1 p-lg-4 bg-darkness shadow-c1 redu-20 hover_c1">
                                @if ($sTwo->photo) <img class="logo-box w-100" src="{{url($sTwo->photo->path)}}" alt="banner"> @endif
                                <p class="my-2 my-lg-3">{!! $sTwo->col_name('text') !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    
    @if ($sliderTree->count())
        <div class="container">
            <p class="fs-lg-42 my-4 text-center fw-bold text-darkness">محصولات پرفروش</p>
            <div class="pb-5 p-lg-5 swiper mySwiper mySwiperC454 swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper">
                    @foreach ($sliderTree as $sTree)
                        <div class="swiper-slide hover_c4" role="group" >
                            @if ($sTree->photo) <img class="shadow redu-20" src="{{url($sTree->photo->path)}}" alt="banner"> @endif
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    @endif
    
    
    @if ($sliderFour->count())
        <div class="container">
            <div class="lorem-box-efss32323246 my-5 mb-lg-0 py-lg-5">
                <div class="row dir-rtl">
                    @foreach ($sliderFour as $four => $sFour)
                        <div class="col-6 col-lg text-center hover_c4">
                            <div class="{{$four%2==0?'':'pt-4 pt-lg-5'}}">
                                @if ($sFour->photo) <img class="shadow-c1 redu-20 logo-box w-100" src="{{url($sFour->photo->path)}}" alt="banner"> @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    @if ($about)
        <div class="container-fluid p-0">
            <div class="lorem-box-efss32323247 py-lg-5">
                <img class="w-100 banner" src="{{$about->pic ? url($about->pic) : 'https://meysamlaborator.ir/wp-content/uploads/2020/11/iStock-949946968-1024x576.jpg'}}" alt="banner">
                <div class="container title-box text-center text-white">
                    <div class="float-right"><img class="nav-logo-site" src="{{$logo?url($logo->path):''}}"  alt="logo"></div>
                    <h1 class="fs-sm-14 title-one py-lg-4 pt-lg-5">{{ $about->col_name('title') }}</h1>
                    <p class="title-tree fs-sm-12 fs-lg-24">{!! $about->col_name('text') !!}</p>
                    <div class="">
                        <a class="btn btn-success mx-lg-3" href="#">درباره ما</a>
                        <a class="btn btn-success mx-lg-3" href="#">تماس با ما</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($blogs->count())
        <div class="container">
            <div class="lorem-box-efss32323248 pt-lg-5 mt-lg-5 text-center">
                <p class="fs-lg-42 my-4 fw-bold ml-15 text-darkness">مقالات</p>
                <div class="p-lg-5 swiper mySwiper mySwiperC455 swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <div class="swiper-wrapper pb-5">
                        @foreach ($blogs as $blog)
                            @if ($blog->photo)
                                <div class="swiper-slide text-center p-4 p-md-0" role="group" >
                                    <div class="col-12 p-0 bg-success-light shadow-c1 redu-10 hover_c1 hover_c3">
                                        <img class="logo-box w-100 redu-up-10" src="{{url($blog->photo->path)}}" alt="banner">
                                        <div class="mx-4 bg-white p-2 redu-10 rel-box">
                                            <p class="fs-lg-24 mt-lg-3 fw-bold title">{{$blog->col_name('title')}}</p>
                                            <div class="text">{!! $blog->col_name('short_text') !!}</div>
                                            <a class="btn btn-success" href="{{ route('front.blog.show', [ app()->getLocale(), $blog->id, str_replace( [' ','/','?','=','.'], '-', $blog->title)]) }}">ادامه مطلب</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    {{-- <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span></div> --}}
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
    @endif


    @if ($sliderFive)
        <div class="container mb-4">
            <p class="fs-lg-42 pt-lg-5 my-4 text-center fw-bold text-darkness">نمایندگی ها / برندها</p>
            <div class="p-lg-5 swiper mySwiper mySwiperC461 swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper">
                    @foreach ($sliderFive as $slider)
                        @if ($slider->photo)
                            <div class="swiper-slide hover_c2" role="group" >
                                <img class="shadow rounded-circle" src="{{url($slider->photo->path)}}" alt="banner">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                {{-- <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span></div> --}}
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    @endif
    
@endsection