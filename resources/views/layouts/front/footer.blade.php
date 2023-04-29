<div class="footer bg-darkness pt-lg-4 text-white">
    <div class="container-fluid">

        <div class="col-lg-10 col-xl-8 mx-auto">
    
            <div class="row dir-rtl text-right">
    
    
                <div class="col-lg-4">
                    <div class="box-header">
                        <img class="footer-logo-site" src="{{$logo?url($logo->path):''}}" alt="kianparto">
                    </div>
                    <p class="my-4 fs-lg-20 fw-bold">{{$about->col_name('title')}}</p>
                    <p class="my-1 fw-bold text-justify fs-sm-12">{!! $about->col_name('text') !!}</p>
                </div>
    
    
                <div class="col-lg-4">
                    <div class="box-header my-auto">
                        <div class="social-icon text-center mb-4 mb-lg-0">
                            <p class="my-4 fs-lg-20">ما را در شبکه های اجتماعی دنبال کنید</p>
                            {{-- <a href="#" class="mx-1 mx-lg-2"><i class="fa fa-linkedin"></i></a> --}}
                            @if($contact->telegram)            
                                <a href="{{$contact->youtube}}" class="mx-1 mx-lg-2"><i class="fa fa-youtube-play"></i></a>
                            @endif
                            @if($contact->telegram)            
                                <a href="https://wa.me/{{$contact->whatsapp}}" class="mx-1 mx-lg-2"><i class="fa fa-whatsapp"></i></a>
                            @endif
                            @if($contact->telegram)            
                                <a href="https://t.me/{{$contact->telegram}}" class="mx-1 mx-lg-2"><i class="fa fa-telegram"></i></a>
                            @endif
                            @if($contact->telegram)            
                                <a href="{{$contact->twitter}}" class="mx-1 mx-lg-2"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if($contact->telegram)            
                                <a href="{{$contact->instagram}}" class="mx-1 mx-lg-2"><i class="fa fa-instagram"></i></a>
                            @endif
                            @if($contact->telegram)            
                                <a href="{{$contact->facebook}}" class="mx-1 mx-lg-2"><i class="fa fa-facebook"></i></a>
                            @endif
                        </div>
                    </div>
                    <p class="fs-lg-20 fw-bold">{{$contact->col_name('title')}}</p>
                    <p class="my-1 fw-bold text-justify fs-sm-12">آدرس : {{$contact->col_name('address')}}</p>
                    <p class="my-1 fw-bold fs-sm-12">تلفن : {{ str_replace(',',' ', $contact->phone) }}</p>
                    <p class="my-1 fw-bold fs-sm-12">ایمیل : {{ str_replace(',',' ', $contact->email) }}</p>
                </div>
    
    
                <div class="col-lg-4">
                    <div class="box-header"></div>
                    <div class="row">
                        @foreach ($links as $link)
                            <div class="col-auto">
                                <p class="my-4 fw-bold">{{$link->col_name('title')}}</p>
                                @foreach ($link->children->take(4) as $child)
                                    <p class="my-1"><a class="fs-sm-12 text-white" href="#">{{$child->col_name('title')}}</a></p>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
    
    
            </div>
    
        </div>
    
        <p class="copyright text-center fs-sm-12 py-2 m-0 mt-3">
            طراحی و توسعه توسط شرکت ادیب {{\Carbon\Carbon::now()->format('Y')}}
        </p>

    </div>
</div>
