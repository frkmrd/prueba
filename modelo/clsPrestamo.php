<?php
require_once('DBAbstract.php');
class Prestamo extends DBAbstract
{
	private $id_prestamo;
	private $id_libro;
	private $id_lector;
	private $fecha;

	
	public function __construct($id_prestamo='',$id_libro='',$id_lector='',$fecha='')
	{
		$this->id_prestamo=$id_prestamo;
		$this->id_libro=$id_libro;
		$this->id_lector=$id_lector;
		$this->fecha=$fecha;
	}
	public function __destruct()
	{

	}

    public function get_by_id($id='') {
		if($id != ''):
		$this->query = "select id_prestamo
								,id_libro
								,id_lector
								,fecha
						from prestamo
						where id_prestamo='$id'
	";
		$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
		foreach ($this->rows[0] as $propiedad=>$valor):
		$this->$propiedad = $valor;
		endforeach;
		endif;
	}
	
    

	public function get_id_prestamo()
	{
		return $this->id_prestamo;
	}

	public function set_id_prestamo($id_prestamo)
	{
		$this->id_prestamo=$id_prestamo;
	}
    public function get_id_libro()
    {
    	return $this->id_libro;
    } 
	public function get_fecha()
	{
		return $this->fecha;
	}
	
	public function insert()
	{
		$this->query="insert into prestamo(
				id_libro,id_lector,fecha)
				values(
					'$this->id_libro','$this->id_lector',now()
					)
        ";
        $this->execute_single_query();
	}
	public function update()
	{
		$this->query="update prestamo set
				id_libro='$this->id_libro',id_lector='$this->id_lector',fecha=now() 
				where id_prestamo='$this->id_prestamo'
					
         ";
        $this->execute_single_query();
	}
	
	public function get_tabla()
	{
		$html=" 
		        <h1>Administrador de Prestamos</h1>
		        <a href='crtPrestamo.php?pag=formulario_prestamo' class='btn btn-primary' > <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Crear Prestamo</a>
		        <br />
		        <br />
		        <table class='table  table-striped'>
				<tr>
				<th>ID</th>
				<th>libro</th>
                <th>lector</th>
                <th>fecha</th>
                <th><span class='glyphicon glyphicon-edit' aria-hidden='true'>Modificar</span></th>
                </tr>
				";
		$sql="SELECT p.id_prestamo id,l.titulo titulo,le.nombre nombre,p.fecha fecha FROM prestamo p
					INNER JOIN libro l ON p.id_libro=l.id_libro
					INNER JOIN lector le ON p.id_lector=le.id_lector;";
		$result=$this->get_results_from_query2($sql);
        while ($filas = $result->fetch_array())
        {
        	$id_prestamo=$filas['id'];
        	$titulo=$filas['titulo'];
        	$nombre=$filas['nombre'];
        	$fecha=$filas['fecha'];
        	$html=$html."<tr>
        	              <td>$id_prestamo</td>
	        	          <td>$titulo</td>
	        	          <td>$nombre</td>
	        	          <td>$fecha</td>
	        	          <td><a href='crtUsuarios.php?pag=formulario_modificar_usuario&id=$id_prestamo' ><span class='glyphicon glyphicon-edit' aria-hidden='true'>Modificar</span></a></td>
	        	          </tr>";
        }
        $html=$html."</table>";

        echo $html;
	}
	public function get_combo_libro()
	{
		$sql="SELECT id_libro, titulo FROM libro;";

		return $this->get_combo_box_all($sql,'titulo','id_libro','libro');
	} 
	public function get_combo_lector()
	{
		$sql="SELECT 
		 id_lector, CONCAT( nombre,' ',  ap_paterno) AS nombre 
		 FROM lector;";
		return $this->get_combo_box_all($sql,'nombre','id_lector','lector');
	} 
}
?>