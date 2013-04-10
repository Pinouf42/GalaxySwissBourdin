<?php
include 'include/language.php';
include 'include/menu.inc.php';
include 'include/config.php';
session_start();
$_SESSION['mode']=4;
$_SESSION['id_pers']=4;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/historique.css">
            <link rel="stylesheet" href="css/style.css">
                <title>GSB - Gestion Frais Deplacement</title>
                <script src="js/jquery.min.js"></script>
                <script src="js/jquery.min.js"></script>
                <script type="text/javascript" src="js/cufon-yui.js"></script>
                <script type="text/javascript"  src="js/Segoe_UI_400-Segoe_UI_700-Segoe_UI_italic_400.font.js"></script>
                <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
                <script>
                
                    var g_Pays = false;
                    function Accueil()
                    {
                        $("#base").fadeIn(500);
                    }

                    function Pays()
                    {
                        if(g_Pays == false)
                        {
                            $("#cliqueur").animate({marginTop:'10px'}, 500);
                            $("#bandeau_pays").animate({height:'83px'}, 500, function()
                            {
                                $(".france").fadeIn(500);
                                $(".usa").fadeIn(500);
                                g_Pays = true;
                            });
                        }
                        else
                        {
                            if(g_Pays == true)
                            {
                                $(".france").fadeOut(500);
                                $(".usa").fadeOut(500, function()
                                {
                                    $("#cliqueur").animate({marginTop:'-10px'}, 500);
                                    $("#bandeau_pays").animate({height:'40px'}, 500);
                                    g_Pays = false;
                                });
                            }
                        }
                    }
                    
                    function find(){                        
                            if(-10<document.getElementById("date_picker").offsetLeft)
                            {
                                $("#date_picker").animate(
                                {"left": "-=150px"},
                                "slow");                                
                            }
                            else
                            {
                                $("#date_picker").animate(
                                {"left": "+=150px"},
                                "slow");
                            }
       
                        }                    
                </script>                
                </head>

                <body onload="Accueil()">
                    <div id="selection_pays">
                        <div id="bandeau_pays"></div>
                        <div id="menu_2_items">
                        <?php
                        
                        $count = count($menu);
                        for($i = 0; $i < $count; $i++)
                        {
                            $item = explode("|", $menu[$i]);
                            echo '<a href="'.$item[1].'"><div id="menu_item">'.$item[0].'</div></a>';
                        }
                        ?>
                        </div>
                        <div id="logged">
                            <table width="250" border="0">
                                <tr>
                                    <td width="40" height="40" align="center" valign="middle"><img src="images/user.png" /></td>
                                    <td width="146" valign="middle"><b>Luc Sinardet</b><br /><a href="#">Se deconnecter</a></td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                    
                   <!--<table id="date_picker">
                        <tr>
                            <td>
                                <div id="date_debut">Date début :<br>
                                        <input type="date"/>
                                </div>
                            </td>
                            <td width="5px" rowspan="2" id="find" onclick="find()"<><div display="inline" class="vertical">Rechercher</div></td>
                        </tr>
                        <tr>
                            <td>
                                <div id="date_fin">Date fin :<br>
                                        <input type="date"/>
                                </div>
                            </td>                                
                        </tr>
                    </table> -->
                    <div id="content">
                        <div id="tab_historique">
                            <table><caption></caption><thead>
                                    <tr><th scope="col"><input type='text'></input></th><th scope="col"><input type='text'></input></th><th scope="col"><input type='text'></input></th><th scope="col"><input type='text'></input></th></tr>
                                    <tr><th scope="col">N°</th><th scope="col">Date validation</th><th scope="col">Etat</th><th scope="col">Commentaire</th></tr>
                                    </thead>
                                    <tfoot><tr><th scope="row">G-S-B</th><td colspan="2"></td><th scope="row">retour</th></tr></tfoot><tbody>
                                    
                                    
                                    
                                    
                                    <?php
                                   
                                        mssql_connect($host, $username, $password);
                                        mssql_select_db($database);
//                                        $sql = "SELECT COLUMN_NAME
//                                                    FROM INFORMATION_SCHEMA.COLUMNS
//                                                    WHERE TABLE_NAME='note_frais'";
//                                        $result_query = mssql_query($sql);
//                                        while ($data = mssql_fetch_array($result_query)) { 
//                                        print_r($data);}die();
                                        
                                        // 1: visiteur
                                        // 2: delegué
                                        // 3: responsable
                                        // 4: admin
                                        
                                        
                                        switch ($_SESSION['mode'])
                                        {
                                            case '1': $sql = "select * from validation v, note_frais nf
                                                            where v.id_note = nf.id_note
                                                            and v.id_pers = ".$_SESSION['id_pers'];
                                                break;
                                            case '2': ;
                                                break;
                                            case '3': ;
                                                break;
                                            case '4':$sql = "select * from validation v, note_frais nf
                                                            where v.id_note = nf.id_note";
                                                break;
                                            default : echo 'erreur';
                                                break;
                                        }
                                        
//                                        $sql = "INSERT INTO validation
//                                            values('38','kjdfshglukhlh','4','1','09/04/2013')";
                                        
                                        $result_query = mssql_query($sql);
                                        
                                        while ($data = mssql_fetch_array($result_query)) { 
                                            // on affiche les résultats
                                            print_r($data);
                                            if ($data['etat_validation'] == 0)
                                                $etat_valid = "Rejeté";
                                            else
                                                $etat_valid = "Validé";
                                            
                                            echo '<tr class="tr_historique">
                                                <td>'.$data['id_note'].'</td>
                                                
                                                <td>'.$data['date_validation'].'</td>
                                                
                                                <td class=\'etat_valid'.$data['etat_validation'].'\'>'.$etat_valid.'</td>
                                                <td>'.$data['commentaire_validation'].'</td></tr>';
                                            
                                        }  
                                        mssql_close();
                                    ?>

                                    
                            </table>
                        </div>
                    </div>
                </body>
                </html>
