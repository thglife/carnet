<?php
    class ContactManager{
        private $_db;


        public function __construct($db)
        {
            $this->setDb($db);
        }
        public function setDb($db){
            $this->_db = $db;
        }

        public function add(Contact $contact){
            $stm = $this->_db->prepare('INSERT INTO Contact SET nom_complet = :nom, adresse = :add, telephone = :tel, email = :email, date_enregistrer = NOW()');
            // var_dump($contact->getNom_complet()); die();
            $stm->bindValue(':nom', $contact->getNom_complet());
            $stm->bindValue(':add', $contact->getAdresse());
            $stm->bindValue(':tel', $contact->getTelephone());
            $stm->bindValue(':email', $contact->getEmail());

            $stm->execute();
        }

        public function selectAll($Apartir, $limite){
            $tabContact = array();

            $requete = $this->_db->query("SELECT nom_complet, adresse, telephone, email, date_enregistrer FROM Contact ORDER BY date_enregistrer DESC LIMIT $Apartir, $limite");
          

         
            while($donne = $requete->fetch()){
                $tabContact[] = new Contact($donne);
            }
          
            return $tabContact;
        }
        public function countNombrePage(){
            $requete = $this->_db->query('SELECT count(id) as nbrLigne FROM Contact');
            $nombre = $requete->fetch();
            return $nombre['nbrLigne'];
        }
        public function selectById($id){
            $requete = $this->_db->query('SELECT email FROM Contact WHERE id ='. (int)$id);

            return new Contact($requete->fetch());
        }
    }
?>