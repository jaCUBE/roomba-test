$(function () {
    $('.examples .btn').click(function () {
        var content = $(this).find('.content').html();
        $('.input').val(content);
        run();
    });
})


function run() {
    $.ajax({
        type: 'POST',
        url: 'cleaning_robot.php',
        data: {
            'data': $('.input').val()
        },
        success: function (data, textStatus, xhr) {
            $('.output').val(data);
        }
    });
}