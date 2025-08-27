@extends('master.adminMaster')
@section('title', __('الرئيسيه'))
@section('content')
    <div class="row ">
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-header py-0 ">
                    <div class="d-flex justify-content-between">
                        <h3 class=" my-1 me-a"> الرئيسيه </h3>
                        <ol class="breadcrumb my-2">
                            <li><i class="fa fa-home" aria-hidden="true"></i> الرئيسيه </li>
                        </ol>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <div data-bs-spy="scroll" data-bs-target="#nav-example" data-bs-smooth-scroll="true"
                                tabindex="0">
                                <div id="div1" class="">
                                    <div class="  row py-4">
                                        <h2 class="mb-4 text-center">📦 تفاصيل الإيرادات اليومية حسب الورديات</h2>

                                        <!-- وردية صباحية -->
                                        @foreach ($summary as $item)
                                            <div class="col-md-6">
                                                <div class="card  mb-4">
                                                    <div class="card-header  bg-primary text-white">🕒 وردية {{$item->name}} -
                                                        الموظف:
                                                        {{$item->employee->name ?? 'غير محدد'}}
                                                    </div>
                                                    <div class="card-body  ">




                                                        <!-- ملخص الورديه -->
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <div class="alert alert-success">💵 كاش : <br> <strong>{{$item->orders->where('paymentMethod.method_name', 'كاش')->sum('total_price')}}
                                                                        SDG</strong>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="alert alert-info">🏦 بنكك : <br> <strong>{{$item->orders->where('paymentMethod.method_name', 'بنكك')->sum('total_price')}}
                                                                        SDG</strong>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="alert alert-info">🏦 اجمالي الايراد: <br>
                                                                    <strong class="text-center">{{$item->orders->sum('total_price')}}SDG</strong>
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
                                </div>
                                <div id="div2" class="bg-success" style="height: 100vh">
                                    div2
                                </div>
                                <div id="div3" class="bg-light" style="height: 100vh">
                                    div3
                                </div>
                            </div>
                        </div>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
    </div>
@stop
