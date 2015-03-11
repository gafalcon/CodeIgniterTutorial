<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Title</title>
    </head>
    <body>
	<div class="list-errors">
	<?php echo validation_errors(); ?>
	</div>

	<?php echo form_open('form'); ?>
	<h5>Nombre de Usuario</h5>
	<input name="username" type="text" value="<?php echo set_value('username'); ?>" size="50"/>
	<?php echo form_error('username'); ?>
	<h5>Contraseña</h5>
	<input name="password" type="password" value="<?php echo set_value('password'); ?>" size="50"/>
	<?php echo form_error('password'); ?>

	<h5>Confirma contraseña</h5>
	<input name="passconf" type="password" value="<?php echo set_value('passconf'); ?>" size="50"/>

	<h5>Correo electronico</h5>
	<input name="email" type="text" value="<?php echo set_value('email'); ?>" size="50"/>

	<div><input type="submit" value="Submit"/></div>

    </form>
    </body>
</html>
