<?php
    function chargerClass($classe)
    {
        require_once ('../class/'. $classe. '.class.php');
    }spl_autoload_register('chargerClass');

    $manager = new ContactManager(Dao::getDb());
    
    // var_dump($_POST); die();
    if(isset($_POST['enregistrer'])){
        if(isset($_POST['nom_complet']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adresse'])){
            $manager->add(new Contact($_POST));
            header('location:../index.php');
        }
    }   
    
?>