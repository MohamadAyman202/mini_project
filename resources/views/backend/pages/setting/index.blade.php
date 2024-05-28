@extends('backend.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">


    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('backend/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('backend/assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
@endsection
@section('title')
    slider
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
    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @include('inc.message')
                    <a class="modal-effect btn btn-primary btn-md" data-toggle="modal"
                        href="#edit{{ $setting->id }}">edit</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            @isset($setting)
                                <tr>
                                    <th>title</th>
                                    <td>{{ $setting->title }}</td>
                                </tr>
                                <tr class="bg-secondary text-light ">
                                    <th>logo</th>
                                    <td>
                                        <img src="{{ asset($setting->logo) }}" width="150" alt="{{ $setting->title }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>favicon</th>
                                    <td>
                                        <img src="{{ asset($setting->favicon) }}" width="150" alt="{{ $setting->title }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>facebook</th>
                                    <td>{{ $setting->facebook }}</td>
                                </tr>
                                <tr>
                                    <th>instagram</th>
                                    <td>{{ $setting->instagram }}</td>
                                </tr>
                                <tr>
                                    <th>twitter</th>
                                    <td>{{ $setting->twitter }}</td>
                                </tr>
                                <tr>
                                    <th>created_at</th>
                                    <td>{{ $setting->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>updated_at</th>
                                    <td>{{ $setting->updated_at }}</td>
                                </tr>

                                <!-- Modal Edit Category -->
                                <div class="modal" id="edit{{ $setting->id }}">
                                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Setting</h6><button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-12">

                                                            <div class="">
                                                                <label class="form-label">Title</label>
                                                                <input class="form-control @error('title') is-invalid @enderror"
                                                                    type="text" name="title" value="{{ $setting->title }}"
                                                                    placeholder="Title" />
                                                                @error('title')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                            <div class="mt-3">
                                                                <label for="" class="form-label">Logo</label>
                                                                <input type="file" name="logo"
                                                                    class="form-control @error('logo') is-invalid @enderror" />
                                                                @error('logo')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                            <div class="mt-3">
                                                                <label for=""
                                                                    class="form-label">Favicon</label>
                                                                <input type="file" name="favicon"
                                                                    class="form-control @error('favicon') is-invalid @enderror" />
                                                                @error('favicon')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                            <div class="mt-3">
                                                                <label for="" class="form-label">facebook</label>
                                                                <input type="url" name="facebook"
                                                                    value="{{ $setting->facebook }}" placeholder="facebook"
                                                                    class="form-control @error('facebook') is-invalid @enderror" />
                                                                @error('facebook')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                            <div class="mt-3">
                                                                <label for="" class="form-label">instagram</label>
                                                                <input type="url" name="instagram"
                                                                    value="{{ $setting->instagram }}" placeholder="instagram"
                                                                    class="form-control @error('instagram') is-invalid @enderror" />
                                                                @error('instagram')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12 col-md-12 col-xl-12">
                                                            <div class="mt-3">
                                                                <label for="" class="form-label">twitter</label>
                                                                <input type="url" name="twitter"
                                                                    value="{{ $setting->twitter }}" placeholder="twitter"
                                                                    class="form-control @error('twitter') is-invalid @enderror" />
                                                                @error('twitter')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" type="submit">edit</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                        type="button">close</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Edit Category-->
                            @endisset
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('backend/assets/js/table-data.js') }}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('backend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('backend/assets/js/modal.js') }}"></script>
@endsection
