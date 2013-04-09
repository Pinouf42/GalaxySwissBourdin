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
</div>

<div id="contenu">
    <?php
        mssql_connect($host, $username, $password);
        mssql_select_db($database);
        $query = "SELECT * FROM NOTE_FRAIS WHERE clos_note = 0";
        $executed_query = mssql_query($query);
        while($result = mssql_fetch_array($executed_query))
        {
            echo "<a href=\"saisie_note.php?note=".$result[0]."\"><input type=\"button\" value=\"".$result[2]."\" onmouseover=\"showInfoNote('#info_note".$result[0]."', true);\" onmouseout=\"showInfoNote('#info_note".$result[0]."', false);\" class=\"btn_submit\"/></a><br>";
            echo "<div id=\"info_note".$result[0]."\" class=\"info_note\"><b>Nombre de justificatifs:</b> 13 - <b>Montant total:</b> 465,64€</div>";
            
        }
    ?>
<!--<input type="button" value="Editer/Cloturer la note QQ+ noob" onmouseover="showInfoNote('#info_note1', true);" onmouseout="showInfoNote('#info_note1', false);" class="btn_submit"/><br>
<div id="info_note1" class="info_note"><b>Nombre de notes:</b> 13 - <b>Montant total:</b> 465,64€</div>
<input type="button" value="Editer/Cloturer la note get a cancer and go die" onmouseover="showInfoNote('#info_note2', true);" onmouseout="showInfoNote('#info_note2', false);" class="btn_submit"/><br>
<div id="info_note2" class="info_note"><b>Nombre de notes:</b> 2 - <b>Montant total:</b> 120,74€</div>
<input type="button" value="Editer/Cloturer la note morron" onmouseover="showInfoNote('#info_note3', true);" onmouseout="showInfoNote('#info_note3', false);" class="btn_submit"/><br>
<div id="info_note3" class="info_note"><b>Nombre de notes:</b> 5 - <b>Montant total:</b> 24,65€</div>
<input type="button" value="Editer/Cloturer la note U kidding me?!" onmouseover="showInfoNote('#info_note4', true);" onmouseout="showInfoNote('#info_note4', false);" class="btn_submit"/><br>
<div id="info_note4" class="info_note"><b>Nombre de notes:</b> 0 - <b>Montant total:</b> 0€</div>-->


<a href="include/create_note.php"><input type="button" value="Créer une note" class="btn_submit"/></a><br>

 </div>
<!-- FIN CONTENT BASE -->
</body>
</html>