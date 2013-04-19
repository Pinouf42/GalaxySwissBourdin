

var g_Pays = false;
function Accueil(Obj)
{
    $("#"+Obj).fadeIn(500);
}

function Popup_show_img(src_img)
{
    
    if($('.blackbackground', window.parent.document).css('display') == 'block')
    {
        $('.blackbackground', window.parent.document).fadeOut(400);
        $('#popup_show_img', window.parent.document).fadeOut(400);
        $('#dialog_form_img', window.parent.document).fadeOut(400);
    }
    else
    {
        centerThis($('.blackbackground', window.parent.document).fadeIn(400));
        $('#popup_show_img', window.parent.document).attr('src', src_img).fadeIn(400);
        $('#dialog_form_img', window.parent.document).fadeIn(400);
        
    }
    
}

function centerThis(element) {
    var windowHeight = $(window).height();
    var windowWidth = $(window).width();
    var elementHeight = $(element).height();
    var elementWidth = $(element).width();

    var elementTop, elementLeft;

    if (windowHeight <= elementHeight) {
        elementTop = $(window).scrollTop();
    } else {
        elementTop = ((windowHeight - elementHeight) / 2) + $(window).scrollTop();
    }

    if (windowWidth <= elementWidth) {
        elementLeft = $(window).scrollLeft();
    } else {
        elementLeft = ((windowWidth - elementWidth) / 2) + $(window).scrollLeft();
    }

    $(element).css({
        'top': elementTop,
        'left': elementLeft
    });
}

              
function popup_show(Cls_name,Chaine_info)
{       
    document.getElementById("popup_info").className=Cls_name;
    document.getElementById("popup_info").innerHTML=Chaine_info; 
    $("#popup_info").fadeIn(400);
}

/*function favicon_change(url)
{
    $("#favicon").remove();
    $('<link id="favicon" type="image/x-icon" rel="shortcut icon" href="'+url+'" />').appendTo('head');
}*/
                    
function popup_hide()
{                        
    $("#popup_info").fadeOut(300);
}
                
function find() {
    if (-10 < document.getElementById("date_picker").offsetLeft)
    {
        $("#date_picker").animate(
        {
            "left": "-=150px"
        },
        "slow");
    }
    else
    {
        $("#date_picker").animate(
        {
            "left": "+=150px"
        },
        "slow");
    }

} 

function validation(choix,value_valid,id_note,id_pers)
{                  
    //0 ouverture de la fenetre de validation
    //1 Cliquer bouton annuler
    //2 Clique bouton valider ou refuser
    if(choix==0)
    {      
        var str= document.getElementById("content_confirm_box").innerHTML;
        var n= str.replace("#value_validation#",value_valid.toLowerCase())
        .replace("#validation_value#",value_valid.toLowerCase())
        .replace("#c_id_note#",id_note)
        .replace("#c_id_pers#",id_pers);
        document.getElementById("content_confirm_box").innerHTML=n;
        
        $("#black").fadeIn(500, function()
        {
            $("#confirm_box").fadeIn(500);
        });
    }
    else if(choix==1)
    {        
        clear_confir_box();
         
    }else if(choix==2)
    {    
        if(document.getElementById("valid_commentaire").value=="")
        {
            if(confirm("Il n'y a pas de commentaire êtes vous sur de vouloir " + value_valid + " ?")==true)
            {             
                if(value_valid.toLowerCase()=="valider")
                {
                    etat = 1;  
                }
                else if(value_valid.toLowerCase()=="refuser")
                {
                    etat = 0; 
                }            
                var commentaire = document.getElementById("valid_commentaire").value;             
                validation_requete_mssql(id_note,id_pers,commentaire, etat);
            }
            
        }
        else
        {               
            var etat;
            if(value_valid.toLowerCase()=="valider")
            {
                etat = 1;  
            }
            else if(value_valid.toLowerCase()=="refuser")
            {
                etat = 0; 
            }            
            var commentaire = document.getElementById("valid_commentaire").value;             
            validation_requete_mssql(id_note,id_pers,commentaire, etat);            
        }      
        clear_confir_box();        
    }
    else if(choix==3)
    {
         popup_show("info","Redirection dans ");
         compte_a_rebour("Redirection dans "); 
    }
}

function clear_confir_box()
{
    $("#confirm_box").fadeOut(400,function(){
        str='Êtes vous sur de vouloir #value_validation# la note de frais ?<br/><br/>';
        str+='<input id="c_id_pers" type="hidden" value="#c_id_pers#"/>';
        str+='<input id="c_id_note" type="hidden" value="#c_id_note#"/>';
        str+='<b>Commentaire : (255 caractères maximun)</b><br/>';
        str+='<input id="valid_commentaire" type="text" maxlength="255"/><br/>';
        str+='(<em>Passer vôtre souris sur le champ pour voir vôtre commentaire en entier</em>)<br/><br/>';
        str+='<input id="buton" width="50px" value="#validation_value#" type="button" class="btn_submit" onclick="validation(2,this.value,document.getElementById(\'c_id_note\').value,document.getElementById(\'c_id_pers\').value);"/>';
        str+='<input id="buton_annuler" value="Annuler" type="button" class="btn_submit" onclick="validation(1,this.value,document.getElementById(\'c_id_note\').value,document.getElementById(\'c_id_pers\').value);" />';
        document.getElementById("content_confirm_box").innerHTML=str;
        $("#black").fadeOut(400);
    });
}

function validation_requete_mssql(id_note,id_pers,commentaire,etat)
{        
    var Chaine_etat;
    xhr=new XMLHttpRequest();
    xhr.open('POST', '../actions/valid_note.php'); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('Q=QnI&id_note='+id_note+'&id_pers='+id_pers+'&comm='+commentaire+'&etat='+etat+'');  
    xhr.onreadystatechange = function() {                            
        if(xhr.readyState == 4) {
            var Tab_rep_valid =JSON.parse(xhr.responseText); 
            if(Tab_rep_valid.rows!=0)
            {   
                if(etat==1)
                {
                    Chaine_etat="La note de frais à bien été validée</br></br>Vous allé être redirigé dans ";
                }
                else
                {
                    Chaine_etat="La note de frais à bien été refusée</br></br>Vous allé être redirigé dans ";       
                }
                setTimeout(function(){
                    alert(Chaine_etat+"--");
                    popup_show("success",Chaine_etat); 
                    compte_a_rebour(Chaine_etat);
                },1000);
                
                
            }
            else if(Tab_rep_valid.rows==0)
            {
                setTimeout(function(){
                    popup_show("error","Erreur lors de l'insertion en base de donnée. Veuillez recommencer !");
                },1000);    
            }            
        } 
        setTimeout(function(){
            popup_hide()
        },7000);
    }    
}

var time=5;
var time2=1000;
    
function compte_a_rebour(chaine) {   
    
    if(time>=0) {
        
        document.getElementById("popup_info").innerHTML=chaine+time+" secondes"; 
        
        time=time-1
        setTimeout(function(){
            compte_a_rebour(chaine);
        }, time2);
    }
    else {
        window.top.location = window.top.location;
    }
}



