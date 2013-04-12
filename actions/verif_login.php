<?php

session_start();
require_once('../include/config.php');
require_once '../include/constantes.inc.php';

if (!isset($_SESSION['mode']))
{
    $_SESSION['mode']='0';
}






if (1==1)//!isset($_SESSION['mode']))
{
    if (1==1)//isset($_POST['login']) && isset($_POST['password']))
    {
        
        
        mssql_connect($host, $username, $password);
        mssql_select_db($database);
        $sql = "SELECT * FROM affichePersonnel where login_pers='".$_POST['tbx_login']."' AND mdp_pers = '".$_POST['tbx_password']."'";
        //echo $sql; die();
        $result_query = mssql_query($sql);
        $login = mssql_fetch_array($result_query);
        if (mssql_num_rows($result_query)==1)
        {
            $_SESSION['mode']=$login['mode'];
            header('Location: '.RACINE_SITE.'liste_note.php');
        }else{
            header('Location: '.RACINE_SITE.'index.php');
        }
        
        
        print_r($login);
        mssql_close();


//        $sql = 'SELECT VIEW affichePersonnel where login_pers="$"';
//        $query = mysql_query($sql);
//        print_r($query);die();
//        if (mysql_num_rows($query)==1)
//        {
//            $_SESSION['login'] = $_POST['login'];
//            $_SESSION['password'] = $_POST['password'];
//            $_SESSION['mode']=$query['mode'];
//        }else{
//            header('Location: '.RACINE);
//        }
        
    }else{
        header('Location: '.RACINE_SITE.'index.php');
    }
}

?>
