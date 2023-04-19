@extends('layouts.admin')
@section('styles')
    <style>
        .app-content
        {
            margin-right: unset!important;
        }
        footer.footer
        {
            padding: unset;
        }
        .app-content
        {
            margin-top: 20px!important;
        }
    </style>
@endsection
@section('content')
<div class="container" dir="{{dir_set()}}">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-lg-3 col-md-4 col-sm-6 mx-auto mb-4 login_logo">
                <a href="http://www.farzanfanandish.com" target="_blank">
                    <img src="{{url($logo && $logo->logo && is_file($logo->logo->path)?$logo->logo->path:'')}}" class="w-100" alt="farzan">
                </a>
            </div>
        </div>
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">{{read_lang_word('صفحه-ورود','titr')}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{read_lang_word('صفحه-ورود','username')}}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control d-ltr text-left @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{read_lang_word('صفحه-ورود','password')}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control d-ltr text-left @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 {{dir_set()=='ltr'?'text-right':'text-left'}}">
                                <button type="submit" class="btn btn-primary">
                                    {{read_lang_word('صفحه-ورود','btn')}}
                                </button>

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
