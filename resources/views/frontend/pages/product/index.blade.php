@extends('frontend.layouts.master')
@section('title')
    Products
@endsection
@section('css')
    <style>
        ol.links li:hover {
            color: blue;
            font-size: 100px;
        }
    </style>
@endsection
@section('content')
    <section class="mx-5 my-3">
        <div class="container-sm ">
            <div class="row ">
                <div class="col-12 col-lg-8 col-xl-8 col-md-8">
                    @isset($category->products)
                        @foreach ($category->products as $product)
                            <div class="card mb-3" dir="rtl">
                                <div class="card-body">
                                    <div class="p-2">
                                        <h5 class="">{{ $product->title }}</h5>
                                        <hr>
                                        <img src="{{ asset($product->photo) }}" class="img-fluid" width="400"
                                            alt="{{ $product->photo }}">
                                        <hr>
                                        <div class="mb-3">
                                            <p class="fs-6">{{ $product->description }}</p>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center ">
                                            <p class="">الفئه: {{ $product->category->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
                <div class="col-12 col-lg-4 col-xl-4 col-md-4">
                    <div class="card">
                        <div class="card-body" dir="rtl">
                            <ol class="links">
                                @isset($data['categories'])
                                    @foreach ($data['categories'] as $item)
                                        <li class="fs-6"><a href="{{ route('products', $item->slug) }}"
                                                class="nav-link">{{ $item->title }}</a></li>
                                    @endforeach
                                @endisset
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
