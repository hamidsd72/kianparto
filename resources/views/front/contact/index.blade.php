@extends('layouts.front')
@section('body')
    <div class="container-fluid text-center">
        <h1 class="pt-lg-4 text-darkness">{{read_lang_word('صفحه-تماس','contact-title')}}</h1>
        {{-- @if($contact->address_iframe)
            <div class="mobil-map">
                <iframe src="{{$contact->address_iframe}}" width="100%" height="480" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        @endif --}}

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg my-auto">
                <p class="fs-lg-24 fw-bold text-darkness">{{read_lang_word('صفحه-تماس','contact-options')}}</p>
                <p class="fw-bold mb-4 text-darkness">{{read_lang_word('صفحه-تماس','open-work-time')}}</p>
                @if($contact->phone)
                    @php  $phones = explode(',', $contact->phone) @endphp
                    <div class="d-flex">
                        <p class="">{{read_lang_word('صفحه-اصلی','phone')}} : </p>
                        @foreach ($phones as $phone)
                            <p class="m-0 mx-2"><a class="text-darkness" href="tel:{{$phone}}">{{$phone}} <i class="fa fa-phone"></i></a></p>
                        @endforeach
                    </div>
                @endif
                
                @if($contact->fax)
                    <div class="d-flex">
                        <p class="">{{read_lang_word('صفحه-اصلی','fax')}} : </p>
                        <p class="m-0 mx-2">{{$contact->fax}} <i class="fa fa-fax"></i></p>
                    </div>
                @endif

                @if($contact->whatsapp)
                    <div class="d-flex">
                        <p class="">{{read_lang_word('صفحه-اصلی','whatsapp')}} : </p>
                        <p class="m-0 mx-2"><a class="text-darkness" href="https://wa.me/{{$contact->whatsapp}}">{{$contact->whatsapp}} <i class="fa fa-whatsapp"></i></a></p>
                        @if($contact->whatsapp_car)
                            <p class="m-0 mx-2"><a class="text-darkness" href="https://wa.me/{{$contact->whatsapp_car}}">{{$contact->whatsapp_car}} <i class="fa fa-whatsapp"></i></a></p>
                        @endif
                    </div>
                @endif

                @if($contact->email)
                    @php  $emails = explode(',', $contact->email) @endphp
                    <div class="d-flex">
                        <p class="">{{read_lang_word('صفحه-اصلی','mail')}} : </p>
                        @foreach($emails as $email)
                            <p class="m-0 mx-2"><a class="text-darkness" href="maito:{{str_replace([' ','+'],'',$email)}}">{{$email}} <i class="fa fa-envelope"></i></a></p>
                        @endforeach
                    </div>
                @endif

                <p class="">{{read_lang_word('صفحه-اصلی','adress')}}</p>
                <p> {{$contact->col_name('address')}} </p>

            </div>
            @if ($contact->pic)
                <div class="col-md-6 col-lg-4 my-auto">
                    <img src="{{url($contact->pic)}}" alt="banner" class="w-100">
                </div>
            @endif
            {{-- @include('layouts.includes_front.form') --}}
        </div>

        <div class="box-header my-auto">
            <div class="social-icon text-center my-5">
                @if($contact->telegram)            
                    <a href="{{$contact->youtube}}" class="mx-1 mx-lg-2"><i class="fa fa-youtube-play text-success"></i></a>
                @endif
                @if($contact->telegram)            
                    <a href="https://wa.me/{{$contact->whatsapp}}" class="mx-1 mx-lg-2"><i class="fa fa-whatsapp text-success"></i></a>
                @endif
                @if($contact->telegram)            
                    <a href="https://t.me/{{$contact->telegram}}" class="mx-1 mx-lg-2"><i class="fa fa-telegram text-success"></i></a>
                @endif
                @if($contact->telegram)            
                    <a href="{{$contact->twitter}}" class="mx-1 mx-lg-2"><i class="fa fa-twitter text-success"></i></a>
                @endif
                @if($contact->telegram)            
                    <a href="{{$contact->instagram}}" class="mx-1 mx-lg-2"><i class="fa fa-instagram text-success"></i></a>
                @endif
                @if($contact->telegram)            
                    <a href="{{$contact->facebook}}" class="mx-1 mx-lg-2"><i class="fa fa-facebook text-success"></i></a>
                @endif
            </div>
        </div>

    </div>
@endsection