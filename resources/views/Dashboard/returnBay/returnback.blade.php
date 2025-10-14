    @extends('layouts.app')
    @section('content')
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
        <form method="POST" class="w-50 m-auto" action="{{ route('return-store', $order->id) }}">
            @csrf
            <h4>إرجاع منتج من فاتورة</h4>

            <div class="mb-3">
                <label>رقم الفاتورة</label>
                <input type="text" hidden value="{{ $order->id }}" name="sale_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>المنتج</label>
                <select name="product_id" class="form-control" required>
                    @foreach ($Products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>الكمية المرتجعة</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            {{-- <div class="mb-3">
                <label>السعر</label>
                <input type="number" value="{{$order->products->sell_price}}" name="price" class="form-control" required>
            </div> --}}

            <div class="mb-3">
                <label>سبب الإرجاع</label>
                <input type="text" name="reason" class="form-control">
            </div>

            <div class="mb-3">
                <label>الحالة</label>
                <select name="status" class="form-control">
                    <option value="restocked">أعيد للمخزون</option>
                    <option value="discarded">تم التخلص منه</option>
                </select>
            </div>

            <button type="submit" class="btn btn-danger">تسجيل الإرجاع</button>
        </form>
    @endsection
    @section('scripts')
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endsection
