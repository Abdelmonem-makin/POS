@extends('master.adminMaster')
@section('title', 'المديونيات')
@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">
                    <div style="ba" class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> المديونيات </h3>
                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('debt.index') }}" method="get">
                            <div class="col-md-6 m-0">
                                <input type="text" class="form-control  " value="{{ request()->search }}"
                                    id="validationCustom01" name="search">

                            </div>
                            <div class="col-md-6 m-0">
                                <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                        aria-hidden="true"></i>بحث</button>

                                {{-- @if (auth()->user()->hasPermission('debt_create'))
                                    <a class="btn btn-primary my-0 ms-a"href="{{ route('debt.create') }}">اضافة منتج</a>
                                @else
                                    <a class="btn btn-primary my-0 disabled ms-a"href="{{ route('debt.create') }}">اضافة
                                        منتج</a>
                                @endif --}}

                            </div>
                        </form>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark nav-link px-1" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> المديونيات </a></li>
                        </ol>
                    </div>

                </div>  
                     @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <p class="text-center ">{{ Session::get('success') }}</p>
                            </div>
                        @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">

                            <thead>
                                <tr>
                                    <th>المورد</th>
                                    <th>إجمالي الفواتير</th>
                                    <th>إجمالي المدفوع</th>
                                    <th>المتبقي</th>
                                    <th>إجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $data)
                                    <tr>
                                        <td>{{ $data['supplier']->name }}</td>
                                        <td>{{ number_format($data['total_amount'], 2) }}</td>
                                        <td>{{ number_format($data['total_paid'], 2) }}</td>
                                        <td>{{ number_format($data['total_remaining'], 2) }}</td>
                                        <td>
                                            <a href="{{ route('debts.showDebts', $data['supplier']->id) }}"
                                                class="btn btn-info btn-sm">
                                                عرض التفاصيل
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div><!-- bd -->
                    {{-- {!! $suppliers->links() !!} --}}
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
    </div>
@stop
