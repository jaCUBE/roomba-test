$(function () {
    $('.examples .btn').click(function () {
        var content = $(this).find('.content').html();
        $('.input').val(content);
        run();
    });

    $('.examples .btn:first').click();


    $('.map input').on('keyup', api_map_color).trigger('keyup');
    $('.start input').on('keyup', api_map_start).trigger('keyup');

    switch_tab();
});


function run() {
    $.ajax({
        type: 'POST',
        url: 'cleaning_robot.php',
        data: {
            'input': $('.input').val()
        },
        success: function (data, textStatus, xhr) {
            $('.output').val(data);
        }
    });
}


function api() {
    $.ajax({
        type: 'POST',
        url: 'cleaning_robot.php',
        data: $('.api').serialize(),
        success: function (data, textStatus, xhr) {
            $('.output-api').val(data);
        }
    });
}


function api_map_color() {
    if ($(this).val() == 'S') {
        $(this).css({'background': '#c0f9d6'});
    } else {
        $(this).css({'background': '#f9e6c0'});
    }
}


function api_map_start() {
    var x = parseInt($('input[name="start[X]"]').val());
    var y = parseInt($('input[name="start[Y]"]').val());

    var row = $('.map tr').eq(y);
    var col = row.find('td').eq(x);
    var input = col.find('input');

    $('.map input').trigger('keyup');
    input.css({'background': '#db72ff'});
}


function switch_tab() {
    var hash = window.location.hash;
    var tab = $('.nav-link[href="' + hash + '"]');
    tab.click();
}