$(document).ready(function () {
    $('#menu_toggle').click(function () {
        if($('.navnavbar').hasClass('hidethis')){
            $('.navnavbar').removeClass('hidethis');
        } else {
            $('.navnavbar').addClass('hidethis');
        }
    })

    $('.form-control').parent().addClass('col-md-12 col-xs-12');

    $('.parent-half').parent().addClass('col-md-6 col-xs-12');
    $('.parent-third').parent().addClass('col-md-4 col-xs-6');
    $('.parent-quoter').parent().addClass('col-md-3 col-xs-4');

    //preview files

    //upload btns
    $('.results-preview').parent().append("<br/><center><button class='btn btn-success btn-large upload'>Izaberi fotografije</button></center><br/>");
    $('.results-preview-eq').parent().append("<br/><center><button class='btn btn-success btn-large upload'>Izaberi fotografije</button></center><br/>");

    //fake click
    $('.upload').click(function () {$('.results-preview').click();})
    $('.upload').click(function () {$('.results-preview-eq').click();})

    //preview list
    $('.results-preview').change(function () {
        if($(this).get(0).files.length < 8){
            $('.preview-box').remove();
            $('.results-preview').parent().append(
                "<div class='preview-box'><p><strong>Izabrane fotografije:</strong></p><br/></div>"
            );
            for(var i = 0; i < $(this).get(0).files.length; ++i ){
                $('.preview-box').append('<p><i class="fa fa-image"></i> ' + $(this).get(0).files[i].name +'</p>')
            }
        } else {
            $('.danger').click();
            $('#danger-msg').text('Dozvoljeno je ukupno 8 slika!');

            $('.preview-box').remove();
            $('.results-preview').val('');
        }
    })

    $('.results-preview-eq').change(function () {
        if($(this).get(0).files.length < 8){
            $('.preview-box').remove();
            $('.results-preview-eq').parent().append(
                "<div class='preview-box'><p><strong>Izabrane fotografije:</strong></p><br/></div>"
            );
            for(var i = 0; i < $(this).get(0).files.length; ++i ){
                $('.preview-box').append('<p><i class="fa fa-image"></i> ' + $(this).get(0).files[i].name +'</p>')
            }
        } else {
            $('.danger').click();
            $('#danger-msg').text('Dozvoljeno je ukupno 4 slike!');
            $('.preview-box').remove();
            $('.results-preview-eq').val('');
        }
    })

    $('.phone_tag').click(function () {
        if($(this).hasClass('choosed_tag')){
            $(this).removeClass('choosed_tag');
            var str = $('.add-tags').val();
            str = str.replace($(this).text(), '');

            $('.add-tags').val(str);

        } else {
            $(this).addClass('choosed_tag');
            $('.add-tags').val($('.add-tags').val() + " " + $(this).text());
        }
    })

    $('.pass-to-form').change(function () {
        $('.hiden-mark').val($(this).val());
    })
    $('.pass-to-form-kit').change(function () {
        $('.category-int').val($(this).val());
    })


    $('.previewBig').click(function () {
        $(this).addClass('bigImg');
        $(this).append('<span class="big-img-close"><i class="fa fa-close"></i></span>');
        $('.background-shadow').show();
    });
    $('.background-shadow').click(function () {
        $('.previewBig').removeClass('bigImg');
        $(this).hide();
    })

    $('.open-tagmodal').click(function () {
        $('#tagmodal').show();
    });
});