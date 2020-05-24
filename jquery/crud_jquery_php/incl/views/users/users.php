<?php include '../../model/ManageData.php'; ?>
<?php
		$cabecera = array('id',
						  'User',
						  'mail',
						  'fecha de creacion',
		);
		$campos = 	array('id',
						  'user',
						  'user_email',
						  'user_create'
  );
		$tabla_vista_condicion = "users";
		$botones =
			"
			<button class='btn btn-primary' title='Editar' onclick='page_div_x_id(row, \"incl/views/users/user_edit.php\", \"#div_main\");'\"><i class='icon-doc-text'></i><span class='glyphicon glyphicon-pencil'> </span></button>
			<button class='btn btn-success' title='Reestablecer Contraseña' onclick='showSwal();'\"><span class='glyphicon glyphicon-envelope'></span>Hola</button>
			<button class='btn btn-success' title='Reestablecer Contraseña' onclick='page_div_x_id(row, \"incl/gui/form_enviar_password_mail_x_paciente_id.php\", \"#enviar_password_paciente_id\");'\"><span class='glyphicon glyphicon-envelope'></span>Hola</button>
			<button class='btn btn-warning' title='eliminar' onclick='pacientes_eliminar_x_id(row);'\"><span class='glyphicon glyphicon-trash'></span></button>";
		$class_ManageData->tablaSql($cabecera,$campos,$tabla_vista_condicion,$botones);
?>
