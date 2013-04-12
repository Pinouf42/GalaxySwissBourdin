<?php
function mssql_real_escape_string($s) {
	if(get_magic_quotes_gpc()) {
		$s = stripslashes($s);
	}
	$s = str_replace("'","''",$s);
	return $s;
}

include_once('config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
$commentaire = mssql_real_escape_string($_GET['commentaire']);
$query = "UPDATE NOTE_FRAIS SET commentaire_note = '".$commentaire."' WHERE id_note = ".addslashes($_GET['id_note'])."";
mssql_query($query);
mssql_close();
echo $query;
?>
