$('#addContactForm').submit(function() {
    $.post(
    'write.php',
    $('#addContactForm').serialize(),		
    function(msg) {
        $('#contact-list').append(msg);
        $('#addClose').click();
        $('#addContactForm').trigger('reset');
    }
    )
    .fail(function(msg) {
        alert('Ошибка записи. Пожалуйста, обратитесь к администратору.');
    });
    return false;
});

$('#editContactForm').submit(function() {
    $.post(
    'write.php',
    $('#editContactForm').serialize(),		
    function(msg) {
        id = $('#idField').val();
        $('.contact-list__row[data-id="' + id + '"]').replaceWith(msg);
        $('#editClose').click();
        $('#editContactForm').trigger('reset');
    }
    )
    .fail(function(msg) {
        alert('Ошибка записи. Пожалуйста, обратитесь к администратору.');
    });
    return false;
});

function fill_form(id) {
    $('#editNameField').val($('.contact-list__row[data-id="' + id + '"] .contact-list__name').html());
    $('#editPhoneField').val($('.contact-list__row[data-id="' + id + '"] .contact-list__phone').html());
    $('#editRoleField').val($('.contact-list__row[data-id="' + id + '"] .contact-list__role').html());
    $('#idField').val(id);
}

function remove_row(id) {
    $.ajax({
        method: "POST",
        url: 'delete.php',
        data: { id: id }
        })
    .done(function(msg) {
        $('.contact-list__row[data-id=' + id + ']').remove();
      })
    .fail(function(msg) {
        alert('Ошибка удаления. Пожалуйста, обратитесь к администратору.');
    });
};