<?php
include 'include/language.php';
include 'include/menu.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style_valid.css" />   
        <link id="favicon" rel="shortcut icon" type="image/png" href="" />
        <link rel="stylesheet" href="css/style.css" />
        <title><?php echo $lang['titre_page']; ?></title>
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript"  src="js/Segoe_UI_400-Segoe_UI_700-Segoe_UI_italic_400.font.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script> 
        <script type="text/javascript" src="js/JS_Luc.js"></script> 

    </head>

    <body onload="Accueil(); chargement();">                    
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
                        <td width="146" valign="middle"><b>Luc Sinardet</b><br /><a href="#"><?php echo $lang['se_deconnecter']; ?></a></td>
                    </tr>
                </table>
            </div>                        
        </div> 
        
        <table id="date_picker">
            <tr>
                <td>
                    <div id="date_debut"><?php echo $lang['lbl_date_debut']; ?><br>
                            <input type="date"/>
                    </div>
                </td>
                <td width="5px" rowspan="2" id="find" onclick="find()"><div display="inline" class="vertical"><?php echo $lang['lbl_rechercher']; ?></div></td>
            </tr>
            <tr>
                <td>
                    <div id="date_fin"><?php echo $lang['lbl_date_fin']; ?><br>
                            <input type="date"/>
                    </div>
                </td>                                
            </tr>
        </table> 

        <script src="js/jquery.pageslide.min.js"></script>

        <!-- Début tableau liste des notes des frais -->
        <div id="tab_justif_div"> 
            <div id="popup_info" class="error"></div>
            <div id="tab_justificatif">
                <div id="img_detail"></div>
                <table id="table_note"><caption><?php echo $lang['titre_tab_validation']; ?></caption><thead><tr  class="entete" ><th scope="col"><?php echo $lang['lbl_num_note']; ?></th><th scope="col"><?php echo $lang['lbl_tab_nom_visiteur']; ?></th><th scope="col"><?php echo $lang['lbl_tab_prenom_visiteur']; ?></th><th scope="col"><?php echo $lang['lbl_tab_date_facture']; ?></th><th scope="col"><?php echo $lang['lbl_tab_a_valider']; ?></th></tr></thead><tfoot><tr><th scope="row">G S B</th><td colspan="3"></td><th scope="row"><?php echo $lang['btn_retour']; ?></th></tr></tfoot><tbody>
                        <tr class="tr_justificatif">
                            <td>1 test</td>
                            <td>Sinardet</td>
                            <td>Luc</td>
                            <td>19/12/2010</td>                            
                            <td id="open_file" onclick="$.pageslide({direction: 'left', href: 'detail_justif.php?id=125', iframe: 'false'});"></td>                                   
                        </tr> 
                </table>
            </div>                        
            <!-- Fin tableau liste des notes des frais -->
        </div>                    



    </body>
</html>