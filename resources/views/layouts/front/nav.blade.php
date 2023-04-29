<div class="navbar_top_x93432 container-fluid">
    <div class="row nav-first-box">
        <div class="col-5 col-lg-auto"><img class="nav-logo-site p-2" src="{{$logo?url($logo->path):''}}"  alt="کیان پرتو"></div>
        <div class="col"></div>
        <div class="col-auto my-auto px-4 px-lg-5">
            <a class="change-lang" data-toggle="modal" data-target="#nav_lang_modal">
                <div class="row">
                    <div class="col-auto my-auto text-lg-white">{{read_lang_word('صفحه-اصلی','persian')}}</div>
                    <div class="col-auto p-0"><img class="flag" src="/assets/images/front/flag-of-iran.png" alt="فارسی"></div>
                </div>
            </a>
        </div>
    </div>

    <nav class="container navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav py-2 my-2 my-lg-0 navbar-nav-scroll w-100 dir-rtl bg-success">
                <li class="nav-item {{\Request::route()->getName()=='front.index'?'active':''}}">
                    <a class="nav-link" href="/">{{read_lang_word('صفحه-اصلی','home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('front.category.show', [app()->getLocale(), 0, 'محصولات'])}}">{{read_lang_word('صفحه-اصلی','products')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('front.category.show', [app()->getLocale(), 78, 'مواد شیمیایی'])}}">{{read_lang_word('صفحه-اصلی','chemicals')}}</a>
                </li>
                <li class="nav-item {{\Request::route()->getName()=='front.blog.index'?'active':''}}">
                    <a class="nav-link" href="{{route('front.blog.index', [app()->getLocale(), 'article'])}}">{{read_lang_word('صفحه-اصلی','article')}}</a>
                </li>
                <li class="nav-item {{\Request::route()->getName()=='front.about.index'?'active':''}}">
                    <a class="nav-link" href="{{route('front.about.index', app()->getLocale())}}">{{read_lang_word('صفحه-اصلی','about-us')}}</a>
                </li>
                <li class="nav-item {{\Request::route()->getName()=='front.contact.index'?'active':''}}">
                    <a class="nav-link" href="{{route('front.contact.index', app()->getLocale())}}">{{read_lang_word('صفحه-اصلی','contact-us')}}</a>
                </li>
                {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Link
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#nav_search_modal">
                        <i class="fa fa-search fs-20"></i>
                    </a>
                </li>
            </ul>
            {{-- <form class="d-flex">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </nav>
</div>

@if ($slide)
    @if ($slide->photo)
        <div class="site-banner">
            <img class="w-100" src="{{url($slide->photo->path)}}" alt="banner">
            <div class="imageLinear"></div>
            <div class="container title-box text-center text-white">
                {!! $slide->col_name('text') !!}
                <div class="pt-2">
                    <a class="btn btn-success" href="#">اطلاعات بیشتر</a>
                </div>
            </div>
        </div>
    @endif
@endif
  
{{-- nav_search_modal --}}
<div class="modal fade" id="nav_search_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('front.blog.search', app()->getLocale()) }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header dir-rtl">
                    <h5 class="modal-title" id="exampleModalLabel">{{read_lang_word('صفحه-اصلی','search')}}</h5>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" name="search">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal">{{read_lang_word('صفحه-اصلی','dissuasion')}}</a>
                    <button type="submit" class="btn btn-success">{{read_lang_word('صفحه-اصلی','submit')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- nav_lang_modal --}}
<div class="modal fade" id="nav_lang_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header dir-rtl">
                <h5 class="modal-title" id="exampleModalLabel">{{read_lang_word('صفحه-اصلی','selection-language')}}</h5>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{read_lang_word('صفحه-اصلی','dissuasion')}}</button>
                <button type="button" class="btn btn-success">{{read_lang_word('صفحه-اصلی','submit')}}</button>
            </div>
        </div>
    </div>
</div>