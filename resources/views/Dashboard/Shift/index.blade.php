@extends('master.adminMaster')
@section('title', ' الورديات ')
@section('content')

    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">

                    <div class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> الورديات </h3>
                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Shift.index') }}" method="get">
                            <div class="col-md-6 m-0">
                                <input type="text" class="form-control  " value="{{ request()->search }}"
                                    id="validationCustom01" name="search">

                            </div>
                            <div class="col-md-6 m-0">
                                <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                        aria-hidden="true"></i>بحث</button>

                                @if (auth()->user()->hasPermission('Shift_create'))
                                    <a class="btn btn-primary my-0 ms-a"href="{{ route('Shift.create') }}">اضافة ورديه</a>
                                @else
                                    <a class="btn btn-primary my-0 disabled ms-a"href="{{ route('Shift.create') }}">اضافة
                                        منتج</a>
                                @endif

                            </div>
                        </form>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark nav-link px-1" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> الورديات </a></li>
                        </ol>
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        @if ($Shifts->count() > 0)

                            <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th>   الورديه </th>
                                        <th> اسم الموظف </th>
                                        <th>بداية الورديه </th>
                                        <th>نهاية الورديه  </th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($Shifts)
                                        @foreach ($Shifts as $index => $Shift)
                                            <tr>

                                                <th class="pt-4" scope="row">{{ $index + 1 }}</th>
                                                <th scope="row">{{ $Shift->name }}</th>
                                                <th scope="row">{{ $Shift->employee->name }}</th>
                                                <th scope="row">{{ $Shift->start_time }} </th>
                                                <th scope="row">{{ $Shift->end_time }}</th>

                                                </th>

                                                <th>

                                                    @if (auth()->user()->hasPermission('Shift_update'))
                                                        <a href="{{ route('Shift.edit', $Shift->id) }}"
                                                            class="btn btn-sm  m-1 btn-info"><i class="fa fa-edit"
                                                                aria-hidden="true"></i> تعديل</a>
                                                    @else
                                                        <a href="{{ route('Shift.edit', $Shift->id) }}"
                                                            class="btn btn-sm  disabled m-1 btn-info"><i class="fa fa-edit"
                                                                aria-hidden="true"></i> تعديل</a>
                                                    @endif

                                                    @if (auth()->user()->hasPermission('Shift_delete'))
                                                        <form action="{{ route('Shift.destroy', $Shift->id) }}" method="post"
                                                            class="d-inline">
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
                    {!! $Shifts->appends(request()->search)->links() !!}
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!--div-->
        {{-- {!! $MainCategories->links() !!} --}}

    </div>
@stop
