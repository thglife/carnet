<?php
    class Contact{

        private $_id;
        private $_nom_complet;
        private $_email;
        private $_telephone;
        private $_adresse;
        private $_date_enregistrer;


        public function __construct(array $donne)
        {
            $this->hydrater($donne);
        }

        public function hydrater(array $donnee){
            foreach ($donnee as $key => $value) {
                $method = 'set'. ucfirst($key);
                if(method_exists($this, $method)){
                    $this->$method($value);
                }
            }
        }

        public function getId(){
            return $this->_id;
        }

        public function getNom_complet(){
            return $this->_nom_complet;
        }
        public function getEmail(){
            return $this->_email;
        }
        public function getTelephone(){
            return $this->_telephone;
        }
        public function getAdresse(){
            return $this->_adresse;
        }
        public function getDate_enregistrer(){
            return $this->_date_enregistrer;
        }

        public function setDate_enregistrer($date){
            $this->_date_enregistrer = strftime("le %d/%m/%Y à %H:%M:%S", strtotime($date));
        }
        public function setId($id){
            $id = (int)$id;
            if($id > 0){
                $this->_id = $id;
            }
        }
        public function setNom_complet($nom){
            if(is_string($nom)){
                $this->_nom_complet = $nom;
            }
        }
        public function setTelephone($tel){
           if(preg_match('`[0-9]{9}`',$tel)){
                $this->_telephone = $tel;
           }
        }
        public function setEmail($email){
           //verifier la validité de l'email
          if(filter_var($email, FILTER_VALIDATE_EMAIL)){
              $this->_email = $email;
          }
        }

        public function setAdresse($add){
            if(is_string($add)){
                $this->_adresse = $add;
            }
        }


    }
?>