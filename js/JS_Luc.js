

var g_Pays = false;
function Accueil(Obj)
{
    $("#"+Obj).fadeIn(500);
}
              
function popup_show(Cls_name,Chaine_info)
{       
    document.getElementById("popup_info").className=Cls_name;
    document.getElementById("popup_info").innerHTML=Chaine_info; 
    $("#popup_info").fadeIn(400);
}

function favicon_change(url)
{
    $("#favicon").remove();
    $('<link id="favicon" type="image/x-icon" rel="shortcut icon" href="'+url+'" />').appendTo('head');
}
                    
function popup_hide()
{                        
    $("#popup_info").fadeOut();
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

function validation(choix,value_valid)
{        
    
    //0 ouverture de la fenetre de validation
    //1 Cliquer bouton annuler
    //2 Clique bouton valider ou refuser
    if(choix==0)
    {
        var str= document.getElementById("content_confirm_box").innerHTML;
        var n= str.replace("#value_validation#",value_valid.toLowerCase())
        .replace("#validation_value#",value_valid.toLowerCase());
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
                clear_confir_box();
            }
            
        }
        else
        {
                
        }
                
        
    }
}

function clear_confir_box()
{
    $("#confirm_box").fadeOut(400,function(){
        str='Êtes vous sur de vouloir #value_validation# la note de frais ?<br/><br/>';
        str+='<b>Commentaire : (255 caractères maximun)</b><br/><br/>';
        str+='<input id="valid_commentaire" type="text" maxlength="255"/><br/><br/>';
        str+='<input id="buton" width="50px" value="#validation_value#" type="button" class="btn_submit" onclick="validation(2,this.value);"/>';
        str+='<input id="buton" value="Annuler" type="button" class="btn_submit" onclick="validation(1,this.value);" />';
        document.getElementById("content_confirm_box").innerHTML=str;
        $("#black").fadeOut(400);
    });
}