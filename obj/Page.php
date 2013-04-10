<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Création de page
 *
 * @author imhotep
 */
class Page {
    
    /**
     * Contenu du fichier statique
     * @var string
     */
    private $content;


    public function __construct($filename) {
        $this->content = file_get_contents($filename);
    }
    
    public function addBalise($balise,$contenu) {
        $this->content = str_replace("#$balise#", $contenu, $this->content);        
    }
    
    public  function addContent($balise,$filename){
        $this->addBalise("$balise", file_get_contents($filename));
    }
    
    public function pageAffiche() {
        return $this->content;
    }
}

?>
