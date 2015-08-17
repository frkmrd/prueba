<?php
class vstPrestamo
{

	public function __construct()
	{

	}
	public function __destruct()
	{

	}
	public function vista_nuevo_prestamo($prestamo)
	{
		$libro=$prestamo->get_combo_libro();
        $lector=$prestamo->get_combo_lector();
		$html="
		<div>
		<form name='reg_usuario' class='form-horizontal' action='crtPrestamo.php?pag=registrar_prestamo' method='POST'>
		<fieldset>
			<legend>Registrar Prestamo </legend>
			
			<div  class='form-group'>
			<label for='libro' class='col-sm-2 control-label'>Libro</label>
				<div  class='col-sm-10'>
					$libro 
				</div>
			</div>
			<div>
			<div  class='form-group'>
			<label for='lector' class='col-sm-2 control-label'>Lector</label>
				<div  class='col-sm-10'>
					$lector 
				</div>
			</div>
			<div>
			<br >
			<div class='col-sm-2'>
			</div>
				<div  class='col-sm-10'>
				<button type='submit' class='btn btn-primary btn-lg' aria-label='Left Align'>
                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                	Registrar Prestamo
                </button>
				</div>
			</div>
		</fieldset>	
		</form>
		</div>		
		";
		echo $html;
	}
    public function vista_modificar_usuario($usuario)
	{
		$id_usuario=$usuario->get_id_usuario();
		$ci=$usuario->get_ci();
		$nombre=$usuario->get_nombre();
        $ap_paterno=$usuario->get_ap_paterno();
        $ap_materno=$usuario->get_ap_materno();
        $celular=$usuario->get_celular();
        $fecha=$usuario->get_fecha_nac();
        $email=$usuario->get_email();
        $nacionalidad=$usuario->get_nacionalidad();
        $rol=$usuario->get_combo_rol();
		$html="
		<div>
		<form name='mod_usuario' action='crtUsuarios.php?pag=modificar_usuario' method='POST'>
		<fieldset>
			<legend>Modificar Usuario </legend>
			<div>
				<label for='C.I.'>CI</label>
				<input type='text' id='ci' name='ci' value='$ci'  required  placeholder='Ingrese C.I.' /> 
			</div>
			<div>
			<label for='Nombre'>Nombre</label>
			<input type='text' id='nombre' name='nombre' value='$nombre' required   placeholder='Ingrese Nombre' /> 
			</div>
			<div>
			<label for='ap_paterno'>Ap. Paterno</label>
			<input type='text' id='ap_paterno' name='ap_paterno' value='$ap_paterno'  required   placeholder='Ingrese Apellido Paterno' /> 
			</div>
			<div>
			<label for='ap_materno'>Ap. Materno</label>
			<input type='text' id='ap_materno' name='ap_materno' value='$ap_materno'  required   placeholder='Ingrese Apellido Materno' /> 
			</div>
			<div>
			<label for='celular'>Celular</label>
			<input type='text' id='celular' name='celular' value='$celular' required   placeholder='Ingrese Celular' /> 
			</div>
			<div>
			<label for='fecha_nac'>Fecha de nacimiento</label>
			<input type='text' id='fecha_nac' name='fecha_nac' value='$fecha'  required   placeholder='Ingrese fecha nacimiento' /> 
			</div>
			<div>
			<label for='Email'>Email</label>
			<input type='text' id='email' name='email' value='$email' required   placeholder='Ingrese Email' /> 
			</div>
			<div>
			<label for='nacionalidad'>Nacionalidad</label>
			<input type='text' id='nacionalidad' name='nacionalidad' value='$nacionalidad' required   placeholder='Ingrese nacionalidad' /> 
			</div>
			<div>
			<label for='rol'>Rol</label>
			$rol 
			</div>
			<div>
			<br >
			<input type='hidden' name='id_usuario' id='id_usuario' value='$id_usuario' />
			<input type='submit' name='Registrar_usuario' value='Modificar Usuario' />
			</div>
		</fieldset>	
		</form>
		</div>		
		";
		echo $html;
	}
	
}

?>