@extends('layouts.front')
<style>
    :is(.categories, .products) a:hover {
        text-decoration: none;
    }
    .products {
        height: 260px;
        overflow: hidden;
    }
    .products img {
        height: 168px;
    }
</style>

@section('body')

    <div class="container-fluid mb-4 mb-lg-5">
        <h1 class="py-lg-4 text-darkness text-center">{{str_replace(['-'], ' ',$slug)}}</h1>

        <div class="col-12">

            <div class="row mb-5">
                
                <div class="col-lg-3">
                    <div class="pr-lg-5">
                        @include('front.category-partial')
                    </div>
                </div>
    
                <div class="col-lg col-xl-8">
                    
                    @if ($items->count())
                        <div class="row">
                            @foreach ($items as $item)
                                @if ($item->photo)
                                    <div class="col-6 col-lg-4 col-xl{{$items->count()==5? '' : '-3'}} text-center mb-3 mb-lg-4">
                                        <a href="{{route('front.category.show', [app()->getLocale(), $item->id, str_replace([' ','/','?','=','.'], '-', $item->col_name('title'))])}}">
                                            <img class="shadow-c1 redu-20 category-box w-100" src="{{url($item->photo->path)}}" alt="banner">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if ($item->contents->count())
                        <div class="row pt-5">
                            <h6 class="col-12 pt-lg-4 text-darkness fw-bold">{{str_replace(['-'], ' ',$slug)}}</h6>
                            @foreach ($item->contents as $content)
                                @if ($content->photo)
                                    <div class="col-md-6 col-lg-4 col-xl{{$items->count()==5? '' : '-3'}} text-center mb-3 mb-lg-4">
                                        <div class="hover_c4 products shadow redu-20">
                                            <a class="text-dark" href="{{route('front.product.show', [app()->getLocale(), $content->id, str_replace([' ','/','?','=','.'], '-', $content->col_name('title1'))])}}">
                                                <img class="product-box" src="{{url($content->photo->path)}}" alt="banner">
                                                <div class="p-2 px-lg-4 small">
                                                    @unless (app()->getLocale()=='EN')
                                                        {{$content->col_name('title1')}}
                                                    @endunless
                                                    <p class="my-1">
                                                        {{$content->title1}}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    {{-- <div class="laravel-pagination pt-4">
                        {{$items->links()}}
                    </div> --}}
                </div>
            </div>
            
        </div>

    </div>
@endsection