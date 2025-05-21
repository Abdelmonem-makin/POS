$(document).ready(function () {


    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $(this).data('price');

        var img = $(this).data('img');

        var html = '   <div id="cart-box-'+id+'" class="cart-shop-item row"><div class="col-4 my-1 ">  <img src="'+img+'" class="w-100"src="fa" alt="Product 1"></div><div class="col-4"><div class="cart-item-title">'+name+'</div><div class="cart-item-price prodcut-price">'+$.number(price , 2)+'</div></div><div class="col-4 m-auto text-right"> <input data-price="'+price+'" name="products['+id+'][quantity]" type="number" class="form-control text-center product-quanities m-auto p-0" value="1" min="1"><button type="submit" class="btn my-1 px-4 btn-sm remov-prodect-btn btn-danger " data-id="'+id+'"><i class="fa fa-trash mx-1" aria-hidden="true"></i></button></div><hr></div> ';
        $('.cart-shoping').append(html);
        calculat();


        $(this).removeClass('btn-dark').addClass('btn-default disabled');
    });//اضافة المنتج الى السله
    $('body').on('click','.disabled',function(e){
        e.preventDefault();
    });

    //هنا يتم الضغط على ذر عرض الطلبات يتم عرض المنتجات الخاصه بالطلب
    $('.Show-product').on('click',function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url : url,
            method : method,
            success: function(data){
                //هنا يتم تفريغ قائمة الطلبات و رض المنتجات التى تم تحديدها
                $('.list-order-product').empty();

                $('.list-order-product').append(data);
            }
        })
    });
    $('body').on('click','.remov-prodect-btn',function(e){
        e.preventDefault();
        var id= $(this).data('id');
        $('#cart-box-'+id).remove();
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-dark');

        calculat();

    });//حذف العنصر من السله
    $('body').on('click','#add-order-btn',function(){

        $('#add-order-btn').removeClass('disabled');
    });//حذف العنصر من السله

    $('body').on('change','.product-quanities',function(){
        var quanities = parseInt($(this).val());
        var price = parseInt($(this).data('price'));
        var totl =quanities*price ;


        $(this).closest('.cart-shop-item').find('.prodcut-price').html($.number(totl,2));
        calculat();
    });//حصاب قمة عدد من المنتجات و ايجاد  و قيمتها
    $(document).on('click','.print-order-btn',function(e){
        e.preventDefault();
        $('#order-list').printThis();
    });   //لطباعة فاتورة
});


function calculat(){
    var price = 0 ;

    $('.cart-shop-item .prodcut-price').each(function(index){
        price += parseFloat($(this).html().replace(/,/g,''));

    });
    // console.log($.number(price,2));
    $('.total-price').html( $.number(price,2));
    if ( price > 0) {
        $('#add-order-btn').removeClass('disabled')

    } else {
        $('#add-order-btn').addClass('disabled');
    }


}//دالة حستب اجمال قمة المبيعات
