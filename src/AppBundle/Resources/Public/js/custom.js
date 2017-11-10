$(document).ready(function () {
    $('form').addClass('form-horizontal');
    $('form').addClass('form-label-left');

    $('.form-control').parent().addClass('col-md-12 col-xs-12');

    $('.parent-half').parent().addClass('col-md-6 col-xs-12');
    $('.parent-third').parent().addClass('col-md-4 col-xs-6');
    $('.parent-quoter').parent().addClass('col-md-3 col-xs-4');

    $('.first-user-field').parent().prepend('<hr/><br/><h3>Popunite Vaše lične podatke kako bi smo Vas mogli kontaktirati</h3><br/><hr/>')

    $('.notnew').parent().hide();

    $('#buyingModalbtn').click();

    $('.check-new').change(function () {
        if($(this).val() == 1){
           $(this).parent().addClass('col-md-6 col-xs-12');
           $('.notnew').parent().show();
        } else if ($(this).val() == 0){
            $(this).parent().removeClass('col-md-6');
            $(this).parent().addClass('col-md-12');
            $('.notnew').parent().hide();
        }
    })

    $('.results-preview-user').parent().append("<br/><button class='btn btn-warning btn-large upload'>Izaberi fotografije</button><br/><br/>");
    $('.upload').click(function () {$('.results-preview-user').click();})

    $('.results-preview-user').change(function () {
        if($(this).get(0).files.length < 5){
            $('.preview-box').remove();
            $('.results-preview-user').parent().append(
                "<div class='preview-box'><p><strong>Izabrane fotografije:</strong></p><br/></div>"
            );
            for(var i = 0; i < $(this).get(0).files.length; ++i ){
                $('.preview-box').append('<p><i class="icons icon-picture"></i> ' + $(this).get(0).files[i].name +'</p>')
            }
        } else {
            $('.danger').click();
            $('#danger-msg').text('Dozvoljeno je ukupno 5 slika!');
            $('.preview-box').remove();
            $('.results-preview-user').val('');
        }
    })

    var c = $('.chosedone').text();
    $('.choosed').val(c);

    $('.sending-load').click(function () {
        var c = 0;

        //check input
        $('.field_check').each(function(i, obj) {
            if(i.val() == ''){
                c = 1;
            }
        });

        //check files
        if($('.results-preview-user').files.length == 0){
            c = 1;
        }

        if(c == 1){
            $('html,body').animate({scrollTop: $(".required-fields").offset().top}, 'slow');
            $(".required-fields").addClass('text-danger');
        } else {
            $('.server-loading').show();
        }
    })

    //add in wish list - FRONT
    $('.action-wishlist').click(function () {
        $('.wish-table-notify').hide();
        $('.clear-wishlist').show();

        var tableList = $('.wish-table');

        var price = $(this).attr('data-price');
        var imgsrc = $(this).attr('data-img');
        var link = $(this).attr('data-link');
        var name = $(this).attr('data-name');

        tableList.append(
            '<tr class="wish-list-product">' +
                '<td><img src="'+ imgsrc +'" alt="product"></td>' +
                '<td>' +
                    '<h6>' + name + '</h6>' +
                '</td>' +
                '<td>' +
                    '<span class="quantity"><span class="light"></span>' + price + ' RSD</span>' +
                    '<a href="' + link + '" class="parent-color"><i class="fa fa-plus"></i> Dodaj u korpu</a>' +
                '</td>' +
            '</tr>'
        );

        var items = $(".wish-list-product");
        $('.count-wishlist').text(items.length);

    });

    $('.clear-wishlist').click(function (e) {
        $(this).hide();
        $('.wish-table-notify').show();
        $('.wish-table tr').remove();
        $('.count-wishlist').text('0');
    });

    //add in cart list - FRONT

    $('.action-cart').click(function () {
        $('.cart-table-notify').hide();
        $('.cart-footer').show();

        var tablelist = $('.cart-result-table');
        var allprice = $('.all-products-price');

        var q = parseInt($('.quantity-of').val());

        var price = parseInt($(this).attr('data-price'));
        var img = $(this).attr('data-img');
        var name = $(this).attr('data-name');

        var countprice = parseInt(allprice.text()) + q * price;

        tablelist.append(
            '<tr class="cart-list-product">' +
            '<td><img src="'+ img +'" alt="product"></td>' +
            '<td>' +
            '<h6>' + name + '</h6>' +
            '</td>' +
            '<td>' +
            '<span class="quantity"><span class="light">'+ q +' x </span>' + price + ' RSD</span>' +
            '<a class="parent-color"><i class="fa fa-minus"></i> Ukloni</a>' +
            '</td>' +
            '</tr>'
        );

        allprice.text(countprice);

        var items = $(".cart-list-product");
        $('.count-cart').text(items.length);
    });

    $('.clear-cart-list').click(function () {
        $('.cart-result-table tr').remove();
        $('.count-cart').text('0');
        $('.cart-footer').hide();
        $('.cart-table-notify').show();
        $('.all-products-price').text('0');
    });

})