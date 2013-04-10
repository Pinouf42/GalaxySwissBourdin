<?php

require_once 'DB.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Objet générant des tableau
 *
 * @author imhotep
 */
class Table {

    /**
     * Numéro de tabulation
     * @var int
     */
    private $tabulation;
    private $DB;

    /**
     * Constructeur 
     */
    public function __construct() {
        $this->tabulation = 0;
        $this->DB = new DB();        
    }

    /**
     * Destructeur 
     */
    function __destruct() {
        ;
    }

    /**
     * Champ texte HTML
     * @param string $name Nom du champ
     * @return string code HTML
     */
    public function Table_note() {
        $this->tabulation++;

        $sql = $this->DB->query("select id_note, nom_pers, prenom_pers, datesoumission_note
                            from note_frais, PERSONNEL
                            where note_frais.id_pers=personnel.id_pers
                            and id_note not in(select id_note from validation)
                            and clos_note=1");



        // Préparation du tableau des notes de frais
        $table = '<table id="table_note">
						<caption>Tableau de validation des note de frais</caption>
						<thead><tr  class="entete" >
						<th scope="col">N° note</th>
						<th scope="col">Nom visiteur</th>
						<th scope="col">Prénom visiteur</th>
						<th scope="col">Date soumission</th>
						<th scope="col">A valider</th></tr></thead>
						<tfoot><tr><th scope="row">G S B</th><td colspan="3"></td>
						<th scope="row">Retour</th></tr>
						</tfoot><tbody>';

        for ($i = 0; $i < $sql['nblig']; $i++) {
            $date = date("d-m-Y", strtotime($sql[$i]["datesoumission_note"]));
            $nom_pers = $sql[$i]["prenom_pers"];
            $prenom_pers = $sql[$i]["nom_pers"];
            $id_note = $sql[$i]["id_note"];

            $table .= '<tr class="tr_justificatif">
						<td>' . $id_note . '</td>
						<td>' . $prenom_pers . '</td>
						<td>' . $nom_pers . '</td>
						<td>' . $date . '</td>
						<td id="open_file" onclick="$.pageslide({direction: \'left\', href: \'detail_justif.php?id=' . $id_note . '&nom=' . $nom_pers . '&prenom=' . $prenom_pers . '&date=' . $date . '\', iframe: \'false\'});"></td>
						</tr> ';
        }

        $table .='</table>';


        return $table;
    }

}

?>
