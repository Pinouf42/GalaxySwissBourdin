<?php
include_once('include/config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
mssql_query("INSERT INTO NOTE_FRAIS(datesoumission_note, commentaire_note, id_pers, clos_note) VALUES (getDate(), 'Note du '+CONVERT(CHAR(10),  GETDATE(), 120), '1', '0')");
$query_id_note = "SELECT MAX(id_note) FROM NOTE_FRAIS";
$result_query = mssql_query($query_id_note);
$res = mssql_fetch_array($result_query);
mssql_close();
//header('Location: saisie_note.php?note='.$res[0]);
?>
