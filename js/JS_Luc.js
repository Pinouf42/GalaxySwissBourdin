function change_justif(Msens)
{   
    //0 à gauche
    //1 à droite
    alert("changement à"+Msens)
}
   
function show_popup()
{
    document.getElementById("popup_info").InnerHTML="Me voilà";
}

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