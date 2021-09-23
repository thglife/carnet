<?php
    class Dao{
        
        private static $config = array(
            'host' => 'localhost',
            'user' => 'thglife',
            'bd' => 'carnet',
            'password' => 'lifeThg@SqlMy',
            'options' => array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            )
        );
        public static function getDb(){
            try{
                return new PDO('mysql:host='. self::$config['host'] .';dbname='. self::$config['bd'], self::$config['user'], self::$config['password'], self::$config['options']);
                
            }catch(PDOException $e){
                print 'Erreur '. $e->getMessage();
            }
        }
    }