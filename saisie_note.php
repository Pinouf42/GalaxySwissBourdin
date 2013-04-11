<?
include('include/language.php');
include('include/menu.inc.php');
include('include/config.php');
mssql_connect($host, $username, $password);
mssql_select_db($database);
if(isset($_GET['note']))
{
    $id_note = stripslashes($_GET['note']);
    $query = "SELECT COUNT(id_note) as Clos FROM NOTE_FRAIS WHERE id_note = ".$id_note." AND clos_note = 0";
    $execute_query = mssql_query($query);
    $result = mssql_fetch_array($execute_query);
    if($result['Clos'] == "0")
    {
        header('Location: liste_note.php');
    }
}
else
{
   header('Location: liste_note.php');
}

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
        $("#base_loading").fadeOut(500, function()
        {
            $("#base").fadeIn(500);
        });
	
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

<div id="confirm_box">
    <div id="confirm_box_header"><?php echo $lang['attention']; ?></div>
    <br />
    <?php echo $lang['attention_texte1']; ?><br />
    <br />
    <?php echo $lang['attention_texte2']; ?><br />
    <br />
    <img src="images/btn_oui.png" onclick="confirm_box(true);"/><img src="images/btn_non.png" onclick="confirm_box(false);" /></div>
<br/><center><a href="include/cloturer_note.php?note=<?php echo $id_note; ?>"><input type="button" class="btn_submit" value="CLOTURER CETTE NOTE"/></a></center>  
<div id="lightbox_bg" onclick="close_add_ticket();"></div>
  <div id="lightbox_body">
      <div id="step1_1" class="step1_1"></div><div id="step2_0" class="step2_0"></div><div id="step2_1" class="step2_1"></div><div id="step3_0" class="step3_0"></div><div id="step3_1" class="step3_1"></div>
      <form method="post" id="saisie_justif" action="#">
    <div id="total_ticket">
      <div id="content_step1" style="display:true">
        <div id="photo"><img src="images/photo.png" /><br />
          <br />
          <input type="file" id="tbx_send" name="tbx_send" size="60" />
          <br />
          <br />
          <input type="button" value="<?php echo $lang['envoyer_ticket']; ?>" class="btn_submit" onclick="perform_step()" />
        </div>
      </div>
      <!-- FIN CONTENT STEP 1-->
      <div id="content_step2">
      <div id="type_depense_suggestions">
        <div id="dpi_Essence" class="depense_item" onclick="type_item_selected('<?php echo $lang['essence']; ?>')"><img src="images/essence.png" width="16" height="16" />
          <p><?php echo $lang['essence']; ?></p>
        </div>
        <div id="dpi_Restaurant" class="depense_item" onclick="type_item_selected('<?php echo $lang['restaurant']; ?>')"><img src="images/restaurant.png" width="16" height="16" />
          <p><?php echo $lang['restaurant']; ?></p>
        </div>
        <div id="dpi_Hotel" class="depense_item" onclick="type_item_selected('<?php echo $lang['hotel']; ?>')"><img src="images/hotel.png" width="16" height="16" />
          <p><?php echo $lang['hotel']; ?></p>
        </div>
        <div id="dpi_Taxi" class="depense_item" onclick="type_item_selected('<?php echo $lang['taxi']; ?>')"><img src="images/taxi.png" width="16" height="16" />
          <p><?php echo $lang['taxi']; ?></p>
        </div>
        <div id="dpi_Avion" class="depense_item" onclick="type_item_selected('<?php echo $lang['avion']; ?>')"><img src="images/avion.png" width="16" height="16" />
          <p><?php echo $lang['avion']; ?></p>
        </div>
        <div id="dpi_Bateau" class="depense_item" onclick="type_item_selected('<?php echo $lang['bateau']; ?>')"><img src="images/bateau.png" width="16" height="16" />
          <p><?php echo $lang['bateau']; ?></p>
        </div>
        <div id="dpi_Autre" class="depense_item" onclick="type_item_selected('<?php echo $lang['autre']; ?>')"><img src="images/autre.png" width="16" height="16" />
          <p><?php echo $lang['autre']; ?></p>
        </div>
      </div>
      <div id="infobulle_montant" class="infobulle"><?php echo $lang['infobulle_corriger']; ?></div>
      <div id="infobulle_date" class="infobulle"><?php echo $lang['infobulle_corriger']; ?></div>
      <table width="350" class="justif_details" border="0">
        <tr>
            <td width="150" height="40" align="left" align="center" valign="middle">
          <?php echo $lang['montant']; ?>
            </td>
            <td width="200" height="40" align="left" align="center" valign="middle">
          <input type="text" id="tbx_montant" name="tbx_montant" onblur="check_number(this)"/>
            </td>
        </tr>
        <tr>
            <td width="150" height="40" align="left" align="center" valign="middle">
          <?php echo $lang['date_facture']; ?>
            </td>
            <td width="200" height="40" align="left" align="center" valign="middle">
          <input type="text" id="tbx_date" name="tbx_date" onblur="check_date(this)" />
            </td>
        </tr>
        <tr>
            <td width="150" height="40" align="left" align="center" valign="middle">
          <?php echo $lang['lieu']; ?>
            </td>
            <td width="200" height="40" align="left" align="center" valign="middle">
          <input type="text" id="tbx_lieu" name="tbx_lieu"/>
            </td>
        </tr>
        <tr>
            <td width="150" height="40" align="left" align="center" valign="middle">
          <?php echo $lang['type_depense']; ?>
            </td>
            <td width="200" height="40" align="left" align="center" valign="middle">
          <input type="text" id="tbx_type" name="tbx_type" onfocus="suggestion(this)" onblur="suggestion_out(this)" readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <td width="150" height="40" align="left" align="center" valign="middle">
          <?php echo $lang['commentaire']; ?>
            </td>
            <td width="200" height="40" align="left" align="center" valign="middle">
          <input type="text" id="tbx_commentaire" name="tbx_commentaire"/>
            </td>
            <input type="hidden" value="<?php echo $id_note; ?>" id="id_note" name="id_note"/>
        </tr>
      </table>
      <center>
        <br />
        <input type="button" value="<?php echo $lang['retour']; ?>" class="btn_submit" onclick="back_step()"/>
        <input type="button" value="<?php echo $lang['valider_justif']; ?>" class="btn_submit" onclick="perform_step()"/>
      </center>
    </div>
    </div>
      </form>
      <!-- FIN CONTENT STEP2 -->
      <div id="content_step3" style="display:none">
          <img src="images/loading.gif" />
    </div>
  </div>
