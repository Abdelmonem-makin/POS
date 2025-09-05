@extends('master.adminMaster')
@section('title', 'الطلبات')
@section('content')

    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-header py-0">

                    <div class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> الطلبات </h3>
                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Category.index') }}"
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
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark px-2 nav-link" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home " aria-hidden="true"></i> الرئيسيه</a></li>
                            <<li class="active mx-2"> الطلبات</a></li>
                        </ol>
                        {{-- <a class="btn btn-primary my-2 ms-a"href="{{ route('order.create') }}">   </a> --}}
                    </div>

                </div>

                <div class="card-body row ">
                    <div class="table-responsive order col-md-12">
                        <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th> رقم الفاتوره</th>
                                    {{-- <th> اسم الزبون</th> --}}
                                    <th>   رقم العمليه</th>
                                    <th>طريقة الدفع</th>
                                    <th> اجمالي الطلبات</th>
                                    <th> تاريخ الطلب </th>
                                    <th> اجمالي المبلغ</th>
                                    <th>  الربح</th>
                                    {{-- <th> </th> --}}
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($orders)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <th scope="row">{{ $order->invoice_number ? $order->invoice_number : '-' }}</th>
                                            {{-- <th scope="row">{{ $order->name ? $order->name : '-' }}</th> --}}
                                            <th scope="row">{{ $order->phone ? $order->phone : '-' }}</th>
                                            <th scope="row">{{ $order->paymentMethod->method_name }}</th>
                                            <th scope="row">{{ $order->products->count() }}</th>
                                            <th scope="row">{{ $order->created_at }}</th>
                                            <th scope="row">{{ number_format($order->total_price, 2) }}</th>
                                            <th scope="row">{{  $order->profit }}</th>

                                            <th>
                                                <!-- Modal trigger button -->
                                                {{-- <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                                    data-url="{{ route('show-product-order', $order->id) }}" data-method="get"
                                                    data-bs-target="#modalId">
                                                    Launch
                                                </button> --}}
                                                <button class="Show-product btn btn-sm  my-1 btn-outline-primary"  data-bs-toggle="modal"
                                                    data-url="{{ route('show-product-order', $order->id) }}"  data-bs-target="#modalId"
                                                    data-method="get">عرض الطلب</button>
                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">
                                                                    Modal title
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
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
                                                                    Close
                                                                </button>
                                                                <button type="button" class="btn btn-primary">Save</button>
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



                                                @if (auth()->user()->hasPermission('Order_update'))
                                                    <a href="{{ route('Order.edit', $order->id) }}"
                                                        class="btn btn-sm my-1 btn-outline-primary"> تعديل<i class="fa fa-edit"
                                                            aria-hidden="true"></i></a>
                                                @else
                                                    <a href="#" class="btn btn-sm my-1 btn-outline-primary disabled">
                                                        تعديل<i class="fa fa-edit" aria-hidden="true"></i></a>
                                                @endif

                                                {{-- ########################## ############################################## --}}

                                                @if (auth()->user()->hasPermission('Order_delete'))
                                                    <form action="{{ route('Order.destroy', $order->id) }}" method="post"
                                                        class="d-inline">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-sm btn-outline-danger ">
                                                            <i class="fa fa-trash mx-1" aria-hidden="true"></i> حذف </button>
                                                    </form>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-outline-danger disabled">
                                                        <i class="fa fa-trash mx-1" aria-hidden="true"></i> حذف </button>
                                                @endif

                                                {{-- ########################## ############################################## --}}

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

        <!--/div-->

        <!--div-->

        {!! $orders->appends(request()->search)->links() !!}

    </div>
@stop
