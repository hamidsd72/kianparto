@extends('layouts.front')
@section('body')

    <div class="container mb-4 mb-lg-5">
        <h1 class="pt-lg-4 text-darkness text-center">{{$item->col_name('title')}}</h1>

        <div class="row my-5">
            <div class="col-lg my-auto">
                {!! $item->col_name('text') !!}
            </div>
            @if ($item->pic)
                <div class="col-md-6 col-lg-5 my-auto">
                    <img src="{{url($item->pic)}}" alt="banner" class="w-100">
                </div>
            @endif
        </div>
        
        {!! $item->col_name('text1') !!}

    </div>
@endsection