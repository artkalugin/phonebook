<?php
	require_once('SafeMySQL.php');
	require_once('Contact.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/a0d786da80.js" crossorigin="anonymous"></script>
	<title>Телефонный справочник</title>
</head>
<body>
	<div class="container-md">
		<div class="row justify-content-center">
			<div class="col-12">
			<h1 class="mb-5 mt-5">Телефонный справочник — тестовое задание LUCKRU</h1>
			<table id="contact-list" class="table table-striped">
				<tr>
					<th>Имя</th>
					<th>Номер телефона</th>
					<th>Кем приходится</th>
					<th>Действия</th>
				</tr>
			<?php
				Contact::print_all();
			?>
			</table>

			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
			<i class="fas fa-user-plus"></i> Добавить контакт
			</button>

			<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title" id="addModalLabel">Добавить контакт</h2>
							<button type="button" id="addClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="form" id="addContactForm">
								<input type="text" name="name" id="nameField" class="form-control" placeholder="Введите имя" required maxlength="50">
								<div class="form-text">Обязательное поле</div><br>
								<input type="tel" name="phone" pattern="^((\+7|7|8)+([0-9]){10})$" id="phoneField" class="form-control" placeholder="Введите номер телефона" required>
								<div class="form-text">В формате +79121234567</div><br>
								<input type="text" name="role" id="roleField" class="form-control" placeholder="Кем приходится контакт?" maxlength="30"><br>
								<button type="submit" class="btn btn-success">Сохранить</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title" id="editModalLabel">Редактировать контакт</h2>
							<button type="button" id="editClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="form" id="editContactForm">
								<input type="text" name="name" id="editNameField" class="form-control" placeholder="Введите имя" required maxlength="50">
								<div class="form-text">Обязательное поле</div><br>
								<input type="tel" name="phone" pattern="^((\+7|7|8)+([0-9]){10})$" id="editPhoneField" class="form-control" placeholder="Введите номер телефона" required>
								<div class="form-text">В формате +79121234567</div><br>
								<input type="text" name="role" id="editRoleField" class="form-control" placeholder="Кем приходится контакт?" maxlength="30"><br>
								<input type="hidden" name="id" id="idField" value="">
								<button type="submit" class="btn btn-success">Сохранить</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	<script>
	$('#addContactForm').submit(function() {
		$.post(
		'handler.php',
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
		'handler.php',
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
		});;
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
			url: "delete.php",
			data: { id: id }
			})
  		.done(function(msg) {
			$('.contact-list__row[data-id=' + id + ']').remove();
  		})
		.fail(function(msg) {
    	alert('Ошибка удаления. Пожалуйста, обратитесь к администратору.');
		});;
	};
   	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	</body>
</html>