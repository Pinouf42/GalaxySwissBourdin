<?php
require_once '../include/language.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="../css/style_valid.css" />           
        <link rel="stylesheet" href="../css/style.css" />
        <title>#titre#</title>
        <script src="../js/jquery.min.js"></script>        
        <script type="text/javascript" src="../js/JS_Luc.js"></script> 

    </head>



    <body onload="Accueil('base');">                    
        <div id="selection_pays">
            <div id="bandeau_pays"></div>
            <div id="menu_2_items">  
                #menu_2_items#
            </div>   
            <div id="logged">
                <table width="250" border="0">
                    <tr>
                        <td width="40" height="40" align="center" valign="middle"><img src="../images/user.png" /></td>
                        <td width="146" valign="middle"><b>Luc Sinardet</b><br />
                            <a href="#">#se_deco#</a></td>
                    </tr>
                </table>
            </div>
        </div> 

        <script src="../js/jquery.pageslide.min.js"></script>
        <div id="base">
            <!-- Début tableau liste des notes des frais -->
            <div id="tab_justif_div"> 
                <div id="popup_info" class="error"></div>
                <div id="tab_justificatif">
                    <div id="img_detail"></div>
                    #content#
                </div>             
                <!-- Fin tableau liste des notes des frais -->
            </div>  
        </div>		

    </body>
</html>