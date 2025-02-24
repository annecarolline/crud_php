<?php 

require_once "../../mysql/define.php";


 

class Conexao {  

    /*  
     * Atributo estático para instância do PDO  
     */  
  
    private static $con;
  
    /*  
     * Escondendo o construtor da classe  
     */ 
    private function __construct() {  
      //  
    } 

    public static function getInstance() { 

    $host = SQLSERVIDOR;
    $dbname = SQLDB;
    $user = SQLUSER;
    $password = SQLPWD;
  
  
    if (!isset(self::$con)) {  
        try {
            //self::$con = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            self::$con = new \PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            //echo "Conectado a $dbname em $host com sucesso.";
        } catch (PDOException $pe) {
            die("Não foi possível se conectar ao banco de dados $dbname :" . $pe->getMessage());
        }
    }
      return self::$con;  
    }  


    /*
    public static function getInstance() {  

        // $cript = new Criptografia();
         
         // $host = $cript->decrypt(SQLSERVIDOR);
         // $dbname = $cript->decrypt(SQLDB);
         // $user = $cript->decrypt(SQLUSER);
         // $password = $cript->decrypt(SQLPWD);
     
         $host = SQLSERVIDOR;
         $dbname = SQLDB;
         $user = SQLUSER;
         $password = SQLPWD;
     
        
     
         if (!isset(self::$pdo)) {  
           try {  
             //$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  
             self::$pdo = new PDO("mysql".":dbname=".$dbname.";host=".$host, $user, $password);  
             //Config::DB_DRIVER.":dbname=".Config::DB_DATABASE.";host=".Config::DB_HOST, 
           } catch (PDOException $e) {  
             print "Erro: " . $e->getMessage();  
           }  
         }  
         return self::$pdo;  
       }  

       */
  
    public static function disconnect()
    {
      self::$con = null;
    }
  }






























?>