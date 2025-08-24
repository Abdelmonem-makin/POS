@extends('layouts.app')
@section('content')
    <div class="mx-5">
        <div class="card ">
            <div class="card-header py-0 ">

                <div class="d-flex ">
                    <h3 class=" my-1 me-a"> <i class="fa fa-print" aria-hidden="true"></i> الكاشير </h3>
                </div>
            </div>

            <div class="card-body">
                <div class="row ">
                    <div class="col-md-9">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @isset($Categorys)
                                @foreach ($Categorys as $index => $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $index == 0 ? 'active' : '' }} "
                                            id="home-tab{{ $index }}" data-bs-toggle="tab"
                                            data-bs-target="#home{{ $index }}" type="button" role="tab"
                                            aria-controls="home{{ $index }}"
                                            aria-selected="{{ $index == 1 ? 'true' : 'fales' }}">
                                            {{ $category->name }} </button>


                                    </li>
                                @endforeach
                            @endisset

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3">


                            @isset($Categorys)
                                @foreach ($Categorys as $index => $Category)
                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }}  " id="home{{ $index }}"
                                        role="tabpanel" aria-labelledby="home-tab{{ $index }}">


                                        <div class="row gx-3 gx-lg-4 ">
                                            @foreach ($Category->Product as $product)
                                                <div class="col-sm-12 col-md-3 col-xl-4 mb-5">
                                                    <div class="card ">
                                                        <!-- Product image-->
                                                        <div class=" my-3"
                                                            style="
                                                        display: flex;
                                                        justify-content: center;
                                                    ">
                                                            <img class="card-img-top w-75 " height="170" width="140"
                                                                src="{{ asset($product->photo) }}" alt="..." />
                                                        </div>

                                                        <!-- Product details-->
                                                        <div class="text-center">
                                                            <!-- Product name-->
                                                            <h5 class="fw-bolder m-2 h-25">{{ $product->name }}</h5>
                                                            <!-- Product price-->
                                                            <p class="m-0"> {{ number_format($product->price) }}</p>
                                                        </div>
                                                        <!-- Product actions-->
                                                        <div class="card-footer  pt-0 border-top-0 bg-transparent">
                                                            <div class="text-center">
                                                                <a id = "product-{{ $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-id="{{ $product->id }}"
                                                                    data-price="{{ $product->price }}"
                                                                    data-img="{{ $product->photo }}"
                                                                    class="btn btn-dark my-0 py-0 add-product-btn px-4 "
                                                                    href="">+</a>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endisset

                        </div>

                    </div>
                    <div class="col-md-3  ">
                        <div class="container  cart-container">
                            <!-- Cart Items -->
                            <div class="row">
                                <div class="col-12   ">
                                    <h3>الطلبات </h3>

                                    <!-- Cart Item 1 -->

                                    <form action="{{ route('Order.store') }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('post') }}
                                        <div class="cart-shoping row">
                                            <div class="order-list">

                                            </div>
                                        </div>





                                        <!-- Cart Summary -->
                                        <div class="col-12">
                                            <div class="cart-summary">
                                                <div class="row mb-4">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">اسم
                                                        الزبون</label>

                                                    <div class="col-md-8">
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="phone" class="col-md-4 col-form-label text-md-end">رقم
                                                        الهاتق </label>

                                                    <div class="col-md-8">
                                                        <input id="phone" type="number" class="form-control  "
                                                            name="phone" autofocus>

                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="row mb-4">
                                                    <label for="table" class="col-md-4 col-form-label text-md-end">رقم
                                                        الطازله </label>

                                                    <div class="col-md-8">
                                                        <input id="table" type="number" class="form-control  "
                                                            name="tabel" autofocus>

                                                        @error('table')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                                <h5> الاجمالي</h5>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <div>اجمالي المبلغ:</div>
                                                    <div class="total-price">0</div>

                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <button type="submit" id="add-order-btn"
                                                            class="btn w-100 btn-success my-3 disabled text-center">
                                                            تاكيد الطلب
                                                        </button>
{{--
                                                        <button type="button" class="btn btn-primary btn-lg"
                                                            data-bs-toggle="modal" data-bs-target="#modalId">
                                                            Launch
                                                        </button>

                                                        <!-- Modal Body-->
                                                        <div class="modal fade" id="modalId" tabindex="-1"
                                                            role="dialog" aria-labelledby="modalTitleId"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div id="print-bill" class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalTitleId">
                                                                            Modal title
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container-fluid">Add rows here</div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                            خروج
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-primary print-order-bill">طباعه</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-md-6">

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        {{-- end shoping card --}}


                    </div>
                </div>
            </div>

        </div>


    @endsection
