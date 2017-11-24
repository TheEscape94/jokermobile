$(document).ready(function () {

    //CART - add, clear all, remove one

    //add to cart
    $('.add_to_cart_phones').click(function () {
        $('.cart-footer').show();
        $(this).attr('disabled', true);

        var id = $(this).attr('data-id');
        var q = parseInt($('.quantity-of').val());
        if(q == null){
            q = 1;
        }
        var type = $(this).attr('data-type');

        $.ajax({
            type: "POST",
            url: "/cart/add_to_cart",
            dataType: "json",
            data: {
                id: id,
                q:q,
                type: type
            },
            asynx:true,
            success: function(response) {
                $('.add_to_cart_phones').attr('disabled', false);
                //append
                appendCartTr(response.id, response.img, response.name, response.q, response.price, response.qq, type);
                $('.cart-notify p').text(response.name);
                $('.cart-notify').show(150);

                var items = $(".cart-list-product");
                $('.count-cart').text(items.length);

                var q = parseInt($('.quantity-of').val());
                var allprice = $('.all-products-price');
                var countprice = parseInt(allprice.text()) + q * response.price;
                allprice.text(countprice);

                $('.cart-table-notify').hide();
            }
        });
    });

    //clear cart
    $('.clear-cart-list').click(function () {
        $.ajax({
            type: "POST",
            url: "/cart/del_from_cart",
            dataType: "json",
            data: '',
            asynx:true,
            success: function(response) {
                $('.cart-result-table tr').remove();
                $('.count-cart').text('0');
                $('.all-products-price').text('0');
                $('.cart-result-table').append('<p class="cart-table-notify">Vaša korpa je prazna</p>')
            }
        });
    });

    //remove one item from cart
    $('.remove-item').click(function(){
        $(this).parent().parent().hide();
        var c = parseInt($('.count-cart').text());
        $('.count-cart').text(c - 1);

        var id = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "/cart/del_one_from_cart",
            dataType: "json",
            data: {
                id: id
            },
            asynx:true,
            success: function(response) {
                var allprice = $('.all-products-price');
                var countprice = parseInt(allprice.text) - response.q * response.price;
                allprice.text(countprice);
            }
        });
    });

    //WISHLIST - add, clear all, remove one, add to cart

    $('.action-wishlist').click(function () {
        $('.wishlist-footer').show();

        var id = $(this).attr('data-id');
        var link = $(this).attr('data-link');
        var type = $(this).attr('data-type');

        $.ajax({
            type: "POST",
            url: "/wishlist/add_to_wishlist",
            dataType: "json",
            data: {
                id: id,
                type: type,
                link: link,
            },
            asynx:true,
            success: function(response) {
                appendWishlistTr(response.id, response.img,response.name, response.price, response.link, type);

                $('.favorite-notify p').text(response.name);
                $('.favorite-notify').show(150);

                var items = $(".wish-list-product");
                $('.count-wishlist').text(items.length);

                $('.wish-table-notify').hide();
            }
        });
    });

    $('.clear-wishlist').click(function () {
        $.ajax({
            type: "POST",
            url: "/wishlist/del_from_wishlist",
            dataType: "json",
            data: '',
            asynx:true,
            success: function(response) {
                $(this).hide();
                $('.wish-table-notify').show();
                $('.wish-table tr').remove();
                $('.count-wishlist').text('0');
                $('.wish-table').append('<p class="cart-table-notify">Vaša lista želja je prazna</p>')
            }
        });
    });

    //FIND DISCOUNT
    $('.check-discount').click(function () {
        var oldfinal = parseInt($('.final-all-price').text());
        var code = $('.discount-code').val();
        var res = $('.discount-result');
        if(code != ''){
            $.ajax({
                type: "POST",
                url: "/discount/find_discount",
                dataType: "json",
                data: {
                    code: code
                },
                asynx:true,
                success: function(response) {
                    if(response.finded == true){

                        var typeOf;
                        var final = parseInt($('.final-all-price').text());
                        if(response.type == 0){
                            typeOf = '%';
                            $('.final-all-price').text(final - (response.discount / 100 * final) + ' RSD');
                        } else {
                            typeOf = 'RSD';
                            $('.final-all-price').text(final - response.discount + ' RSD');
                        }
                        $('.discount-code').attr('disabled', 'true');
                        $('.check-discount').attr('disabled', 'true');

                        res.append('<span class="label label-success pull-right">Popust je pronadjen, ' + response.name +
                            '! Ostvarili ste <strong>' + response.discount + ' ' + typeOf +
                            ' popusta!</strong></span>');

                    } else {
                        res.append('<span class="label label-danger pull-right">Popust nije pronadjen!</span>')
                        $('.final-all-price').text(oldfinal + ' RSD');
                    }
                }
            });
        } else {
            $('.discount-result span').text('Morate uneti promo kod!')
        }
    });

    //NEWSLETTER
    $('#newsletter button').click(function () {
        var mail = $('#newsletter input').val();
        $.ajax({
            type: "POST",
            url: "/api/newsletter_get",
            dataType: "json",
            data: {
                mail:mail
            },
            asynx:true,
            success: function(response) {
                $('#newsletter p').text('Vaš email je uspešno dodat!');
            }
        });
    });

});

function appendCartTr(id, img, name, q, price, qq, type){
    var tablelist = $('.cart-result-table');
    var linkprefix="";
    if(type == 0){
        linkprefix = '/bundles/app/upload/phones/';
    } else {
        linkprefix = 'bundles/app/upload/equiment/';
    }
    tablelist.append(
        '<tr class="cart-list-product">' +
        '<td><img src="'+ linkprefix + img +'" alt="product"></td>' +
        '<td>' +
        '<h6>' + name + '</h6>' +
        '</td>' +
        '<td>' +
        '<span class="quantity"><span class="light">'+ q +' x </span>' + price + ' RSD</span>' +
        '<a class="parent-color btn btn-link remove-item" data-id="'+ qq +'"><i class="fa fa-minus"></i> Ukloni</a>' +
        '</td>' +
        '</tr>'
    );
}

function appendWishlistTr(id, img, name, price, link, type){
    var tablelist = $('.wish-table');
    var linkprefix="";
    if(type == 0){
        linkprefix = '/bundles/app/upload/phones/';
    } else {
        linkprefix = '/bundles/app/upload/equiment/';
    }
    tablelist.append(
        '<tr class="wish-list-product">' +
        '<td><img src="'+ linkprefix + img +'" alt="product"></td>' +
        '<td>' +
        '<h6>' + name + '</h6>' +
        '</td>' +
        '<td>' +
        '<span class="quantity"><span class="light"></span>' + price + ' RSD</span>' +
        '<a href="' + link + '" class="parent-color"><i class="fa fa-plus"></i> Dodaj u korpu</a>' +
        '</td>' +
        '</tr>'
    );
}
