$(function () {
    $('.examples .btn').click(function () {
        var content = $(this).find('.content').html();
        $('.input').val(content);
        run();
    });

    $('.examples .btn:first').click();
})


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