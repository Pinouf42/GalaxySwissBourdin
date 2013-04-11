<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="css/detail_justif.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bjqs-1.3.min.js"></script>
        <script src="js/JS_Luc.js"></script>
    </head>
    <script>
        var Masession=0;
        
        function hide_ticket()
        {
            Masession=0;
            $(".hidden").fadeOut(250,function(){
                $(".hide").animate({
                    'height':'0px'
                },500); 
                $(".hide").fadeOut(250);                                       
                var n = "<tbody><tr><td class=\"title_lbl_detail_justif\"><b>#lbl_num_justif#</b></td><td>#id_justif#</td></tr>"
                n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_type_depense#</b></td><td>#lib_dep#</td></tr>"
                n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_montant#</b></td><td>#montant# €</td></tr> "                                                
                n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_lieu#</b></td><td>#lieu#</td></tr>"                
                n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_commentaire#</b></td><td>#commentaire#</td></tr></tbody>";
                document.getElementById("justif").innerHTML=n;
                    
                var n = "http://www.whpinouf.com/gsb/upload/#url_photo#";
                document.getElementById("show_img_justif").src=n;
                    
                   
            });      
        }
        
        function show_ticket(id_justif,lib_dep,montant,lieu,commentaire,url_photo)
        {      
                        
            if(Masession==1)
            {
                setTimeout(function(){show_ticket(id_justif,lib_dep,montant,lieu,commentaire,url_photo)}
                ,1200);                
            }
            $(".hide").stop();
            $(".hidden").stop();
            if($(".hide").css("display") == 'block')
            {    
                Masession=0;
                $(".hidden").fadeOut(250,function(){
                    $(".hide").animate({
                        'height':'0px'
                    },500); 
                    $(".hide").fadeOut(250);                                       
                    var n = "<tbody><tr><td class=\"title_lbl_detail_justif\"><b>#lbl_num_justif#</b></td><td>#id_justif#</td></tr>"
                    n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_type_depense#</b></td><td>#lib_dep#</td></tr>"
                    n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_montant#</b></td><td>#montant# €</td></tr> "                                                
                    n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_lieu#</b></td><td>#lieu#</td></tr>"                
                    n+="<tr><td class=\"title_lbl_detail_justif\"><b>#lbl_commentaire#</b></td><td>#commentaire#</td></tr></tbody>";
                    document.getElementById("justif").innerHTML=n;
                    
                    var n = "http://www.whpinouf.com/gsb/upload/#url_photo#";
                    document.getElementById("show_img_justif").src=n;
                    
                    
                   
                });                
            }
            else
            {
            
                Masession=1;
                var str=document.getElementById("justif").innerHTML;                  
                var n=str.replace("#id_justif#",id_justif)
                .replace("#lib_dep#",lib_dep)
                .replace("#montant#",montant)
                .replace("#lieu#",lieu)
                .replace("#commentaire#",commentaire); 
                document.getElementById("justif").innerHTML=n;
                
                var str=document.getElementById("show_img_justif").src;               
                var n=str.replace("#url_photo#",url_photo); 
                document.getElementById("show_img_justif").src=n;
                
                $(".hide").stop(); 
                $(".hidden").stop();                                                          
                $(".hide").fadeIn(250,function(){
                    $(".hide").animate({
                        'height':'171px'
                    },500,function(){
                        $(".hidden").fadeIn(250);
                    }); 
                });                
            } 
        }
    </script>
    <body>
        <div id="black" class="blackbackground"></div>
        <div id="confirm_box">
            <div id="confirm_box_header">
                Validation de la note de frais
            </div>  
            <div id="content_confirm_box">
                <b>Êtes vous sur de vouloir #value_validation# la note de frais ?</b>
                <br/><br/>
                <b>Commentaire : </b>(255 caractères maximun)<br/>
                <input id="valid_commentaire" title="ok" type="text" maxlength="255" onmouseover="this.title=this.value"/><br/>
                (<em>Passer vôtre souris sur le champ pour voir vôtre commentaire en entier</em>)<br/><br/>
                <input id="buton_valider" width="50px" value="#validation_value#" type="button" class="btn_submit" onclick="validation(2,this.value);"/>
                <input id="buton_refuser" value="Annuler" type="button" class="btn_submit" onclick="validation(1,this.value);" />
             </div>
          </div>
        <div id="popup_info" class="success"></div>
        <div id="secondary">
            <div id="content_slide">
                <div id="dialog_form">
                    <div id="header_dialog_form">#titre_detail_justif#</div>
                    <div id="content_dialog">
                        <div id="info_visiteur">
                            <div id="content_info_visiteur">
                                #info_justif# 
                            </div>
                        </div> 
                        <div id="info_justif" onScroll="scroll_info();"> 
                            <!-- Debut slider des justificatifs -->
                            <div id="banner-bjqs">
                                #content#
                                <!-- Fin slider des justificatifs -->
                            </div>
                            #confirm_buton_note#
                        </div>

                    </div>
                </div>
                <div id="dialog_form" class="hide">
                    <div class="close" onclick="hide_ticket()"></div>
                    <div id="header_dialog_form" class="hidden">#titre_detail_justif#</div>
                    <div id="content_dialog" class="hidden">
                        <div id="info_justif">
                            <img id="show_img_justif" src="http://www.whpinouf.com/gsb/upload/#url_photo#"></img>
                            <div id="content_info_justif">
                                <table cellspacing="5" id="justif">
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b>#lbl_num_justif#</b></td>
                                        <td>#id_justif#</td>
                                    </tr>                                    
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b>#lbl_type_depense#</b></td>
                                        <td>#lib_dep#</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b>#lbl_montant#</b></td>
                                        <td>#montant# €</td>
                                    </tr>    
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b>#lbl_lieu#</b></td>
                                        <td>#lieu#</td>
                                    </tr>
                                    <tr>
                                        <td class="title_lbl_detail_justif"><b>#lbl_commentaire#</b></td>
                                        <td>#commentaire#</td>
                                    </tr>   
                                </table>
                            </div>                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>