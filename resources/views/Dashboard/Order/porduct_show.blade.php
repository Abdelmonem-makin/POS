<!DOCTYPE html>
<html  lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="order-list">

    <div class="table-responsive order-list  col-xl-12">
        <table class="table  table-bordered mb-2 text-right  text-center table-striped mg-b-0 p-0 text-md-nowrap">
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
                <span>رقم الفاتوره: {{ $orders->invoice_number }}</span><br>
                <span>تاريخ الطلب: {{ $orders->created_at->format('Y-m-d') }}</span><br>
                <span>  عدد الطلبات: {{ $orders->products->count() }}</span>
                    @foreach ($orders_pro as $product)
                    <tr>
                            <th scope="row">{{ $product->name }}</th>
                            <th scope="row">{{ $product->pivot->quantity }}</th>
                            <th scope="row">{{ number_format($product->pivot->quantity * $product->sell_price) }}</th>


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




</body>
</html>
