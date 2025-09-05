@extends("master.adminMaster")
@section("title", __("الرئيسيه"))
@section("content")
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="me-a my-1"> الرئيسيه </h3>
                        <ol class="breadcrumb my-2">
                            <li><i class="fa fa-home" aria-hidden="true"></i> الرئيسيه </li>
                        </ol>
                    </div>
                </div>
                <div class="row m-0">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary h-100 py-2 shadow">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1 text-xs">
                                           اجمالي الارباح </div>
                                        <div class="h5 font-weight-bold mb-0 text-gray-800">SDG {{ number_format($totalprofit ?? 0, 2) }} </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-address-book" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success h-100 py-2 shadow">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-success text-uppercase mb-1 text-xs">
                                            عدد اصناف الادويه</div>
                                        <div class="h5 font-weight-bold mb-0 text-gray-800"> {{$product}} صنف</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info h-100 py-2 shadow">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-info text-uppercase mb-1 text-xs">Tasks
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 font-weight-bold mb-0 mr-3 text-gray-800">50%</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning h-100 py-2 shadow">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-warning text-uppercase mb-1 text-xs">
                                            Pending Requests</div>
                                        <div class="h5 font-weight-bold mb-0 text-gray-800">18</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><hr>
                <div class="card-body">



                                    <div class="row py-4">
                                        <h2 class="mb-4 text-center">📦 تفاصيل الإيرادات اليومية حسب الورديات</h2>

                                        <!-- وردية صباحية -->
                                        @foreach ($summary as $item)
                                            <div class="col-md-6">
                                                <div class="card mb-4">
                                                    <div class="card-header bg-primary text-white">🕒 وردية
                                                        {{ $item->name }} -
                                                        الموظف:
                                                        {{ $item->employee->name ?? "غير محدد" }}
                                                    </div>
                                                    <div class="card-body">

                                                        <!-- ملخص الورديه -->
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <div class="alert alert-success">💵 كاش : <br>
                                                                    <strong>{{ $item->orders->where("paymentMethod.method_name", "كاش")->sum("total_price") }}
                                                                        SDG</strong>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="alert alert-info">🏦 بنكك : <br>
                                                                    <strong>{{ $item->orders->where("paymentMethod.method_name", "بنكك")->sum("total_price") }}
                                                                        SDG</strong>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="alert alert-info">🏦 اجمالي الايراد: <br>
                                                                    <strong
                                                                        class="text-center">{{ $item->orders->sum("total_price") }}SDG</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div class="card-header bg-dark text-white">🌙 وردية مسائية - الموظف: سارة
                                                </div>
                                                <div class="card-body  ">




                                                    <!-- ملخص الورديه -->
                                                    <div class="row mt-3">
                                                        <div class="col-md-4">
                                                            <div class="alert alert-success">💵 كاش : <br> <strong>8,000
                                                                    SDG</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="alert alert-info">🏦 بنكك : <br> <strong>11,000
                                                                    SDG</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="alert alert-info">🏦 اجمالي الايراد: <br> <strong
                                                                    class="text-center">11,000 SDG</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </div>





                </div><!-- bd -->
            </div><!-- bd -->
        </div>
    </div>
@stop
