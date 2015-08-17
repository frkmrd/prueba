<?php
require_once('modelo\clsPrestamo.php');
require_once('vista\vstPrestamo.php');


function helper()
{
	$pag=helper_get_pagina();

	switch($pag)
	{
		case 'formulario_prestamo':
             $vista_prestamo = new vstPrestamo();
             $prestamo=new Prestamo();
             $vista_prestamo->vista_nuevo_prestamo($prestamo);  
		break;

		case 'registrar_prestamo':

		break;
	
		case 'lista_prestamo':
             $prestamo=new Prestamo();
             $prestamo->get_tabla();
		break;

	}
}
function helper_get_pagina()
{
	$pag=$_GET['pag'];
	return $pag;
}


	helper();


?>