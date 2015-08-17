<?php
require_once('DBAbstract.php');
class Usuarios extends DBAbstract
{
	private $id_usuario;
	private $ci;
	private $nombre;
	private $ap_paterno;
	private $ap_materno;
	private $celular;
	private $fecha_nac;
	private $email;
	private $nacionalidad;
	private $id_rol;

	
	public function __construct($ci='',$nombre='',$ap_paterno='',$ap_materno='',$celular='',$fecha_nac='',$email='',$nacionalidad='',$id_rol='')
	{
		$this->ci=$ci;
		$this->nombre=$nombre;
		$this->ap_paterno=$ap_paterno;
		$this->ap_materno=$ap_materno;
		$this->celular=$celular;
		$this->fecha=$fecha_nac;
		$this->email=$email;
		$this->nacionalidad=$nacionalidad;
		$this->id_rol=$id_rol;
	}
	public function __destruct()
	{

	}

    public function get_by_id($id='') {
		if($id != ''):
		$this->query = "select id_isuario
								,ci
								,nombre
								,ap_paterno
								,ap_materno
								,celular
								,fecha_nac
								,email
								,nacionalidad
								,id_rol
						from Usuarios
						where id_usuario='$id'
	";
		$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
		foreach ($this->rows[0] as $propiedad=>$valor):
		$this->$propiedad = $valor;
		endforeach;
		endif;
	}
	public function get_by_ci($ci='') {
		if($ci != ''):
		$this->query = "select id_usuario
								,ci
								,nombre
								,ap_paterno
								,ap_materno
								,celular
								,fecha_nac
								,email
								,nacionalidad
								,id_rol
						from Usuarios
						where ci='$ci'
	";
		$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
		foreach ($this->rows[0] as $propiedad=>$valor):
		$this->$propiedad = $valor;
		endforeach;
		endif;
	}
    public function get_by_nombre_ci($nombre='',$ci='') {
		if($ci != ''&& $nombre!=''):
		$this->query = "select id_usuario
								,ci
								,nombre
								,ap_paterno
								,ap_materno
								,celular
								,fecha_nac
								,email
								,nacionalidad
								,id_rol
						from Usuarios
						where ci='$ci' and nombre='$nombre'
	";
		$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
		foreach ($this->rows[0] as $propiedad=>$valor):
		$this->$propiedad = $valor;
		endforeach;
		endif;
	}

	public function get_id_usuario()
	{
		return $this->id_usuario;
	}

	public function set_id_usuario($id_usuario)
	{
		$this->id_usuario=$id_usuario;
	}
    public function get_ci()
    {
    	return $this->ci;
    } 
	public function get_nombre()
	{
		return $this->nombre;
	}
	public function get_ap_paterno()
	{
		return $this->ap_paterno;
	}
	public function get_ap_materno()
	{
		return $this->ap_materno;
	}
	public function get_celular()
	{
		return $this->celular;
	}
	public function get_fecha_nac()
	{
		return $this->fecha_nac;
	}
	public function get_email()
	{
		return $this->email;
	}
	public function get_nacionalidad()
	{
		return $this->nacionalidad;
	}
	public function get_id_rol()
	{
		return $this->id_rol;
	}
	public function insert()
	{
		$this->query="insert into usuarios(
				ci,nombre,ap_paterno,ap_materno,celular,fecha_nac,email,nacionalidad,id_rol)
				values(
					'$this->ci','$this->nombre','$this->ap_paterno','$this->ap_materno','$this->celular','$this->fecha_nac','$this->email','$this->nacionalidad','$this->id_rol'
					)
        ";
        $this->execute_single_query();
	}
	public function update()
	{
		$this->query="update usuarios set
				ci='$this->ci',nombre='$this->nombre',ap_paterno='$this->ap_paterno',ap_materno='$this->ap_materno',celular='$this->celular',fecha_nac='$this->fecha_nac',email='$this->email',nacionalidad='$this->nacionalidad',id_rol='$this->id_rol' 
				where id_usuario='$this->id_usuario'
					
         ";
        $this->execute_single_query();
	}
	public function delete()
	{
		$this->query="delete from usuarios
						where id_usuario='$this->id_usuario'";
     $this->execute_single_query();
	}
	public function get_tabla()
	{
		$html=" 
		        <h1>Administrador de Usuarios</h1>
		        <a href='crtUsuarios.php?pag=formulario_usuario' class='btn btn-primary' > <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Crear Usuario</a>
		        <br />
		        <br />
		        <table class='table  table-striped'>
				<tr>
				<th>ID</th>
				<th>CI</th>
                <th>NOMBRE</th>
                <th>AP PATERNO</th>
                <th>AP MATERNO</th>
                <th>ROL</th>
                <th><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></th>
                <th><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></th>
                </tr>
				";
		$sql="SELECT u.id_usuario
					,u.ci
					,u.nombre
					,u.ap_paterno
					,u.ap_materno
					,r.nombre_rol 
				    FROM usuarios u
				    INNER JOIN rol r ON (u.id_rol=r.id_rol)";
		$result=$this->get_results_from_query2($sql);
        while ($filas = $result->fetch_assoc())
        {
        	$ci=$filas['ci'];
        	$nombre=$filas['nombre'];
        	$ap_paterno=$filas['ap_paterno'];
        	$ap_materno=$filas['ap_materno'];
        	$id_usuario=$filas['id_usuario'];
        	$rol=$filas['nombre_rol'];
        	$html=$html."<tr>
        	              <td>$id_usuario</td>
	        	          <td>$ci</td>
	        	          <td>$nombre</td>
	        	          <td>$ap_paterno</td>
	        	          <td>$ap_materno</td>
	        	          <td>$rol</td>
	        	          <td><a href='crtUsuarios.php?pag=formulario_modificar_usuario&id=$ci' ><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>
	        	          <td><a href='crtUsuarios.php?pag=formulario_eliminar_usuario&id=$ci' ><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>
	        	          </tr>";
        }
        $html=$html."</table>";

        echo $html;
	}
	public function get_combo_rol()
	{
		$sql="SELECT id_rol
					,nombre_rol
			  FROM rol
              ORDER BY nombre_rol ASC;";

		return $this->get_combo_box($sql,'nombre_rol','id_rol','rol',$this->id_rol);
	} 
}
?>