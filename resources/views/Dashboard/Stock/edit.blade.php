@extends('Master.adminMaster')
@section('title', ' تعديل منتج للمخزن')
@section('content')
    <div class="card  ">
        <div class="card-header ">


            <div class="d-flex justify-content-start">

                <a href="{{ route('User.index') }}" class=" nav nav-link me-a">المخزون</a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a"> تعديل منتج الى المخزون </p>


            </div>
        </div>

        <div class="card-body w-75 mt-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif

            <div class="container">
                <h2>تعديل بيانات المخزون</h2>

               
                <form action="{{ route('Stock.update', ['Stock'=>$stock->id]  ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="supplier_id">المورد</label>
                        <select name="supplier_id" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option  @if ($supplier->id == $stock->supplier_id) selected @endif value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_id">اختر طريقة الدفع</label>
                        <select name="payment_id" class="form-control">
                            @foreach ($payment_methods as $payment)
                                <option value="{{ $payment->id }}" @if ($payment->id == $stock->payment_id) selected @endif>
                                    {{ $payment->method_name }}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="transiction_no">رقم العملية</label>
                        <input value="{{ $stock->transiction_no}}" type="number" name="transiction_no" class="form-control">
                    </div>

                    <div class="form-group">
                        <label  for="total_price">المبلغ الكلي</label>
                        <input value="{{ $stock->total_price}}" type="number" name="total_price" class="form-control" step="0.01">
                    </div>

                    <div class="form-group">
                        <label for="paid">المبلغ المدفوع</label>
                        <input value="{{ $stock->debt->first()->paid}}" type="number" name="paid" class="form-control" step="0.01">
                    </div>

                    <h4>المنتجات المرتبطة</h4>
                    @foreach ($allProducts as $product)
                        @php
                            $pivot = $stock->Product->find($product->id)?->pivot;
                        @endphp

                        <div class="form-group">
                            <label>{{ $product->name }}</label>

                            <div class="row">
                                <div class="col-md-6">الكمية
                                    <input type="number" name="products_stock[{{ $product->id }}][quantity]"
                                        class="form-control" placeholder="الكمية"
                                        value="{{ old("products.$product->id.quantity", $pivot?->quantity) }}">
                                </div>

                                <div class="col-md-6">الصلاحية
                                    <input type="date" name="products_stock[{{ $product->id }}][expir_data]"
                                        class="form-control" placeholder="تاريخ الصلاحية"
                                        value="{{ old("products.$product->id.expir_data", $pivot?->expir_data) }}">
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <button type="submit" class="btn btn-primary">تحديث</button>
                </form>
            </div>
            {{-- <form method="POST" action="{{ route('Stock.update', ['Stock'=>$editID->id] ) }}" id="selectForm2">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="product_id" class="col-md-3 col-form-label text-md-start ">اسم المنتج</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <select class="form-select form-select-md @error('product_id') is-invalid @enderror"
                                        name="product_id" id="product_id" data-placeholder=" اختار المنتج ....."
                                        style="width:100%">
                                        <option disabled>اسم المنتج </option>
                                        @isset($Products)
                                            @foreach ($Products as $Product)
                                                <option value="{{ $Product->id }}"
                                                    @if ($Product->id == $editID->product_id) selected @endif>
                                                    {{ $Product->name }}
                                                </option>
                                            @endforeach
                                        @endisset


                                    </select>
                                    @error('TransactionType')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="TransactionType" class="col-md-3 col-form-label text-md-start ">نوع العمليه</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <select
                                        class="form-select form-select-md @error('TransactionType') is-invalid @enderror"
                                        name="TransactionType" id="TransactionType"
                                        data-placeholder=" اختار نوع العمليه ....." style="width:100%">
                                        <option disabled selected>نوع العمليه </option>


                                        <option {{ $editID->TransactionType == 'سحب' }} selected :>
                                            سحب
                                        </option>
                                        <option {{ $editID->TransactionType == 'ايداع' }} selected :>
                                            ايداع
                                        </option>


                                    </select>
                                    @error('TransactionType')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="Supplier_id" class="col-md-3 col-form-label text-md-start  ">اسم المورد</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <select class="form-select form-select-md @error('Supplier_id') is-invalid @enderror"
                                        name="Supplier_id" id="Supplier_id" data-placeholder=" اختار المورد ....."
                                        style="width:100%">
                                        <option value="1" selected>اسم المورد </option>

                                        @isset($suppliers)
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"  @if ($supplier->id == $editID->Supplier_id) selected @endif
                                                    >
                                                    {{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        @endisset

                                    </select>
                                    @error('TransactionType')
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="Quantity" class="col-md-3 col-form-label text-md-start ">الكميه</label>

                            <div class="col-md-9">
                                <input id="Quantity" type="number"
                                    class="form-control @error('Quantity') is-invalid @enderror"
                                    value="{{ $editID->Quantity }}" name="Quantity" autocomplete="Quantity">
                                @error('Quantity')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="expir_data" class="col-md-3 col-form-label    "> انتهاء
                                الصلاحيه</label>

                            <div class="col-md-9">
                                <input id="expir_data" type="date"
                                    class="form-control @error('expir_data') is-invalid @enderror"
                                    value="{{ $editID->expir_data }}" name="expir_data" autocomplete="expir_data">
                                @error('expir_data')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="row">
                            <label for="price" class="col-md-3 col-form-label text-md-start  ">السعر</label>

                            <div class="col-md-9">
                                <input id="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" value="{{ $editID->price }}"
                                    name="price" autocomplete="price">
                                @error('price')
                                    <span class="text-danger">{{ $message }}*</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4 text-md-start me-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('trans.updata') }}
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
@endsection
