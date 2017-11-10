$(document).ready(function () {
    //ajax requests

    var result = $('.output');

    $('.request').click(function () {
        $.ajax({
            type: "POST",
            url: "/ajaxdatabinding",
            dataType: "json",
            data: {
                'key1' : 'value1'
            },
            asynx:true,
            success: function(response) {
                result.text(response.data);
            }
        });
    });



});