<div id="order-list">

    <div class="table-responsive order-list col-xl-12">
        <table class="table  table-bordered mb-2  text-center table-striped mg-b-0 p-0 text-md-nowrap">
            <thead>
                <tr>
                    <th> اسم المنج</th>
                    <th> الكميه</th>

                    {{-- <th> </th> --}}
                    <th>السعر</th>
                </tr>
            </thead>
            <tbody>
                @isset($orders_pro)
                    @foreach ($orders_pro as $product)
                        <tr>
                            <th scope="row">{{ $product->name }}</th>
                            <th scope="row">{{ $product->pivot->quantity }}</th>
                            <th scope="row">{{ number_format($product->pivot->quantity * $product->price) }}</th>


                        </tr>
                    @endforeach
                @endisset


            </tbody>

        </table>


    </div>
    <div class="d-flex justify-content-between">
        <div>اجمالي المبلغ:</div>
        <div class="total-price">SD {{ number_format($orders->total_price, 2) }} </div>
    </div>
</div>
<!--  Modal trigger button  -->


<a href="http://" class="btn print-order-btn btn-success   w-100">
    طباعه</a>
