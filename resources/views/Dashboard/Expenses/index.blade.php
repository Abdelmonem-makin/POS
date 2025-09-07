@extends('master.adminMaster')
@section('title', 'المصروفات ')
@section('content')

    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">

                    <div class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> المصروفات </h3>
                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Expense.index') }}" method="get">
                            <div class="col-md-6 m-0">
                                <input type="text" class="form-control  " value="{{ request()->search }}"
                                    id="validationCustom01" name="search">

                            </div>
                            <div class="col-md-6 m-0">
                                <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                        aria-hidden="true"></i>بحث</button>

                                @if (auth()->user()->hasPermission('Expense_create'))
                                    <a class="btn btn-primary my-0 ms-a"href="{{ route('Expense.create') }}">اضافة مصروف</a>
                                @else
                                    <a class="btn btn-primary my-0 disabled ms-a"href="{{ route('Expense.create') }}">اضافة
                                        مصروف</a>
                                @endif

                            </div>
                        </form>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark nav-link px-1" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> المصروفات </a></li>
                        </ol>
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        @if ($Expenses->count() > 0)

                            <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> اسم المصروف </th>
                                        <th>القيمة</th>
                                        <th>التاريخ</th>
                                        <th>التصنيف</th>
                                        <th>تم بواسطة</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($Expenses)
                                        @foreach ($Expenses as $index => $Expense)
                                            <tr>
                                                <th class="pt-4" scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $Expense->title }}</td>
                                                <td>{{ $Expense->amount }} SDG</td>
                                                <td>{{ $Expense->expense_date }}</td>
                                                <td>{{ $Expense->category }}</td>
                                                <td>{{ $Expense->user->name }}</td>
                                                </th>
                                                <th>

                                                    @if (auth()->user()->hasPermission('Expense_update'))
                                                        <a href="{{ route('Expense.edit', $Expense->id) }}"
                                                            class="btn btn-sm  m-1 btn-info"><i class="fa fa-edit"
                                                                aria-hidden="true"></i> تعديل</a>
                                                    @else
                                                        <a href="{{ route('Expense.edit', $Expense->id) }}"
                                                            class="btn btn-sm  disabled m-1 btn-info"><i class="fa fa-edit"
                                                                aria-hidden="true"></i> تعديل</a>
                                                    @endif

                                                    @if (auth()->user()->hasPermission('Expense_delete'))
                                                        <form action="{{ route('Expense.destroy', $Expense->id) }}"
                                                            method="post" class="d-inline">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-sm btn-outline-danger ">
                                                                <i class="fa fa-trash mx-1" aria-hidden="true"></i> حذف
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-outline-danger disabled">
                                                            <i class="fa fa-trash mx-1" aria-hidden="true"></i> حذف </button>
                                                    @endif




                                                </th>

                                            </tr>
                                        @endforeach
                                    @endisset




                                </tbody>
                            </table>
                        @else
                            <h4 class="text-center">لا توجد سجلات للعرض</h4>
                        @endif
                    </div><!-- bd -->
                    {!! $Expenses->appends(request()->search)->links() !!}
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!--div-->
        {{-- {!! $MainCategories->links() !!} --}}

    </div>
@stop
