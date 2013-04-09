   
function show_popup()
{
    document.getElementById("popup_info").InnerHTML="Me voilà";
}

var g_Pays = false;
function Accueil()
{
    $("#base").fadeIn(500);
}
function chargement()
{
    bdd_connect();
    setInterval(function(){
        bdd_connect();
    },15000); 
// temps pour test connection BDD 30sd
}

function bdd_query_note()
{
    xhr=new XMLHttpRequest();
    xhr.open('POST', 'include/Obj_luc.php'); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + "query_note");        
      
    $("#popup_info").fadeOut(400,function(){
        popup_show("info","Chargement des notes de frais <img style=\"margin-left:10px;\" src=\"images/loader_blue.gif\"></img>");
        favicon_change("images/info.png");
    });
                
    xhr.onreadystatechange = function() {                            
        if(xhr.readyState == 4) {                                 
            Mjson = JSON.parse(xhr.responseText); 
            $("#popup_info").fadeOut(400,function(){
                if(Mjson.tab_connection.id_connection==1)
                {                      
                    var max=Mjson.tab_query.length+2;
                    var val =document.getElementById ('table_note').getElementsByTagName("tr").length;                    
                    if(val<=max)
                    {
                        AjouterLigne(Mjson); 
                        popup_show("success","Chargement des notes de frais réussie");
                        favicon_change("images/success.png"); 
                    }    
                    else
                    {
                        popup_show("info","Les notes de frais sont déjà chargées");
                        favicon_change("images/info.png"); 
                    }
                    
                }
                else
                {
                    popup_show("warning","Impossible de charger les notes de frais");
                    favicon_change("images/warning.png");  
                }
            });
        } 
        
    } 
}

function AjouterLigne (Mjson)
{    
    for (var i=0;i<Mjson.tab_query.length;i++)
    {        
        // Création de la ligne    
        TR = document.createElement ("tr");
        TR.setAttribute("class", "tr_justificatif");
        for (var y=0;y<4;y++)
        {  
            TD  = document.createElement ("td");
            TXT = document.createTextNode (Mjson.tab_query[i][y]);       
            TD.appendChild (TXT); 
            TR.appendChild(TD)            
        }      
        TD  = document.createElement ("td");
        TD.setAttribute("id", "open_file");
        TD.setAttribute("onclick", "$.pageslide({direction: 'left', href: 'detail_justif.php?id=125', iframe: 'false'});");
        TR.appendChild(TD)     
        // On assemble la ligne au tableau
        document.getElementById ('table_note').appendChild (TR);
    }    
    
    
}

function bdd_connect()
{
    xhr=new XMLHttpRequest();
    xhr.open('POST', 'include/Obj_luc.php'); 
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + "connection");        
      
    $("#popup_info").fadeOut(400,function(){
        popup_show("info","Connection en cours <img style=\"margin-left:10px;\" src=\"images/loader_blue.gif\"></img>");
        favicon_change("images/info.png");
    });
    
    
                
    xhr.onreadystatechange = function() {                            
        if(xhr.readyState == 4) {                                 
            Mjson = JSON.parse(xhr.responseText); 
            $("#popup_info").fadeOut(400,function(){
                if(Mjson.tab_connection.id_connection==1)
                {                      
                    popup_show("success",Mjson.tab_connection.text);
                    favicon_change("images/success.png");
                    bdd_query_note();
                }
                else
                {
                    popup_show("error",Mjson.tab_connection.text);
                    favicon_change("images/error.png");
                }
            });
        }  
    } 
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