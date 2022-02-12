$('.checkbox_parent').on('click', function () {
    $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
});
