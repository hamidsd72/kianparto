@extends('layouts.front')
<style>
    .category-box {

    }
    .product-box {

    }
</style>
@section('body')

    <div class="container mt-lg-4">

        <div class="col-12">

            <div class="row">
    
                <div class="col-lg">
                    
                    <div class="text-center">
                        <p class="fs-lg-32 fw-bold">{{$item->col_name('title1')}}</p>
                        {!! $item->col_name('text1') !!}
                    </div>

                    <button class="btn btn-outline-dark" onclick="openBox_ier123kr({closeBox: 'box_casfn32', openBox: 'box_casfn32_1'})">{{read_lang_word('صفحه-اصلی','product-features')}}</button>
                    <button class="btn btn-outline-dark" onclick="openBox_ier123kr({closeBox: 'box_casfn32', openBox: 'box_casfn32_2'})">{{read_lang_word('صفحه-اصلی','versions')}}</button>
                    <button class="btn btn-outline-dark" onclick="openBox_ier123kr({closeBox: 'box_casfn32', openBox: 'box_casfn32_3'})">{{read_lang_word('صفحه-اصلی','accessories')}}</button>

                    <div class="pt-4">
                        <div class="box_casfn32 box_casfn32_1 d-none">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">{{read_lang_word('صفحه-اصلی','feature-title')}}</th>
                                        <th scope="col">{{read_lang_word('صفحه-اصلی','value')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->specifications as $specification)
                                        <tr>
                                            <td>{{ $specification->col_name('title') }}</td>
                                            <td>{{ $specification->col_name('text') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box_casfn32 box_casfn32_2 d-none">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">{{read_lang_word('صفحه-اصلی','title-version-code')}}</th>
                                        <th scope="col">{{read_lang_word('صفحه-اصلی','description')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->versions as $version)
                                        <tr>
                                            <td>{{ $version->col_name('title') }}</td>
                                            <td>{{ $version->col_name('text') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box_casfn32 box_casfn32_3 d-none">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">{{read_lang_word('صفحه-اصلی','title-accessories')}}</th>
                                        <th scope="col">{{read_lang_word('صفحه-اصلی','accessory-code')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->accessoriess as $accessories)
                                        <tr>
                                            <td>{{ $accessories->col_name('title') }}</td>
                                            <td>{{ $accessories->col_name('text') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                
                <div class="col-lg-4 col-xl-3">
                    @if ($item->photo)
                        <img class="w-100 rounded" src="{{url($item->photo->path)}}" alt="banner">
                    @endif
                </div>
            
            </div>
            <hr>
            
        </div>

    </div>
@endsection