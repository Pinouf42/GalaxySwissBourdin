<?
include('include/language.php');
include('include/menu.inc.php');
include('include/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <title><?php echo $lang['titre_page']; ?></title>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.animate-colors.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript"  src="js/Segoe_UI_400-Segoe_UI_700-Segoe_UI_italic_400.font.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/jquery.upload-1.0.2.js"></script>
        <script type="text/javascript" src="js/jquery-pinouf.js"></script>
        <script type="text/javascript" src="js/lang.js"></script>
        <script>
            Cufon.replace("div#step1");
            Cufon.replace("div#step2_0");
            Cufon.replace("div#step3_0");
            Cufon.replace("div#step2_1");
            Cufon.replace("div#step3_1");
            Cufon.replace("div#confirm_box");
            var g_Pays = false;
            var step = 1;
            var date_ok = false;
            var montant_ok = false;
            var upload_reussi = "<?php echo $lang['succes_envoi_justif']; ?>";
            var upload_erreur = "<?php echo $lang['erreur_envoi_justif']; ?>";
            var champs_non_remplis = "<?php echo $lang['champs_non_remplis']; ?>";
            function Accueil()
            {
                    $("#base").fadeIn(500);
            }
        </script>
    </head>
<body onload="Accueil()">
<div id="black" class="blackbackground"></div>
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
            <td width="146" valign="middle"><b>Luc Sinardet</b><br />
            <a href="#"><?php echo $lang['se_deconnecter']; ?></a></td>
        </tr>
        </table>
  </div>
</div>


<div id="contenu">
    <?php
        mssql_connect($host, $username, $password);
        mssql_select_db($database);
        $query = "SELECT * FROM NOTE_FRAIS WHERE clos_note = 0";
        $executed_query = mssql_query($query);
        while($result = mssql_fetch_array($executed_query))
        {
            $nb_Justif = 0;
            $montant_Total = 0;
            $query_justif = "SELECT * FROM JUSTIFICATIF WHERE id_note = ".$result['id_note'].""; 
            $execute_query_justif = mssql_query($query_justif);
            while($result_justif = mssql_fetch_array($execute_query_justif))
            {
                $nb_Justif++;
                $montant_Total += $result_justif['montant'];
            }
            echo "<a href=\"saisie_note.php?note=".$result[0]."\" onmouseover=\"showInfoNote('#info_note".$result[0]."', true);\" onmouseout=\"showInfoNote('#info_note".$result[0]."', false);\" class=\"button blue\">".$result[2]."</a>";
            echo "<div id=\"info_note".$result[0]."\" class=\"info_note\"><b>Nombre de justificatifs:</b> ".$nb_Justif." - <b>Montant total:</b> ".$montant_Total."€</div>";
            
        }
    ?>


    <a href="include/create_note.php" class="button green top">Créer une note</a>

 </div>
<!-- FIN CONTENT BASE -->
</body>
</html>