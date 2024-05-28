@extends('backend.layouts.master')
@section('css')
    <!--- Select2 css -->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    edit_products
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Data
                    Tables</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('inc.message')
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $data['product']->slug) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Title</label>
                                    <input type="text" name="title" id=""
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ $data['product']->title }}" placeholder="Title"
                                        aria-describedby="helpId" />
                                    @error('title')
                                        <small id="helpId" class="text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id=""
                                        placeholder="Meta Description" rows="6">{{ $data['product']->meta_description }}</textarea>
                                    @error('meta_description')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                <div class="mb-3">

                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description"
                                        id="editor" rows="10">{{ $data['product']->description }}</textarea>
                                    @error('description')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">upload_photo</label>
                                    <input type="file" name="photo" id=""
                                        class="form-control @error('photo') is-invalid @enderror" placeholder="upload_photo"
                                        aria-describedby="helpId" />
                                    @error('photo')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">category</label>
                                    <select class="form-control select2 @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id">
                                        <option selected disabled>category</option>
                                        @isset($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $data['product']->category_id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status"
                                        id="">
                                        <option selected disabled>status</option>
                                        <option value="active"
                                            {{ $data['product']->status == 'active' ? 'selected' : '' }}>
                                            active
                                        </option>
                                        <option value="inactive"
                                            {{ $data['product']->status == 'inactive' ? 'selected' : '' }}>
                                            inactive</option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary btn-md" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js"></script>
@endsection
