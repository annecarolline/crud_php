<?php

$tabela = "cadreserva";

$id  = (isset($_POST["id"]))  ? $_POST["id"]  : "";
$acao  = (isset($_POST["acao"])) ? $_POST["acao"]  : "";
$idServico  = (isset($_POST["idServico"]))  ? $_POST["idServico"]  : "";
$acaoServico  = (isset($_POST["acaoServico"])) ? $_POST["acaoServico"]  : "";

$chave_primaria = "id_reserva";

// campos de cadreserva
$nome_passageiro = (isset($_POST["nome_passageiro"]) && !empty($_POST["nome_passageiro"])) ? $_POST["nome_passageiro"] : "reserva_".$id_reserva;

$telefone = (isset($_POST["telefone"]) && !empty($_POST["telefone"])) ? $_POST["telefone"] : "";
$email = (isset($_POST["email"]) && !empty($_POST["email"])) ? $_POST["email"] : "";
$id_tipovenda = (isset($_POST["id_tipovenda"]) && !empty($_POST["id_tipovenda"])) ? $_POST["id_tipovenda"] : null;
$id_operador = (isset($_POST["id_operador"]) && !empty($_POST["id_operador"])) ? $_POST["id_operador"] : null;
$id_origem = (isset($_POST["id_origem"]) && !empty($_POST["id_origem"])) ? $_POST["id_origem"] : null;

$qtde_pessoas = (isset($_POST["qtde_pessoas"]) && !empty($_POST["qtde_pessoas"])) ? $_POST["qtde_pessoas"] : 0;
$qtde_adt = (isset($_POST["qtde_adt"]) && !empty($_POST["qtde_adt"])) ? $_POST["qtde_adt"] : 0;
$qtde_chd = (isset($_POST["qtde_chd"]) && !empty($_POST["qtde_chd"])) ? $_POST["qtde_chd"] : 0;
$qtde_free = (isset($_POST["qtde_free"]) && !empty($_POST["qtde_free"])) ? $_POST["qtde_free"] : 0;

$observacao = (isset($_POST["observacao"]) && !empty($_POST["observacao"])) ? $_POST["observacao"] : "";


// campos de cadservico

$id_reserva = (isset($_POST["id_reserva"]) && !empty($_POST["id_reserva"])) ? $_POST["id_reserva"] : null;
$id_tiposervico = (isset($_POST["id_tiposervico"]) && !empty($_POST["id_tiposervico"])) ? $_POST["id_tiposervico"] : null;
$dt_servico = (isset($_POST["dt_servico"]) && !empty($_POST["dt_servico"])) ? $_POST["dt_servico"] : null;
$hr_servico = (isset($_POST["hr_servico"]) && !empty($_POST["hr_servico"])) ? $_POST["hr_servico"] : null;
$tipo = (isset($_POST["tipo"]) && !empty($_POST["tipo"])) ? $_POST["tipo"] : null;
$id_aeroporto = (isset($_POST["id_aeroporto"]) && !empty($_POST["id_aeroporto"])) ? $_POST["id_aeroporto"] : null;
$nro_voo = (isset($_POST["nro_voo"]) && !empty($_POST["nro_voo"])) ? $_POST["nro_voo"] : "";
$dt_voo = (isset($_POST["dt_voo"]) && !empty($_POST["dt_voo"])) ? $_POST["dt_voo"] : null;
$hr_voo = (isset($_POST["hr_voo"]) && !empty($_POST["hr_voo"])) ? $_POST["hr_voo"] : null;
$observacao_voo = (isset($_POST["observacao_voo"]) && !empty($_POST["observacao_voo"])) ? $_POST["observacao_voo"] : "";
$id_hotel = (isset($_POST["id_hotel"]) && !empty($_POST["id_hotel"])) ? $_POST["id_hotel"] : null;
$observacao_hotel = (isset($_POST["observacao_hotel"]) && !empty($_POST["observacao_hotel"])) ? $_POST["observacao_hotel"] : "";

if (isset($_POST["valor_servico"]) && !empty($_POST["valor_servico"])){
    $valor_servico =  str_replace(",", ".", str_replace(".","",$_POST["valor_servico"]));
}
else{
    $valor_servico = 0; 
}

if (isset($_POST["valor_adicional"]) && !empty($_POST["valor_adicional"])){
    $valor_adicional =  str_replace(",", ".", str_replace(".","",$_POST["valor_adicional"]));
}
else{
    $valor_adicional = 0; 
} 


require_once "../../mysql/funcoes_novo.php";
require_once "../../mysql/funcoes.php";

if ($acao == "listar") {
	try {
    
    $tabela = "cadreserva r left join tipovenda tv on (r.id_tipovenda = tv.id_tipovenda)";

    $dados = select_crud($tabela);
    
        echo json_encode(["data"=>$dados]);
	} catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
	}
};

if ($acao == "listarOperador") {
  try {
    $dados = select_crud("operador");

        echo json_encode($dados);
  } catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
  }
};

if ($acao == "listarTipoVenda") {
  try {
    $dados = select_crud("tipovenda");

        echo json_encode($dados);
  } catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
  }
};

if ($acao == "listarOrigem") {
  try {
    $dados = select_crud("origem");

        echo json_encode($dados);
  } catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
  }
};

if ($acao == "listarTipoServico") {
  try {
    $dados = select_crud("tiposervico");

        echo json_encode($dados);
  } catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
  }
};

if ($acao == "listarAeroporto") {
  try {
    $dados = select_crud("aeroporto");

        echo json_encode($dados);
  } catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
  }
};

