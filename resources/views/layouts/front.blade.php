<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{dir_set()}}" {{font_farsi()}}>
    <head>
        <!--required meta tags-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--twitter og-->
        <meta name="twitter:title" @if(trim($__env->yieldContent('title_seo'))) content="@yield('title_seo')" @else content="{{$titleSeo}}"  @endif/>
        <meta name="twitter:keywords" @if(trim($__env->yieldContent('keyword'))) content="@yield('keyword')" @else content="{{$keywordsSeo}}" @endif/>
        <meta name="twitter:description" @if(trim($__env->yieldContent('description'))) content="@yield('description')" @else content="{{$descriptionSeo}}" @endif/>
        <meta name="twitter:image" content="{{$fav_icon}}" />
        <!--facebook og-->
        <meta property="og:url" content="{{$urlPage}}" />
        <meta name="twitter:title" @if(trim($__env->yieldContent('title_seo'))) content="@yield('title_seo')" @else content="{{$titleSeo}}"  @endif/>
        <meta property="og:keywords" @if(trim($__env->yieldContent('keyword'))) content="@yield('keyword')" @else content="{{$keywordsSeo}}" @endif/>
        <meta property="og:description" @if(trim($__env->yieldContent('description'))) content="@yield('description')" @else content="{{$descriptionSeo}}" @endif/>
        <meta property="og:image" content="{{$fav_icon}}" />
        <!--meta-->
        <meta name="keywords" @if(trim($__env->yieldContent('keyword'))) content="@yield('keyword')" @else content="{{$keywordsSeo}}" @endif/>
        <meta name="description" @if(trim($__env->yieldContent('description'))) content="@yield('description')" @else content="{{$descriptionSeo}}" @endif/>
        <meta name="author" content="adib-it" />
        <meta name="base_url" content="{{url('')}}">
        <!--favicon icon-->
        <link rel="icon" href="{{$fav_icon}}" type="image/png" sizes="16x16" />
        <!--title-->
        <title>@if(trim($__env->yieldContent('title_seo'))) @yield('title_seo') @else {{$titleSeo}} @endif</title>
		<link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
        <link rel="stylesheet" type="text/css" href="{{url('assets/front/css/main.css')}}">
        <style>
            .kianparto-body {
                min-height: 800px;
            }
        </style>
        @yield ('styles')
        
    </head>
    <body>
        
        @include('layouts.front.nav')
        
        <div class="kianparto-body {{app()->getLocale()=='fa' ? 'text-right' : '' }}">
            @yield ('body')
        </div>

        <div id="goToTop" class="go_to_top d-none" style="position: fixed;bottom: 20px;right: 20px;left: unset;z-index: 9999;">
            <button class="btn go_to_top_btn" style="height: 52px;width: 52px;background: sandybrown;border-radius: 50px;" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                <i class="fa fa-angle-up fs-lg-32"></i>
            </button>
        </div>

        @include('layouts.front.footer')
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<!-- Jquery js-->
		<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap4 js-->
		<script src="{{URL::asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" async="" charset="UTF-8" src="{{url('assets/front/js/script.min.js')}}"></script>
        <script type="text/javascript" async="" charset="UTF-8" src="{{url('assets/front/js/script.js')}}"></script>

        @if(session()->has('err_message'))
            <script>
                $(document).ready(function () {
                    Swal.fire({
                    title: "ناموفق",
                    text: "{{ session('err_message') }}",
                    icon: "warning",
                    timer: 6000,
                    timerProgressBar: true,
                })
            });
            </script>
        @endif
        @if(session()->has('flash_message'))
            <script>
                $(document).ready(function () {
                    Swal.fire({
                        title: "موفق",
                        text: "{{ session('flash_message') }}",
                        icon: "success",
                        timer: 6000,
                        timerProgressBar: true,
                    })
                })
            </script>
        ;@endif

        <script>

        </script>

        <div class="container-fluid">
            @yield ('scripts')
        </div>

    </body>
</html>
