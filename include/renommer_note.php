<?php
include_once('config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
$commentaire = $_GET['commentaire'];
$query = "UPDATE NOTE_FRAIS SET commentaire_note = '".base64_encode($commentaire)."' WHERE id_note = ".addslashes($_GET['id_note'])."";
mssql_query($query);
mssql_close();
echo $query;
?>
