@extends('master.adminMaster')
@section('title', 'الاقسام')
@section('content')

    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">


                    <div class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> الاقسام </h3>
                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Category.index') }}"
                            method="get">
                            <div class="col-md-6 m-0">
                                <input type="text" class="form-control  " value="{{ request()->search }}"
                                    id="validationCustom01" name="search">

                            </div>
                            <div class="col-md-6 m-0">
                                <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                        aria-hidden="true"></i>بحث</button>


                                @if (auth()->user()->hasPermission('Category_create'))
                                    <a class="btn btn-primary my-0 ms-a"href="{{ route('Category.create') }}">اضافة قسم</a>
                                @else
                                    <a class="disabled btn btn-primary my-0 ms-a"href="{{ route('Category.create') }}">اضافة
                                        قسم</a>
                                @endif

                            </div>
                        </form>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark px-1 nav-link" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> الاقسام </a></li>
                        </ol>
                    </div>

                </div>
                @if (Session::has('error'))
                    <div id="alertBox" class="alert  alert-danger " role="alert">
                        <p class="text-center ">{{ Session::get('error') }}</p>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success d-none " role="alert">
                        <p class="text-center ">{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> اسم القسم</th>
                                    <th> الحاله</th>
                                    <th> الاجؤاءات </th>


                                </tr>
                            </thead>
                            <tbody>
                                @isset($Categores)

                                    @foreach ($Categores as $index => $Category)
                                        <tr>

                                            <th class="pt-4" scope="row">{{ $index + 1 }}</th>
                                            <th scope="row">{{ $Category->name }}</th>
                                            <th scope="row">
                                                @if ($Category->status == 1)
                                                    مفعل
                                                @else
                                                    غير مفعيل
                                                @endif

                                            </th>


                                            <th>


                                                @if (auth()->user()->hasPermission('Category_update'))
                                                    <a href="{{ route('Category.edit', $Category->id) }}"
                                                        class="btn btn-sm my-1 btn-outline-primary"> تعديل<i class="fa fa-edit"
                                                            aria-hidden="true"></i></a>
                                                @else
                                                    <a href="{{ route('Category.edit', $Category->id) }}"
                                                        class="btn btn-sm my-1 btn-outline-primary disabled"> تعديل<i
                                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                                @endif

                                                {{-- ########################## ############################################## --}}

                                                @if (auth()->user()->hasPermission('Category_delete'))
                                                    <form action="{{ route('Category.destroy', $Category->id) }}"
                                                        method="post" class="d-inline">
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

                                                @if (auth()->user()->hasPermission('Category_update'))
                                                    <a href="{{ route('Category_chaneg_Status', $Category->id) }}"
                                                        class="btn  py-0 btn-sm btn-outline-primary btn-min-width my-2 box-shadow-5">
                                                        @if ($Category->status == 1)
                                                            <div style="width: 0px; margin-top: 3px;"
                                                                class="form-check   form-switch ">
                                                                <input disabled class=" form-check-input  " type="checkbox"
                                                                    @if ($Category->status == 1) checked @endif>
                                                            </div>
                                                        @else
                                                            <div style="width: 0px; margin-top: 3px;"
                                                                class="form-check  form-switch ">
                                                                <input disabled class=" form-check-input " type="checkbox">
                                                            </div>
                                                        @endif

                                                    </a>
                                                @else
                                                    <a href="{{ route('Category_chaneg_Status', $Category->id) }}"
                                                        class="btn  py-0 btn-sm disabled btn-outline-primary btn-min-width my-2 box-shadow-5">
                                                        @if ($Category->status == 1)
                                                            <div style="width: 0px; margin-top: 3px;"
                                                                class="form-check   form-switch ">
                                                                <input disabled class=" form-check-input  " type="checkbox"
                                                                    @if ($Category->status == 1) checked @endif>
                                                            </div>
                                                        @else
                                                            <div style="width: 0px; margin-top: 3px;"
                                                                class="form-check  form-switch ">
                                                                <input disabled class=" form-check-input " type="checkbox">
                                                            </div>
                                                        @endif

                                                    </a>
                                                @endif

                                            </th>

                                        </tr>
                                    @endforeach
                                @endisset


                            </tbody>
                        </table>
                    </div><!-- bd -->
                    {!! $Categores->appends(request()->search)->links() !!}
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!--div-->
        {{-- {!! $MainCategories->links() !!} --}}

    </div>
@stop