if ($acao == "listarHotel") {
  try {
    $dados = select_crud("hotel");

        echo json_encode($dados);
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
        $arr = ["nome_passageiro"=>$nome_passageiro,"telefone"=>$telefone,"email"=>$email,"id_tipovenda"=>$id_tipovenda,"id_operador"=>$id_operador, "id_origem"=>$id_origem,"qtde_pessoas"=>$qtde_pessoas,"qtde_adt"=>$qtde_adt,"qtde_chd"=>$qtde_chd,"qtde_free"=>$qtde_free,"observacao"=>$observacao,];
    

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

    $arr = ["nome_passageiro"=>$nome_passageiro,"telefone"=>$telefone,"email"=>$email,"id_tipovenda"=>$id_tipovenda,"id_operador"=>$id_operador,"id_origem"=>$id_origem,"qtde_pessoas"=>$qtde_pessoas,"qtde_adt"=>$qtde_adt,"qtde_chd"=>$qtde_chd,"qtde_free"=>$qtde_free,"observacao"=>$observacao,];
    

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

if ($acaoServico == "listar") {
  try {
    
    $tabela = "cadservico s left join tiposervico ts on (ts.id_tiposervico = s.id_tiposervico) left join aeroporto a on (a.id_aeroporto = s.id_aeroporto) left join hotel h on (h.id_hotel = s.id_hotel)";

    $tabela.= (isset($id_reserva) and !empty($id_reserva)) ? " where s.id_reserva = ".$id_reserva : "";

    $dados = select_crud($tabela);

    if (count($dados) > 0){
        $dataServ = date_parse_from_format('Y-m-d', $dados[0]["dt_servico"]); 

        $dados[0]["dt_lancamento"] = date('d/m/Y',mktime(0,0,0,$dataServ['month'],$dataServ['day'],$dataServ['year']));

        $dataVoo = date_parse_from_format('Y-m-d', $dados[0]["dt_voo"]); 

        $dados[0]["dt_voo"] = date('d/m/Y',mktime(0,0,0,$dataVoo['month'],$dataVoo['day'],$dataVoo['year']));
    }
    
        echo json_encode(["data"=>$dados]);
  } catch (PDOException $e) {
        echo json_encode(["error"=> $e]);
        die();
  }
};

if ($acaoServico == "editar") {
  $tabela = "cadservico";
  $chave_primaria = "id_servico";

  try {

    $dados = select_one_crud($tabela, $chave_primaria, $idServico); 

    echo json_encode(["data"=>$dados]);
  } catch (PDOException $e) {
    echo json_encode(["error"=> $e]);
    die();
  }
};

// INCLUSAO
if ($idServico == 0 || $acaoServico == "inserir") {

  $tabela = "cadservico";

  try {
        $arr = [
        "id_reserva"=>$id_reserva,
        "id_tiposervico"=>$id_tiposervico,
        "dt_servico"=>$dt_servico,
        "hr_servico"=>$hr_servico,
        "tipo"=>$tipo,
        "id_aeroporto"=>$id_aeroporto,
        "nro_voo"=>$nro_voo,
        "dt_voo"=>$dt_voo,
        "hr_voo"=>$hr_voo,
        "observacao_voo"=>$observacao_voo,
        "id_hotel"=>$id_hotel,
        "observacao_hotel"=>$observacao_hotel,
        "valor_servico"=>$valor_servico,
        "valor_adicional"=>$valor_adicional,
      ];
    
    $result = insert_crud($tabela, $arr);

    $sql = "update cadreserva set valor_total = (select (sum(valor_servico)+sum(valor_adicional)) from cadservico where id_reserva =".$id_reserva.") where id_reserva = ".$id_reserva;
    $retornoUpdate = update($sql);

    echo $result;
    die();
  } catch (PDOException $e) {
      echo json_encode(["error"=> $e]);
      die();
  }
};

// ALTERACAO
if ($acaoServico == "update") {
  $tabela = "cadservico";
  $chave_primaria = "id_servico";

  try {

    $arr = [
        "id_reserva"=>$id_reserva,
        "id_tiposervico"=>$id_tiposervico,
        "dt_servico"=>$dt_servico,
        "hr_servico"=>$hr_servico,
        "tipo"=>$tipo,
        "id_aeroporto"=>$id_aeroporto,
        "nro_voo"=>$nro_voo,
        "dt_voo"=>$dt_voo,
        "hr_voo"=>$hr_voo,
        "observacao_voo"=>$observacao_voo,
        "id_hotel"=>$id_hotel,
        "observacao_hotel"=>$observacao_hotel,
        "valor_servico"=>$valor_servico,
        "valor_adicional"=>$valor_adicional,
      ];
    
    $result = update_crud($tabela, $chave_primaria, $idServico, $arr);
    echo $result;

    $sql = "update cadreserva set valor_total = (select (sum(valor_servico)+sum(valor_adicional)) from cadservico where id_reserva =".$id_reserva.") where id_reserva = ".$id_reserva;
    $retornoUpdate = update($sql);

    die();
  } catch (PDOException $e) { 
    echo json_encode(["error"=> $e]);
    die();
  }  
};


if ($acaoServico == "excluir") {
  $tabela = "cadservico";
  $chave_primaria = "id_servico";

  try {
    $result = delete_crud($tabela, $chave_primaria, $idServico);

    echo $result;
    die();

  } catch (PDOException $e) {
    echo json_encode(["error"=> $e]);
    die(); 
  } 
}; 






?>