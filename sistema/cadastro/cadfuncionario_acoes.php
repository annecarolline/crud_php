<?php

$tabela = "cadfuncionario";

$id  = (isset($_POST["id"]))  ? $_POST["id"]  : "";
$acao  = (isset($_POST["acao"])) ? $_POST["acao"]  : "";

$chave_primaria = "idfuncionario";
$salario_minimo = "1320,00";

$nome = (isset($_POST["nome"]) && !empty($_POST["nome"])) ? $_POST["nome"] : "funcionario_".$idfuncionario;
$dtnascimento = (isset($_POST["dtnascimento"]) && !empty($_POST["dtnascimento"])) ? $_POST["dtnascimento"] : null;
$salario = (isset($_POST["salario"]) && !empty($_POST["salario"])) ? $_POST["salario"] : $salario_minimo;
$usuario = (isset($_POST["usuario"]) && !empty($_POST["usuario"])) ? $_POST["usuario"] : "funcionario_".$idfuncionario;
$senha = (isset($_POST["senha"]) && !empty($_POST["senha"])) ? $_POST["senha"] : "123456";
$ativo = (isset($_POST["ativo"]) && !empty($_POST["ativo"])) ? $_POST["ativo"] : "N";

require_once "../../mysql/funcoes_novo.php";
if ($acao == "listar") {
	try {
    
    $dados = select_crud($tabela);
    
    if (count($dados) > 0){
      $dataNasc = date_parse_from_format('Y-m-d H:i:s', $dados[0]["dtnascimento"]); 

      $dados[0]["dtnascimento"] = date('d/m/Y H:i:s',mktime($dataNasc['hour'],$dataNasc['minute'],$dataNasc['second'],$dataNasc['month'],$dataNasc['day'],$dataNasc['year']));
    }
    
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
        $arr = ["nome"=>$nome,"dtnascimento"=>$dtnascimento,"salario"=>$salario,"usuario"=>$usuario,"senha"=>$senha,"ativo"=>$ativo,];
    

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

    $arr = ["nome"=>$nome,"dtnascimento"=>$dtnascimento,"salario"=>$salario,"usuario"=>$usuario,"senha"=>$senha,"ativo"=>$ativo,];
    

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