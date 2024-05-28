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
    <link href="{{ URL::asset('backend/backend/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('backend/backend/assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
@endsection
@section('title')
    products
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
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-md">Create Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">title</th>
                                    <th class="border-bottom-0">photo</th>
                                    <th class="border-bottom-0">category</th>
                                    <th class="border-bottom-0">status</th>
                                    <th class="border-bottom-0">admin name</th>
                                    <th class="border-bottom-0">created_at</th>
                                    <th class="border-bottom-0">updated_at</th>
                                    <th class="border-bottom-0">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($products)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-primary btn-sm" data-toggle="modal"
                                                    href="#view_photo{{ $product->slug }}">photo</a>
                                            </td>
                                            <td>{{ $product->category->title }}</td>
                                            <td>
                                                <span class="{{ $product->Status($product->status) }}">
                                                    {{ ucwords($product->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $product?->admin?->name }}</td>
                                            <td>
                                                {{ $product->Fun($product->created_at) }}
                                            </td>
                                            <td>
                                                {{ $product->Fun($product->updated_at) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $product->slug) }}"
                                                    class="btn btn-primary btn-sm">edit</a>

                                                <a class="modal-effect btn btn-danger btn-sm" data-toggle="modal"
                                                    href="#delete{{ $product->slug }}">delete</a>
                                            </td>
                                        </tr>

                                        <!-- Modal View Photo Category -->
                                        <div class="modal" id="view_photo{{ $product->slug }}">
                                            <div class="modal-dialog modal-xl  modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">photo</h6>
                                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <img src="{{ asset($product->photo) }}" alt="">
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                            type="button">close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal View Photo Category-->

                                        <!-- Modal Delete Category -->
                                        <div class="modal" id="delete{{ $product->slug }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Delete Product</h6>
                                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('admin.products.destroy', $product->slug) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body">

                                                            <div class="text-center">
                                                                <p class="text-danger" style="font-size: 30px">
                                                                    Are You Sure Delete Product</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-danger"
                                                                type="submit">delete</button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                type="button">close</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Delete Category-->
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">

                            {!! $products->links() !!}
                        </div>
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
