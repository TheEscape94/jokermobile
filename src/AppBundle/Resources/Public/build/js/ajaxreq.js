$(document).ready(function () {

    //NEW REMINDER

    $('.add-reminder').click(function () {
        var txt = $('.reminder-txt').val();

        $.ajax({
            type: "POST",
            url: "/reminder/add_new",
            dataType: "json",
            data: {
                txt: txt
            },
            asynx:true,
            success: function(response) {
                prependReminder(response.id, response.name, response.month, response.day);
                $('.reminder-txt').val('');
            }
        });
    });

    //REMOVE REMINDER
    $('.remove-reminder').click(function(){
        $(this).parent().parent().hide();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "/reminder/del_reminder",
            dataType: "json",
            data: {
                id: id
            },
            asynx:true,
            success: function(response) {
            }
        });
    });

    //ADD DISCOUNT
    $('.add-discount').click(function () {

        var type = parseInt($('input[name=type]:checked').val());
        var discount = parseInt($('.discount-value').val());
        var name = $('.discount-name').val();
        var code = $('.discount-code').val();

        $.ajax({
            type: "POST",
            url: "/discount/add_new",
            dataType: "json",
            data: {
                type: type,
                disc: discount,
                name: name,
                code: code,
            },
            asynx:true,
            success: function(response) {
                prependDiscount(response.id, response.name, response.month, response.day, response.code, response.type, response.discount);
                $('.discount-value').val('');
                $('.discount-name').val('');
                $('.discount-code').val('');
            }
        });
    });

    //REMOVE DISCOUNT
    $('.remove-discount').click(function(){
        $(this).parent().parent().hide();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "/discount/del_disc",
            dataType: "json",
            data: {
                id: id
            },
            asynx:true,
            success: function(response) {
            }
        });
    });
    
    //DELIVERY CHECK
    $('.delivered').click(function () {
        var id = $(this).attr('data-id');
        var cb = $(this);
        $.ajax({
            type: "POST",
            url: "/cart/set_delivery_true",
            dataType: "json",
            data: {
                id: id
            },
            asynx:true,
            success: function(response) {
                if(response.res === true){
                    cb.attr('disabled', true);
                }
            }
        });
    });
});

function prependReminder(id, name, month, day) {
    var list = $('.reminder-list');
    list.prepend(
        '<article class="media event">' +
        '<a class="pull-left date">' +
        '<p class="month">'+ month +'</p>' +
        '<p class="day">' + day + '</p>' +
        '</a>' +
        '<div class="media-body">' +
        '<span class="remove-reminder" data-id="' + id + '">x</span>' +
        '<p>' + name + '</p>' +
        '</div>' +
        '</article>'
    );
}

function prependDiscount(id, name, month, day, code, type, disc){
    var list = $('.discount-list');
    var t = 0;
    if(type == 0){
        t = '%';
    } else {
        t = 'RSD'
    }
    list.prepend(
        '<article class="media event">' +
        '<a class="pull-left date">' +
        '<p class="month">'+ month +'</p>' +
        '<p class="day">' + day + '</p>' +
        '</a>' +
        '<div class="media-body">' +
        '<a class="title" href="javascript:void(0)">' + code + '</a>' +
        '<span class="rembtn remove-reminder" data-id="' + id + '">x</span>' +
        '<p>' + name + ' <span class="label label-warning">' + disc + ' ' + t + '</span></p>' +
        '</div>' +
        '</article>'
    );
}