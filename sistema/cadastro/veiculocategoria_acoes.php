<?php

$tabela = "veiculo_categoria";


$id  = (isset($_POST["id"]))  ? $_POST["id"]  : "";
$acao  = (isset($_POST["acao"])) ? $_POST["acao"]  : "";

$chave_primaria = "id_categoria";

$descricao = (isset($_POST["descricao"]) && !empty($_POST["descricao"])) ? $_POST["descricao"] : null;
$ativo = (isset($_POST["ativo"]) && !empty($_POST["ativo"])) ? $_POST["ativo"] : "N";

require_once "../../mysql/funcoes_novo.php";
if ($acao == "listar") {
	try {
    
    $dados = select_crud($tabela);

        echo json_encode(["data"=>$dados]);
	} catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
	}
};

if ($acao == "editar") {
	try {

    $dados = select_one_crud($tabela, $chave_primaria, $id);

    echo json_encode(["data"=>$dados]);
	} catch (PDOException $e) {
    echo json_encode(["error"=> $e]);
    die();
	}
};


// INCLUSAO
if ($id == 0 || $acao == "inserir") {
	try {
        $arr = ["descricao"=>$descricao,"ativo"=>$ativo,];
    

    $result = insert_crud($tabela, $arr);
    echo $result;
    die();
	} catch (PDOException $e) {
      echo json_encode(["error"=> $e]);
      die();
	}
};


// ALTERACAO
if ($acao == "update") {
  try {

    $arr = ["descricao"=>$descricao,"ativo"=>$ativo,];
    

    $result = update_crud($tabela, $chave_primaria, $id, $arr);
    echo $result;
    die();
  } catch (PDOException $e) { 
    echo json_encode(["error"=> $e]);
    die();
  }  
};


if ($acao == "excluir") {

	try {
   
    $result = delete_crud($tabela, $chave_primaria, $id);

    echo $result;
    die();

	} catch (PDOException $e) {
    echo json_encode(["error"=> $e]);
    die();
    
	}
  
}; 



?>