<div id="base_loading"><center><img src="images/loading.gif"/></center></div>
<div id="base" class="base_note">
  <div id="ticket_conteneur">
      <?php
        $query = "SELECT * FROM JUSTIFICATIF WHERE id_note = ".$id_note."";
        $execute_query = mssql_query($query);
        $i = 0;
        while($result = mssql_fetch_array($execute_query))
        {
            $i++;
            /*echo "<div id=\"t".$result['id_justif']."\" class=\"ticketItem_Note\" onmouseout=\"showMenu('#suppr".$result['id_justif']."', '#edit".$result['id_justif']."', true);\" onmouseover=\"showMenu('#suppr".$result['id_justif']."', '#edit".$result['id_justif']."', false);\">";
            echo "<a href=\"#\"><div id=\"suppr".$result['id_justif']."\" class=\"ticket_supp\" onclick=\"deleteTicket('#t".$result['id_justif']."', '#suppr".$result['id_justif']."', '#edit".$result['id_justif']."');\"></div></a>";
            echo "<a href=\"#\"><div id=\"edit".$result['id_justif']."\" class=\"ticket_edit\"></div></a>";
            echo "</div>";*/
            
            
            echo '<div id="t'.$result['id_justif'].'" class="ticketItem_Note" onmouseout="showMenu(\'#suppr'.$result['id_justif'].'\', \'#edit'.$result['id_justif'].'\', true);"';
            echo 'onmouseover="showMenu(\'#suppr'.$result['id_justif'].'\', \'#edit'.$result['id_justif'].'\', false);"><img src="upload/'.$result['url_photo_justif'].'" width="155px" height="105px"/><div id="ticket_pic">';
            echo '<a href="#"><div id="suppr'.$result['id_justif'].'" class="ticket_supp" onclick="deleteTicket(\'#t'.$result['id_justif'].'\', \'#suppr'.$result['id_justif'].'\', \'#edit'.$result['id_justif'].'\');"></div></a>';
            echo '<a href="#"><div id="edit'.$result['id_justif'].'" class="ticket_edit"></div></a></div></div>';
        }
        $width = 185*$i;
      ?>
      <script>$("#ticket_conteneur").animate({width:'+=<?php echo $width; ?>px'}, 0);</script>
  <!-- EXEMPLE TICKET
    <div id=\"t1\" class=\"ticketItem_Note\" onmouseout=\"showMenu('#suppr1', '#edit1', true);\" onmouseover=\"showMenu('#suppr1', '#edit1', false);\">
      <a href=\"#\"><div id=\"suppr1\" class=\"ticket_supp\" onclick=\"deleteTicket('#t1', '#suppr1', '#edit1');\"></div></a>
      <a href=\"#\"><div id=\"edit1\" class=\"ticket_edit\"></div></a>
    </div>
    <div id="t2" class="ticketItem_Note" onmouseout="showMenu('#suppr2', '#edit2', true);" onmouseover="showMenu('#suppr2', '#edit2', false);">
      <a href="#"><div id="suppr2" class="ticket_supp" onclick="deleteTicket('#t2', '#suppr2', '#edit2');"></div></a>
      <a href="#"><div id="edit2" class="ticket_edit"></div></a>
    </div> -->
    <div id="t_Add" class="ticketItem_NoteAdd" onmouseout="showAdd('#add', true);" onmouseover="showAdd('#add', false);">
      <a href="#" onclick="open_add_ticket();"><div id="add" class="ticket_add"></div></a>
    </div>
  </div>
</div>
  
<!-- FIN CONTENT BASE -->
</body>
</html>
<?php mssql_close(); ?>