<?php/* Conexion, seleccion de base de datos */include "configuracion.php"; $enlace = mysql_connect($dbserver, $dbuser, $dbpwd)    or die("No pudo conectarse : " . mysql_error());mysql_select_db($dbname) or die("No pudo seleccionarse la BD.");$fecha = getdate();
$fechacompleta = $fecha{'year'} . "-";

if ($fecha{'mon'} < 10) {
	$fechacompleta .= "0" . $fecha{'mon'};
} else {
	$fechacompleta .= $fecha{'mon'};
}
$fechacompleta .= "-";
if ($fecha{'mday'} < 10) {
	$fechacompleta .= "0" . $fecha{'mday'};
} else {
	$fechacompleta .= $fecha{'mday'};
}
/* Recupera los datos de activdonador_id */$activdonador_id = $_REQUEST['activdonador_id'];if ($activdonador_id == "") {	$activdonador_id = "0";}$proveedor_id = $_REQUEST['proveedor_id'];if ($proveedor_id == "") {	$proveedor_id = "0";}$activdonador_fecha = $_REQUEST['activdonador_fecha'];if ($activdonador_fecha == "") {	$activdonador_fecha = $fechacompleta;}$contactobred = $_REQUEST['activdonador_contactobreddf'];$activdonador_contactobreddf = ",";$x = 0;while ($contactobred{$x} != "") {	$activdonador_contactobreddf .= $contactobred{$x} . ",";	$x++;}$activdonador_sitioref = $_REQUEST['activdonador_sitioref'];$activdonador_tipo = $_REQUEST['activdonador_tipo'];$activdonador_contacto = $_REQUEST['activdonador_contacto'];$activdonador_comentarios = $_REQUEST['activdonador_comentarios'];$activdonador_responsable = $_REQUEST['activdonador_responsable'];$activdonador_fechacumplimiento = $_REQUEST['activdonador_fechacumplimiento'];if ($activdonador_fechacumplimiento == "") {	$activdonador_fechacumplimiento = $fechacompleta;}$consulta  = "INSERT INTO breddf_activdonador (proveedor_id, activdonador_fecha, activdonador_contactobreddf";$consulta  .= ", activdonador_sitioref, activdonador_tipo, activdonador_contacto, activdonador_comentarios";$consulta  .= ", activdonador_responsable, activdonador_fechacumplimiento) VALUES (";$consulta  .= $proveedor_id;
$consulta  .= ", '" . $activdonador_fecha . "'";
$consulta  .= ", '" . $activdonador_contactobreddf . "'";
$consulta  .= ", '" . $activdonador_sitioref . "'";
$consulta  .= ", '" . $activdonador_tipo . "'";
$consulta  .= ", '" . $activdonador_contacto . "'";
$consulta  .= ", '" . $activdonador_comentarios . "'";
$consulta  .= ", '" . $activdonador_responsable . "'";
$consulta  .= ", '" . $activdonador_fechacumplimiento . "'";
$consulta .= ")";//echo $consulta;//exit;$resultado = mysql_query($consulta) or die("La consulta fall&oacute;: " . mysql_error());/* Liberar conjunto de resultados */mysql_free_result($resultado);if ($activdonador_id == "0") {	$consultaID = "SELECT activdonador_id FROM breddf_activdonador ORDER BY activdonador_id DESC LIMIT 1";	$resultadoID = mysql_query($consultaID) or die("La consulta fall&oacute;: " . mysql_error());	while ($lineaID = mysql_fetch_assoc($resultadoID)) {
		$activdonador_id = $lineaID['activdonador_id'];	}	mysql_free_result($resultadoID);}/* Cerrar la conexion */mysql_close($enlace);/* Si el registro fue correcta, redirige al home ya con los permisos asignados */$destino = "Location: ./donadoresmodifica.php?proveedor_id=$proveedor_id";header($destino); /* Redirigir al navegador */?>