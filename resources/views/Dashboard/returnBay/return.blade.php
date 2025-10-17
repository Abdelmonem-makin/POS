    @extends('layouts.app')
    @section('content')
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header py-0">
                        <div class="d-flex justify-content-between">
                            <h3 class=" my-2 me-a"> المنتجات </h3>
                            <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Product.index') }}"
                                method="get">
                                <div class="col-md-6 m-0">
                                    <input type="text" class="form-control  " value="{{ request()->search }}"
                                        id="validationCustom01" name="search">
                                </div>
                                <div class="col-md-6 m-0">
                                    <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                            aria-hidden="true"></i>بحث</button>

                                </div>
                            </form>
                            <a href="{{ route('Home') }}" class="btn my-2 btn-success" style='text-align:right;'
                                class="dropdown-item"> رجوع
                            </a>
                        </div>
                    </div>
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            <p class="text-center ">{{ Session::get('error') }}</p>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <p class="text-center ">{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <div class="card-body row ">
                        <div class="table-responsive order col-md-12">
                            <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th> رقم الفاتوره</th>
                                        {{-- <th> اسم الزبون</th> --}}
                                        <th> رقم العمليه</th>
                                        <th>طريقة الدفع</th>
                                        <th> اجمالي الطلبات</th>
                                        <th> اجمالي المبلغ</th>
                                        <th> تاريخ الطلب </th>
                                        {{-- <th>  الربح</th> --}}
                                        {{-- <th> </th> --}}
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($orders)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row">{{ $order->invoice_number ? $order->invoice_number : '-' }}
                                                </th>
                                                {{-- <th scope="row">{{ $order->name ? $order->name : '-' }}</th> --}}
                                                <th scope="row">{{ $order->transiction_no ? $order->transiction_no : '-' }}
                                                </th>
                                                <th scope="row">{{ $order->paymentMethod->method_name }}</th>
                                                <th scope="row">{{ $order->products->count() }}</th>
                                                <th scope="row">{{ number_format($order->total_price, 2) }}</th>
                                                <th scope="row">{{ $order->created_at }}</th>
                                                {{-- <th scope="row">{{  $order->profit }}</th> --}}

                                                <th>
                                                    <a href="{{ route('show-return', $order->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        استرجاع الطلب
                                                    </a>
                                                    <button class="Show-product btn btn-sm  my-1 btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-url="{{ route('show-product-order', $order->id) }}"
                                                        data-bs-target="#modalId" data-method="get">عرض الطلبات</button>
                                                    <!-- Modal Body -->
                                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                    <div class="modal fade" id="modalId" tabindex="-1"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalTitleId">
                                                                        قائمة الطلبات
                                                                    </h5>
                                                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button> --}}
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-md-12">
                                                                        <div class="list-order-product">

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        رجوع
                                                                    </button>
                                                                    <a href="http://"
                                                                        class="btn print-order-btn btn-success    ">
                                                                        طباعه</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Optional: Place to the bottom of scripts -->
                                                    <script>
                                                        const myModal = new bootstrap.Modal(
                                                            document.getElementById("modalId"),
                                                            options,
                                                        );
                                                    </script>




                                                </th>

                                            </tr>
                                        @endforeach
                                    @endisset


                                </tbody>
                            </table>


                        </div><!-- bd -->

                    </div><!-- bd -->
                </div><!-- bd -->
            </div>
        </div>
    @endsection
