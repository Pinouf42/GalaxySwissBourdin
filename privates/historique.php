<?php
require_once '../include/constantes.inc.php';
require_once '../include/language.php';
require_once '../include/menu.inc.php';
require_once '../obj/Page.php';
require_once '../obj/Table.php';
require_once '../obj/DB.php';

//session_start();
$_SESSION['mode']=4;
$_SESSION['id_pers']=4;


$Table = new Table();
//$DB = new DB();
$Page = new page(HTML.'historique.html');


$afficheMenu='';
$count = count($menu);
for($i = 0; $i < $count; $i++)
{
    $item = explode("|", $menu[$i]);
    $afficheMenu.= '<a href="'.$item[1].'"><div id="menu_item">'.$item[0].'</div></a>';
}
$Page->addBalise('MENU',$afficheMenu);





//mssql_connect($host, $username, $password);
//mssql_select_db($database);
//                                        $sql = "SELECT COLUMN_NAME
//                                                    FROM INFORMATION_SCHEMA.COLUMNS
//                                                    WHERE TABLE_NAME='note_frais'";
//                                        $result_query = mssql_query($sql);
//                                        while ($data = mssql_fetch_array($result_query)) { 
//                                        print_r($data);}die();

// 1: visiteur
// 2: delegué
// 3: responsable
// 4: admin


switch ($_SESSION['mode'])
{
    case '1': $sql = "select * from validation v, note_frais nf
                    where v.id_note = nf.id_note
                    and v.id_pers = ".$_SESSION['id_pers'];
        break;
    case '2': ;
        break;
    case '3': ;
        break;
    case '4':$sql = "select * from validation v, note_frais nf
                    where v.id_note = nf.id_note";
        break;
    default : echo 'erreur';
        break;
}
$sql .=' ORDER BY date_validation DESC';

//                                       $sql = "INSERT INTO validation
//                                            values('42','pas ok','4','0','10/04/2013')";

$data = $Page->DB->query($sql); //mssql_query($sql);
//print_r($data);die();
$content = $Table->tableDeb();
$content.='<thead>
            <tr><th scope="col"><input type=\'text\'></input></th><th scope="col"><input type=\'text\'></input></th><th scope="col"><input type=\'text\'></input></th><th scope="col"><input type=\'text\'></input></th></tr>
            <tr><th scope="col">N°</th><th scope="col">Date validation</th><th scope="col">Etat</th><th scope="col">Commentaire</th></tr>
            </thead>';

$i =0;

// pour chaque ligne
for($i=0; $i<$data['nblig'];$i++) 
{ 
    if ($data[$i]['etat_validation'] == 0)
        $etat_valid = "Rejeté";
    else
        $etat_valid = "Validé";
    //setlocale(LC_TIME, 'fra_fra');
    setlocale(LC_TIME, 'fr_FR.UTF8');
    //setlocale(LC_TIME, 'fr_FR');
    //setlocale(LC_TIME, 'fr');
    // on crée le tableau qui remplira les TD de la table
    $ligneTD= array(array('attribut'=>'', 
                        'valeur'=>$data[$i]['id_note']),
                    array('attribut'=>'', 
                        'valeur'=>  strftime('%A %d %B %Y',  strtotime($data[$i]['date_validation']))), //strftime($data[$i]['date_validation'])),
                    array('attribut'=>'class=\'etat_valid'.$data[$i]['etat_validation'].'\'', 
                        'valeur'=>$etat_valid),
                    array('attribut'=>'', 
                        'valeur'=>$data[$i]['commentaire_validation']));

    $content.=$Table->tableCreeLigneTD($ligneTD);
}  
mssql_close();

$content .= $Table->tableFin();

$Page->addBalise('CONTENT', $content);
echo $Page->pageAffiche();
?>
