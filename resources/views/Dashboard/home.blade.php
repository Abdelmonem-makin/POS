@extends('layouts.app')
@section('content')
    @if (Session::has('error'))
        <div id="alertBox" class="alert  alert-danger " role="alert">
            <p class="text-center ">{{ Session::get('error') }}</p>
        </div>
    @endif
    @if (Session::has('success'))
        <div id="alertBox" class="alert alert-success d-none " role="alert">
            <p class="text-center ">{{ Session::get('success') }}</p>
        </div>
    @endif

    <div id="result"></div>
    <div class="mx-5">
        <div class="card ">
            <div class="card-header py-0 ">
                <div class="row mb-3">

                    <div class="   col-md-4">
                        <h3 class=" my-1 me-a"> <i class="fa fa-print" aria-hidden="true"></i> الكاشير </h3>
                    </div>
                    <div class="col-md-6  ">
                        <div class="mb-4">
                            <input type="text" id="productSearch" class="form-control" placeholder="ابحث عن منتج...">
                        </div>

                    </div>
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
                                                <div class="col-sm-12 col-md-3 col-xl-4 mb-5 product-card"
                                                    data-name="{{ strtolower($product->name) }}">
                                                    <div class="card ">
                                                        <!-- Product image-->
                                                        <div class=" my-3"
                                                            style="
                                                        display: flex;
                                                        justify-content: center;
                                                    ">

                                                        </div>

                                                        <!-- Product details-->
                                                        <div class="text-center">
                                                            <!-- Product name-->
                                                            <h5 class="fw-bolder m-2 h-25">{{ $product->name }}</h5>
                                                            <!-- Product price-->
                                                            <p class="m-0"> {{ number_format($product->sell_price) }}
                                                            </p>
                                                        </div>
                                                        <!-- Product actions-->
                                                        <div class="card-footer  pt-0 border-top-0 bg-transparent">
                                                            <div class="text-center">
                                                                <a id = "product-{{ $product->id }}"
                                                                    data-name="{{ $product->name }}"
                                                                    data-id="{{ $product->id }}"
                                                                    data-price="{{ $product->sell_price }}"
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

                                    <form id="orderForm">
                                        {{ csrf_field() }}
                                        {{ method_field('post') }}
                                        <div class="cart-shoping row">
                                            <div class="order-list">

                                            </div>
                                        </div>





                                        <!-- Cart Summary -->
                                        <div class="col-12">
                                            <div class="cart-summary">
                                                <div class="row">
                                                    <label for="compane_name"
                                                        class="col-md-3 col-form-label text-md-start ">طريقة
                                                        الدفع</label>

                                                    <div class="col-md-9">
                                                        <select id="payment_id"
                                                            class="form-control @error('payment_id') is-invalid @enderror"
                                                            name="payment_id">
                                                            <option disabled selected value="">اختر طريقة الدفع
                                                            </option>
                                                            @foreach ($payment_methods as $payment)
                                                                <option value="{{ $payment->id }}">
                                                                    {{ $payment->method_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('compane_name')
                                                            <span class="text-danger">{{ $message }}*</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="transiction_no"
                                                        class="col-md-4 col-form-label text-md-end">رقم
                                                        العمليه </label>

                                                    <div class="col-md-8">
                                                        <input id="transiction_no" type="number" class="form-control  "
                                                            name="transiction_no" autofocus>

                                                        @error('transiction_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
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
                                                        {{-- div> --}}
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

        <script>
            (function() {
                const form = document.getElementById('orderForm');
                const submitBtn = document.getElementById('add-order-btn');

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    submitBtn.disabled = true;

                    const formData = new FormData(form);

                    try {
                        const res = await fetch('{{ route('Order.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });

                        const data = await res.json();

                        if (data.success) {
                            // Clear cart items
                            var id = $(this).data('id');

                            document.querySelectorAll('.cart-shoping').forEach(el => el.innerHTML = '');
                            // Reset totals
                            document.querySelectorAll('.total-price').forEach(el => el.textContent = '0');
                            // Reset form fields (payment, transiction_no, etc.)
                            form.reset();
                            // Disable submit since cart is empty (visual + property)
                            submitBtn.classList.add('disabled');
                            submitBtn.disabled = true; // keep for direct DOM compatibility
                            $(submitBtn).prop('disabled', true);
                            // Optionally re-enable product buttons if you disabled them earlier
                            $('.add-product-btn').removeClass('btn-default disabled').addClass('btn-dark');
                            // ensure the global calculat() logic sees the button as disabled
                            $('#add-order-btn').prop('disabled', true);

                            // Show success feedback
                            alert(data.message || 'تم الشراء بنجاح');
                        } else {
                            alert(data.message || 'حدث خطأ أثناء إنشاء الطلب');
                            // Keep the submit button enabled so user can retry
                            submitBtn.disabled = false;
                        }
                    } catch (err) {
                        alert('خطأ في الاتصال بالخادم');
                        submitBtn.disabled = false;
                    }
                });
            })();

            document.getElementById('productSearch').addEventListener('input', function() {
                let searchValue = this.value.toLowerCase();
                let cards = document.querySelectorAll('.product-card');

                cards.forEach(card => {
                    let name = card.getAttribute('data-name');
                    if (name.includes(searchValue)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        </script>

    @endsection
