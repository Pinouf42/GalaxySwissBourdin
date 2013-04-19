<?php

/**
 * Connexion et utilisation de la base de données
 *
 * @author Samuel COLLADO
 */
class DB {

    /**
     * Ressource vers MySQL
     * @var mixed ressource id vers MySQL
     */
    private $link;
    private $DB_DEBUG;
    
    /**
     * Constructeur de l'objet
     */
    public function  __construct() {
        // Récupération de la configuration
        require_once '../include/config.php';
        
        // Connexion à la base
        $this->link = @mssql_connect($host,$username,$password) or die($this->errorMessage(mssql_error()));
        if (!@mssql_select_db($database, $this->link)) {
            die ($this->errorMessage(mssql_error()));
        }

    }

    /**
     * Execution d'une requete en base
     * @param string $query Requete SQL
     * @param int $return avec un tableau retour (0|1)
     * @param int $aux avec les données auxiliaires (0|1)
     * @return array Tableau resulat
     */
    public function query($query,$return=1,$aux=1) {
        $tabnom="";
        // Débuggage
        if ($this->DB_DEBUG==1) echo $this->errorMessage ($query);

        //PassageUTF-8 pour les requêtes insertion ou update
        if ($return==0) $query = utf8_decode($query);

        //Execution de la requete
        $req = @mssql_query($query,$this->link);
        if (($return==1) && ($req)) {
                //Remplissage des entêtes de colonnes
                $i=0;
                while ($nom=@mssql_fetch_field($req)) {
                        $tabnom[$i]=$nom->name;
                        $i++;
                }

                //Remplissage tableau
                $i=0;
                while ($lig=@mssql_fetch_assoc($req)) {
                        $tab[$i]=$lig;
                        $i++;
                }
                if ($aux==1) {
                        $tab['nblig']=$i;
                        $tab['cols']=$tabnom;
                        $tab['sql']=$query;
                        $tab['rows']=mssql_rows_affected($this->link);
                }
                //print_r($tab);
                return $tab;
        } else return @mssql_insert_id();
    }

    /**
     * Début d'une transaction
     */
    public function begin() {
        $this->query('BEGIN',0);
    }

    /**
     * Finalisation de la transaction
     */
    public function commit() {
        $this->query('COMMIT',0);
    }

    /**
     * Annulation de la transaction
     */
    public function rollback() {
        $this->query('ROLLBACK',0);
    }

    /**
     * Génération d'un message d'erreur
     * @param string $message Message de la base
     * @return string message de retour
     */
    private function errorMessage($message) {
        return '<strong>DB</strong> : '.$message.chr(13);
    }

    /**
     * Déconnexion de la base
     */
    public function  __destruct() {
         // Débuggage
        if ($this->DB_DEBUG==1) echo $this->errorMessage ("Entrée dans le destructeur");
        @mssql_close($this->link);
    }

}
?>
