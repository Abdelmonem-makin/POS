@extends('master.adminMaster')
@section('title', 'المنتجات')
@section('content')

    <div class="row row-sm">
        <!--/div-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-0">

                    <div class="d-flex justify-content-between">
                        <h3 class=" my-2 me-a"> المنتجات </h3>
                        <form class="row g-3 h-25 mt-1  needs-validation" action="{{ route('Product.index') }}" method="get">
                            <div class="col-md-6 m-0">
                                <input type="text" class="form-control  "  value="{{request()->search}}" id="validationCustom01" name="search">

                            </div>
                            <div class="col-md-6 m-0">
                                <button class="btn px-1 btn-primary" type="submit"><i class="fa mx-1 fa-search"
                                        aria-hidden="true"></i>بحث</button>

                                @if (auth()->user()->hasPermission('Product_create'))
                                    <a class="btn btn-primary my-0 ms-a"href="{{ route('Product.create') }}">اضافة منتج</a>
                                @else
                                    <a class="btn btn-primary my-0 disabled ms-a"href="{{ route('Product.create') }}">اضافة
                                        منتج</a>
                                @endif

                            </div>
                        </form>
                        <ol class="breadcrumb my-2">
                            <li><a class="py-0 text-dark nav-link px-1" href="{{ route('dashboard.index') }}"><i
                                        class="fa fa-home" aria-hidden="true"></i> الرئيسيه </a></li>
                            < <li class="active mx-2"> المنتجات </a></li>
                        </ol>
                    </div>

                </div>
        @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    <p class="text-center ">{{Session::get('error')}}</p>
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{Session::get('success')}}</p>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($Products->count() > 0)

                            <table class="table table-bordered  text-center table-striped mg-b-0 p-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> اسم الدواء</th>
                                        {{-- <th>الصورة</th> --}}
                                        <th>القسم</th>
                                        {{-- <th>الوصف</th> --}}
                                        {{-- <th>سعر الشراء</th> --}}
                                        <th>سعر البيع</th>
                                        <th>الكميه </th>
                                        <th>الحاله</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($Products)
                                        @foreach ($Products as $index => $Product)
                                            <tr>

                                                <th class="pt-4" scope="row">{{ $index + 1 }}</th>
                                                <th scope="row">{{ $Product->name }}</th>
                                                {{-- <th scope="row"><img height="100" width="100"
                                                        src="{{ asset($Product->photo) }}"></th> --}}
                                                <th scope="row">{{ $Product->Categorie->name }}</th>
                                                {{-- <th scope="row">{{ Str::words($Product->discription, 2, ' ...') }}</th> --}}
                                                {{-- <th scope="row">{{ $Product->price }}</th> --}}
                                                <th scope="row">{{ $Product->sell_price  }}</th>
                                                <th scope="row">{{ $Product->Quantity }}</th>

                                                <th scope="row">

                                                    @if ($Product->status == 1)
                                                        مفعل
                                                    @else
                                                        غير مفعيل
                                                    @endif



                                                </th>

                                                <th>

                                                    @if (auth()->user()->hasPermission('Product_update'))
                                                        <a href="{{ route('Product.edit', $Product->id) }}"
                                                            class="btn btn-sm  m-1 btn-info"><i class="fa fa-edit"
                                                                aria-hidden="true"></i> تعديل</a>
                                                    @else
                                                        <a href="{{ route('Product.edit', $Product->id) }}"
                                                            class="btn btn-sm  disabled m-1 btn-info"><i class="fa fa-edit"
                                                                aria-hidden="true"></i> تعديل</a>
                                                    @endif

                                                    @if (auth()->user()->hasPermission('Product_delete'))
                                                        <form action="{{ route('Product.destroy', $Product->id) }}"
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



                                                    @if (auth()->user()->hasPermission('Category_update'))
                                                        <a href="{{ route('Product_chaneg_Status', $Product->id) }}"
                                                            class="btn  py-0 btn-sm btn-outline-primary btn-min-width my-2 box-shadow-5">
                                                            @if ($Product->status == 1)
                                                                <div style="width: 0px; margin-top: 3px;"
                                                                    class="form-check   form-switch ">
                                                                    <input disabled class=" form-check-input  " type="checkbox"
                                                                        @if ($Product->status == 1) checked @endif>
                                                                </div>
                                                            @else
                                                                <div style="width: 0px; margin-top: 3px;"
                                                                    class="form-check   form-switch ">
                                                                    <input disabled class=" form-check-input " type="checkbox">
                                                                </div>
                                                            @endif
                                                        </a>
                                                    @else
                                                        <a href="{{ route('Product_chaneg_Status', $Product->id) }}"
                                                            class="btn disabled py-0 btn-sm btn-outline-primary btn-min-width my-2 box-shadow-5">
                                                            @if ($Product->status == 1)
                                                                <div style="width: 0px; margin-top: 3px;"
                                                                    class="form-check   form-switch ">
                                                                    <input disabled class=" form-check-input  " type="checkbox"
                                                                        @if ($Product->status == 1) checked @endif>
                                                                </div>
                                                            @else
                                                                <div style="width: 0px; margin-top: 3px;"
                                                                    class="form-check   form-switch ">
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
                        @else
                            <h4 class="text-center">لا توجد سجلات للعرض</h4>
                        @endif
                    </div><!-- bd -->
                {!! $Products->appends(request()->search)->links() !!}
            </div><!-- bd -->
            </div><!-- bd -->
        </div>
 

    </div>
@stop
