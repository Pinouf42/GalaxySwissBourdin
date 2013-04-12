<?php
include_once('config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
mssql_query("UPDATE NOTE_FRAIS SET clos_note = 1 WHERE id_note = ".addslashes($_GET['note'])."");
mssql_close();
header('Location: ../liste_note.php');
?>
