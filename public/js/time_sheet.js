$('.new_form_task').on('click', function () {
    $('.form_task:first').clone().appendTo('.time_sheet_detail');
});

$('.save_time_sheet').on('click', function (e) {
    e.preventDefault();
    $('.text-danger').each(function () {
        $(this).remove();
    });
    let check = true;
    if ($('input[name=work_day]').val().length <= 0) {
        $('input[name=work_day]').after("<div class='text-danger'>Trường này không được để trống</div>")
        check = false;
    }

    if ($('#difficult').val().length <= 0) {
        $('#difficult').after("<div class='text-danger'>Trường này không được để trống</div>")
        check = false;
    }

    if ($('#plan').val().length <= 0) {
        $('#plan').after("<div class='text-danger'>Trường này không được để trống</div>")
        check = false;
    }

    $('.task_contents').each(function () {
        if ($(this).val().length <= 0) {
            $(this).after("<div class='text-danger'>Trường này không được để trống</div>")
            check = false;
        }
    });

    $('.work_times').each(function () {
        if ($(this).val().length <= 0) {
            $(this).after("<div class='text-danger'>Trường này không được để trống</div>")
            check = false;
        } else if (!$.isNumeric($(this).val())) {
            $(this).after("<div class='text-danger'>Giá trị nhập vào phải là số </div>")
            check = false;
        }
    });

    if (check === true) {
        $('#time_sheet_create').submit();
    }
})
