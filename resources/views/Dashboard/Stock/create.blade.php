@extends('Master.adminMaster')
@section('title', ' اضافة منتج للمخزن')
@section('content')
    <div class="card  ">
        <div class="card-header ">
            <div class="d-flex justify-content-start">
                <a href="{{ route('User.index') }}" class=" nav nav-link me-a">المخزون</a>
                <h3 class="  me-a">-</h3>
                <p class="nav  text-dark nav-link me-a"> اضافة منتج الى المخزون </p>
            </div>
        </div>
        <div class="card-body   mt-auto">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <p class="text-center ">{{ Session::get('success') }}</p>
                </div>
            @endif
            @if (Session::has('error'))
                <div id="alertBox" class="alert  alert-danger " role="alert">
                    <p class="text-center ">{{ Session::get('error') }}</p>
                </div>
            @endif
            <div class="row ">
                <div class="col-md-9">
                    <div class="card-body ">
                        <div class="table-responsive ">
                            @if ($Products->count() > 0)
                                <table class="table table-bordered  text-center table-striped mg-b-0  p-0 text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> اسم الدواء</th>
                                            {{-- <th>الصورة</th> --}}
                                            <th>القسم</th>
                                            {{-- <th>الوصف</th> --}}
                                            {{-- <th>سعر الشراء</th> --}}
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
                                                    <th scope="row">{{ $Product->Quantity }}</th>

                                                    <th scope="row">

                                                        @if ($Product->status == 1)
                                                            مفعل
                                                        @else
                                                            غير مفعيل
                                                        @endif
                                                    </th>
                                                    <th>
                                                        <a id = "product-Stock{{ $Product->id }}"
                                                            data-name="{{ $Product->name }}" data-id="{{ $Product->id }}"
                                                            class="btn btn-dark my-0 py-0 add-product_Stock-btn px-4 "
                                                            href="">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>اضافه
                                                        </a>

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
                        {{-- {!! $Products->appends(request()->search)->links() !!} --}}
                    </div><!-- bd -->
                </div>
                <div class="col-md-3">
                    <div class="    ">
                        <!-- Cart Items -->
                        <div class="row">
                            <div class="col-12   ">
                                <h3>طلبيات الصيدليه </h3>
                                <form   method="POST" action="{{ route('Stock.store') }}" class="parsley-style-1">
                                    {{ csrf_field() }}
                                    {{-- {{ method_field('post') }} --}}
                                    <div class="cart-stock-shoping row">
                                        <div class="order-list">

                                        </div>
                                    </div>





                                    <!-- Cart Summary -->
                                    <div class="col-12">
                                        <div class="cart-summary">
                                            <div class="row mb-3">
                                                <label for="payment_id" class="col-md-4 col-form-label  px-0 ">طريقة
                                                    الدفع</label>

                                                <div class="col-md-8">
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
                                                    @error('payment_id')
                                                        <span class="text-danger">{{ $message }}*</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="transiction_no" class="col-md-4 col-form-label text-md-end">رقم
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
                                            <div class="row mb-3">
                                                <label for="total_price" class="col-md-4 col-form-label text-md-end">
                                                    المبلغ الكلي </label>

                                                <div class="col-md-8">
                                                    <input id="total_price" type="number" class="form-control  "
                                                        name="total_price" autofocus>

                                                    @error('pay_price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="paid_amount" class="col-md-4 col-form-label text-md-end">
                                                    المبلغ المدفوع </label>

                                                <div class="col-md-8">
                                                    <input id="paid_amount" type="number" class="form-control  "
                                                        name="paid_amount" autofocus>

                                                    @error('paid_amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="Supplier_id" class="col-md-4 col-form-label text-md-start  ">
                                                    المورد</label>
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <select
                                                            class="form-select form-select-md @error('Supplier_id') is-invalid @enderror"
                                                            name="Supplier_id" id="Supplier_id"
                                                            data-placeholder=" اختار المورد ....." style="width:100%">
                                                            <option value="1" selected>اسم المورد </option>

                                                            @isset($suppliers)
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}">
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

                                            <hr>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <button type="submit" id="add-stock-btn"
                                                        class="btn w-100 btn-success my-3 disabled text-center">
                                                        تاكيد الطلب
                                                    </button>
                                                    {{-- div> --}}
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <form method="POST" action="{{ route('Stock.store') }}" id="selectForm2">
                @csrf
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="row">

                            <label for="product_id" class="col-md-3 col-form-label text-md-start ">اسم المنتج</label>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <select class="form-select form-select-md @error('product_id') is-invalid @enderror"
                                        name="product_id" id="product_id" data-placeholder=" اختار المنتج ....."
                                        style="width:100%">
                                        <option disabled selected>اسم المنتج </option>

                                        @isset($Products)
                                            @foreach ($Products as $Product)
                                                <option value="{{ $Product->id }}">
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
                                    <select class="form-select form-select-md @error('TransactionType') is-invalid @enderror"
                                        name="TransactionType" id="TransactionType" data-placeholder=" اختار نوع العمليه ....."
                                        style="width:100%">
                                        <option disabled selected>نوع العمليه </option>


                                        <option>
                                            سحب
                                        </option>
                                        <option>
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
                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->name}}
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
                                    class="form-control @error('Quantity') is-invalid @enderror" name="Quantity"
                                    autocomplete="Quantity">
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
                                    class="form-control @error('expir_data') is-invalid @enderror" name="expir_data"
                                    autocomplete="expir_data">
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
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    autocomplete="price">
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
                            {{ __('trans.Register') }}
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
   <script>
            (function() {
                const form = document.getElementById('stockForm');
                const submitBtn = document.getElementById('add-stock-btn');

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    submitBtn.disabled = true;

                    const formData = new FormData(form);

                    try {
                        const res = await fetch('{{ route('Stock.store') }}', {
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
                            // Reset form fields (payment, transiction_no, etc.)
                            form.reset();
                            // Disable submit since cart is empty (visual + property)
                            submitBtn.classList.add('disabled');
                            submitBtn.disabled = true; // keep for direct DOM compatibility
                            $(submitBtn).prop('disabled', true);
                            // Optionally re-enable product buttons if you disabled them earlier
                            $('.add-product_Stock-btn').removeClass('btn-default disabled').addClass('btn-dark');
                            // ensure the global calculat() logic sees the button as disabled
                            $('#add-stock-btn').prop('disabled', true);

                            // Show success feedback
                            alert(data.message || 'تم اضافة الفاتور بنجاج  بنجاح');
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
        </script>
@endsection
