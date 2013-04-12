<?php
include_once('config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
mssql_query("UPDATE NOTE_FRAIS SET commentaire_note = '".stripslashes($_GET['commentaire'])."' WHERE id_note = ".stripslashes($_GET['id_note'])."");
mssql_close();
?>
