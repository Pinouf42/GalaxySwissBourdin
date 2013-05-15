/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function filtre(colonne,text)
{
    //alert(text);
    var arrayLigne = document.getElementById("historique_tab").rows;
    var i = 2;
    var j = 0;
    //var str = document.getElementById("historique_tab").getElementsByTagName("tr").length+" ";
    //alert(arrayLigne.length);
    while (i <arrayLigne.length)
    {
        maLigne=arrayLigne[i].cells;
        if (maLigne[colonne].textContent == text || text == '')
        {
            arrayLigne[i].style.display='';
        }else{
            arrayLigne[i].style.display='none';
        }
        
            //str += "  " +maLigne[2].textContent;
        i++;
//        str += " -- ";
//        for (j=0; j<5; j++)
//        {
//            str += "  " + arrayLigne[i].innerHTML;
//            i++;
//        }
//        str += " -- ";
        
//        alert(arrayLigne[i].cell[2].innerHTML);
//        if (arrayLigne[i].cell[2].innerHTML == 'Validé')
//        {
//            arrayLigne[i].style.display='none';
//            arrayLigne[i].style.backgroundColor = "#829eeb";
//            alert('test');
//        }
        
    }
    //alert (str);
}

function show(word)
{
    var reg=new RegExp(word,'gi')
    var lignes=document.getElementById('tablecontainer').getElementsByTagName('tr');
    var i=1;
    while(lignes[i])
    {
        var found=false
        var cells=lignes[i].getElementsByTagName('td');
        var j=0;
        while(cells[j])
        {
            if(cells[j].innerHTML.match(reg)){found=true;}
            j++;
        }
        if(!found)
        {
            if( lignes[i].style.display == '') lignes[i].style.display = 'none';
            else lignes[i].style.display = '';
        }
        i++;
    }
}

