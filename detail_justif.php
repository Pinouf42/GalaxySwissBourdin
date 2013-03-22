<?php
include 'include/language.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <link rel="stylesheet" href="css/detail_justif.css">
            <script src="js/jquery.min.js"></script>
            <script src="js/bjqs-1.3.min.js"></script>
    </head>
    <script>
        function show_ticket()
        {   
            $(".hide").stop();
            $(".hidden").stop();
            if($(".hide").css("display") == 'block')
            {                
                $(".hidden").fadeOut(250,function(){
                    $(".hide").animate({
                        'height':'0px'
                    },500); 
                    $(".hide").fadeOut(250);
                });
            }
            else
            {
                $(".hide").stop(); 
                $(".hidden").stop();                                                          
                $(".hide").fadeIn(250,function(){
                    $(".hide").animate({
                        'height':'335px' /* 282px si une ligne de moin  */
                    },500,function(){
                        $(".hidden").fadeIn(250);
                    }); 
                });
                
            }
        }
    </script>
    <body>
        <div id="popup_info" class="success"></div>
        <div id="secondary">
            <div id="content_slide">
                <div id="dialog_form">
                    <div id="header_dialog_form"><?php echo $lang['titre_detail_justif']; ?></div>
                    <div id="content_dialog">
                        <div id="info_visiteur">
                            <div id="content_info_visiteur">
                                <table id="justif">
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_visiteur']; ?></b></td>
                                        <td> Sinardet Luc</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_responsable']; ?></b></td>
                                        <td>Piney Julien</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_region']; ?></b></td>
                                        <td>Loire</td>
                                    </tr>
                                </table> 
                            </div>
                        </div> 
                        <div id="info_justif" onScroll="scroll_info();">
                            

                            <!-- Debut slider des justificatifs -->
                            <div id="banner-bjqs">
                                <div id="banner-fade">
                                    <!-- start Basic Jquery Slider -->
                                    <ul class="bjqs">
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>
                                        <li><img onclick="show_ticket()" src="images/ticket.png" title="Essence : 30€  -  Date : 30/12/2013  -  Lieu : Grenoble"/></li>                                    </ul>
                                    <!-- end Basic jQuery Slider -->
                                    <script class="secret-source">
                                        jQuery(document).ready(function($) {
                                            $('#banner-fade').bjqs({
                                                height      : 180,
                                                width       : 280,
                                                responsive  : true
                                            });
                                        }); 
                                    </script>
                                </div>
                                <!-- Fin slider des justificatifs -->
                            </div>
                        </div>

                    </div>
                </div>
                <div id="dialog_form" class="hide">
                    <div id="header_dialog_form" class="hidden"><?php echo $lang['titre_detail_justif']; ?></div>
                    <div id="content_dialog" class="hidden">
                        <div id="info_visiteur">
                            <div id="content_info_visiteur">
                                <table id="justif">
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_visiteur']; ?></b></td>
                                        <td> Sinardet Luc</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_responsable']; ?></b></td>
                                        <td>Piney Julien</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_region']; ?></b></td>
                                        <td>Loire</td>
                                    </tr>
                                </table> 
                            </div>
                        </div> 
                        <img id="show_img_justif" src="images/ticket.png"></img>
                        <div id="info_justif">
                            <div id="content_info_justif">
                                <table id="justif">
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_num_justif']; ?></b></td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_date_facture']; ?></b></td>
                                        <td> 19/12/2010</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_date_soumission']; ?></b></td>
                                        <td> 21/12/2010</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_type_depense']; ?></b></td>
                                        <td>Essence</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_montant']; ?></b></td>
                                        <td>78€</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b><?php echo $lang['lbl_date_soumission']; ?></b></td>
                                        <td><?php echo $_GET['id']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="confirm_buton">
                                <input id="buton" class="btn_submit" type="button" onclick="if(confirm('Voulez vous valider ce justificatif ?')){show_ticket();};" value="<?php echo $lang['btn_valider']; ?>"/>
                                <input id="buton" class="btn_submit" type="button" onclick="if(confirm('Voulez vous refuser ce justificatif ?')){show_ticket();};" value="<?php echo $lang['btn_refuser']; ?>"/>
                                <input id="buton" class="btn_submit" type="button" onclick="show_ticket(); "value="<?php echo $lang['btn_annuler']; ?>"/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>