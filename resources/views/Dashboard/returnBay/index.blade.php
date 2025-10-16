@extends('master.adminMaster')
@section('title', 'الاسترجاعات')
@section('content')

    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">

                    <div class="d-flex justify-content-between">
                        <h3 class="mb-4">🔄 شاشة عرض الاسترجاعات</h3>

                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Product.index') }}" method="get">
                            <div class="col-md-6 m-0">
                                <input type="text" class="form-control  " value="{{ request()->search }}"
                                    id="validationCustom01" name="search">

                            </div>
                            <div class="col-md-6 m-0">
                                <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                        aria-hidden="true"></i>بحث</button>
{{-- 
                                @if (auth()->user()->hasPermission('Product_create'))
                                    <a class="btn btn-primary my-0 ms-a"href="{{ route('Product.create') }}">اضافة منتج</a>
                                @else
                                    <a class="btn btn-primary my-0 disabled ms-a"href="{{ route('Product.create') }}">اضافة
                                        منتج</a>
                                @endif --}}

                            </div>
                        </form>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark nav-link px-1" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> المنتجات </a></li>
                        </ol>
                    </div>

                </div>

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>رقم الفاتورة</th>
                            <th>اسم المنتج</th>
                            <th>الكمية المسترجعة</th>
                            <th>السعر</th>
                            <th>الإجمالي</th>
                            <th>سبب الاسترجاع</th>
                            <th>الحالة</th>
                            <th>تاريخ الاسترجاع</th>
                            <th>الصيدلي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returns as $return)
                            <tr>
                                <td>{{ $return->order_id }}</td>
                                <td>{{ $return->product->name }}</td>
                                <td>{{ $return->quantity }}</td>
                                <td>{{ number_format($return->price, 2) }}</td>
                                <td>{{ number_format($return->quantity * $return->price, 2) }}</td>
                                <td>{{ $return->reason ?? '—' }}</td>
                                <td>
                                    @if ($return->status === 'restocked')
                                        <span class="badge bg-success">أعيد للمخزون</span>
                                    @else
                                        <span class="badge bg-danger">تم التخلص منه</span>
                                    @endif
                                </td>
                                <td>{{ $return->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $return->pharmacist->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">لا توجد عمليات استرجاع مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
