@extends('Master.adminMaster')
@section('title', ' تفاصيل المديونيه ')
@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">
                    <div style="ba" class="d-flex justify-content-between">
                        <h3>تفاصيل ديون: {{ $supplier->name }}</h3>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark nav-link px-1" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> المديونيات </a></li>
                        </ol>
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>رقم الفاتورة</th>
                                    <th>المبلغ</th>
                                    <th>المدفوع</th>
                                    <th>المتبقي</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debts as $debt)
                                    <tr>
                                        <td>{{ $debt->invoice_number }}</td>
                                        <td>{{ number_format($debt->amount, 2) }}</td>
                                        <td>{{ number_format($debt->paid, 2) }}</td>
                                        <td>{{ number_format($debt->remaining, 2) }}</td>
                                        <td>{{ $debt->due_date }}</td>
                                        <th>
                                            @if (auth()->user()->hasPermission('debt_update'))
                                                <a href="{{ route('debt.edit', $debt->id) }}"
                                                    class="btn btn-sm  m-1 btn-info"><i class="fa fa-edit"
                                                        aria-hidden="true"></i> نسويه</a>
                                            @else
                                                <a href="{{ route('debt.edit', $debt->id) }}"
                                                    class="btn btn-sm  disabled m-1 btn-info"><i class="fa fa-edit"
                                                        aria-hidden="true"></i> نسويه</a>
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
