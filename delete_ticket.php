<?php
include_once('include/config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
mssql_query("DELETE FROM JUSTIFICATIF WHERE id_justif = '".stripslashes($_POST['justif'])."'");
mssql_close();
?>
