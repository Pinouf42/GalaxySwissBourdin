<?php
include_once('include/config.php');
function getRandomString($length = 20) {
    $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";
    for ($i = 0; $i < $length; $i++)
	{
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}

$filename = basename($_FILES['tbx_send']['name']);
$new_filename = getRandomString(20);
if(file_exists('upload/'. $new_filename))
{
	$data = "0"; //Si le fichier existe déjà on renvoie une erreur
}
//Si l’upload a réussi et que le fichier est correctement posé sur le serveur
else 
{
	if($_FILES['tbx_send']['type'] == "image/gif" || $_FILES['tbx_send']['type'] == "image/png" || $_FILES['tbx_send']['type'] == "image/jpeg")
	{
		if (@move_uploaded_file($_FILES['tbx_send']['tmp_name'], 'upload/'. $new_filename))
		{
                        $montant = stripslashes($_POST['tbx_montant']);
                        $date = stripslashes($_POST['tbx_date']);
                        $lieu = stripslashes($_POST['tbx_lieu']);
                        $type = stripslashes($_POST['tbx_type']);
                        $commentaire = stripslashes($_POST['tbx_commentaire']);
                        $id_note = stripslashes($_POST['id_note']);
                        switch($type)
                        {
                            case 'Essence':
                                $type = "1";
                                break;
                            case 'Restaurant':
                                $type = "2";
                                break;
                            case 'Hotêl':
                                $type = "3";
                                break;
                            case 'Taxi':
                                $type = "4";
                                break;
                            case 'Avion':
                                $type = "5";
                                break;
                            case 'Bateau':
                                $type = "6";
                                break;
                            case 'Autre':
                                $type = "7";
                                break;
                            default:
                                $type = "7";
                        }

                        mssql_connect($host, $username, $password);
                        mssql_select_db($database);
                        $query = "INSERT INTO JUSTIFICATIF(montant, lieu, commentaire, id_dep, url_photo_justif, id_note) VALUES ('".$montant."', '".$lieu."', '".$commentaire."', '".$type."' , '".$new_filename."', '".$id_note."')";
                        if(mssql_query($query))
                        {
                            $data = $new_filename; //le retour sera le nom du fichier.
                        }
                        else
                        {
                            $data = "0";
                        }
                        mssql_close();
			
		}
		else //Si l’upload du fichier à échoué
		{    
			$data = "0"; //La valeur de retour sera à 0
		}
	}
	else
	{
		$data = "0";
        }
}

echo $data; //on affiche finalement le résultat dans la page.
?>