<?php 

function select_sql($sql, $fetchAll = 'all') {
           
    if (strtoupper(substr($sql,0,6)) == "SELECT") {
       require_once "conexao.php";
       $con = Conexao::getInstance();
       $stm = $con->prepare($sql);
       $stm->execute();
         
       if ($fetchAll = 'all') {
          $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
       } else {
          $dados = $stm->fetch(PDO::FETCH_ASSOC);
       }
          $con = null;
          Conexao::disconnect();
          return $dados;
    }
}

function select_crud($table) {
            
    require_once "conexao.php";
    $con = Conexao::getInstance();
    $dados = [];

    if ($con){
        $sql = "SELECT * FROM ".$table;

        $stm = $con->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    $con = null;
    Conexao::disconnect();
    return $dados;
    die();
}


function select_one_crud($table, $key, $value) {
            
    require_once "conexao.php";
    $con = Conexao::getInstance();

    $sql = "SELECT * FROM ".$table." WHERE ".$key." = '".$value."'";

    $stm = $con->prepare($sql);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    $con = null;
    Conexao::disconnect();
    return $dados;
}


function insert_crud($table, $array) {


    try{
        require_once "conexao.php";
        $con = Conexao::getInstance();

        $columns = '';
        $binds = '';

        foreach ($array as $key => $value) {
            $columns .= $key.", ";
            $binds .= ":".$key.", ";

            
        }
        // Retira vírgula do final da string   
        $columns = trim(substr($columns,0, -2));
        $binds = trim(substr($binds,0, - 2)); 

        $sql = "INSERT INTO ".$table." (".$columns.") ";
        $sql .= " VALUES(".$binds.") ";

        $stm = $con->prepare($sql);
        foreach ($array as $key => $value) {
        
            $stm->bindValue(':'.$key, $value);
            
        }
        $stm->execute();
       
        
        $con = null;
        Conexao::disconnect();
        return json_encode(['error'=>'']);
    } catch (PDOException $e) {
        return json_encode(['error'=>$e]);
        die();
    }
}


function update_crud($table, $primary, $id, $array) {
   
    try{
        require_once "conexao.php";
        $con = Conexao::getInstance();
    
        $columns = '';
     
    
        foreach ($array as $key => $value) {
            $columns .= $key." = :".$key.", ";
              
        }
        // Retira vírgula do final da string   
        $columns = trim(substr($columns,0, -2));
       
    
        $sql = "UPDATE ".$table." SET ".$columns." ";
        $sql .= " WHERE ".$primary." = '".$id."' ";
    
        $stm = $con->prepare($sql);
        foreach ($array as $key => $value) {
          
            $stm->bindValue(':'.$key, $value);
              
        }
        $stm->execute();
        
        
        $con = null;
        Conexao::disconnect();
        return json_encode(['error'=>'']);
       
       
    } catch (PDOException $e) {
       return json_encode(['error'=>$e]);
       die();
    } 
}



function delete_crud($table, $key, $value) {
    try{      
        require_once "conexao.php";
        $con = Conexao::getInstance();

        $sql = "DELETE FROM ".$table." WHERE ".$key." = '".$value."'";

        $stm = $con->prepare($sql);
        $stm->execute();
    
        
        $con = null;
        Conexao::disconnect();
        return json_encode(['error'=>'']);

    } catch (PDOException $e) {
        return json_encode(['error'=>$e]);
        die();
    } 
    
}




?>