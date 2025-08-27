@extends('master.adminMaster')
@section('title', 'تفاصيل الإيرادات اليومية ')
@section('content')
    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-header py-0">

                    <div class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> الإيرادات </h3>
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
                            <<li class="active mx-2"> الإيرادات</a></li>
                        </ol>
                        {{-- <a class="btn btn-primary my-2 ms-a"href="{{ route('order.create') }}">   </a> --}}
                    </div>

                </div>

                <div class="card-body row ">
                    <div class="table-responsive order col-md-12">
                        <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    {{-- <th> رقم الايراد</th> --}}
                                    <th> اسم الموظف </th>
                                    <th> الورديه</th>
                                    {{-- <th> عدد الطلبات</th> --}}
                                    <th>كاش</th>
                                    <th>بنكك</th>
                                    <th>إجمالي الإيراد</th>
                                    <th> التاريخ </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($revenues as $rev)
                                    <tr>
                                        <td>{{ $rev['employee_name'] }}</td>
                                        <td>{{ $rev['shift_name'] }}</td>
                                        <td>{{ number_format($rev['cash_total'], 0) }} SDG</td>
                                        <td>{{ number_format($rev['bank_total'], 0) }} SDG</td>
                                        <td>{{ number_format($rev['total_revenue'], 0) }} SDG</td>
                                        <td>{{ $rev['revenue_date'] }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">لا توجد إيرادات مسجلة حتى الآن.
                                        </td>
                                    </tr>
                                @endforelse



                            </tbody>
                        </table>


                    </div><!-- bd -->

                </div><!-- bd -->
            </div><!-- bd -->
        </div>

        <!--/div-->

        <!--div-->

        {{-- {!! $orders->appends(request()->search)->links() !!} --}}

    </div>
@stop
