<?php

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$stmt = '';
$resultado = '';

function abrirConexao()
{
  // conexão
  $connection = new mysqli('localhost', 'root', '', 'cadastro');
  // Verifica se existe erro de conexão, se existir, termina e mostra a mensagem de erro
  if ($connection->connect_error) {
    exit("Erro: {$connection->connect_error}");
  }
  return $connection;
}

// Fechar as conexões
function fecharConexao()
{
  abrirConexao()->close();
}

// Delete
function delete($nome)
{
  $sql = "delete from clientes where nome = ? ";
  $var = abrirConexao();
  $stmt =   $var->prepare($sql);
  $stmt->bind_param('s', $nome);
  $stmt->execute();
  $stmt->close();
  fecharConexao();
}

// Atualizar
function atualizar($nome, $email)
{
  $sql = "update clientes set email = ? where nome = ? ";
  $var = abrirConexao();
  $stmt =   $var->prepare($sql);
  $stmt->bind_param('ss', $email, $nome);
  $stmt->execute();
  $stmt->close();
  fecharConexao();
}

// Inserir
function inserir($nome, $email, $cidade, $estado)
{
  $sql = "insert into clientes(nome, email, cidade, estado)
  values(?, ?, ?, ?)";
  $var = abrirConexao();
  $stmt =   $var->prepare($sql);
  $stmt->bind_param('ssss', $nome, $email, $cidade, $estado);
  $stmt->execute();
  $stmt->close();
  fecharConexao();
}


// Ler
function ler()
{
  $tabela = '';
  $sql = "select * from clientes";
  // Fazendo uma query
  $results = abrirConexao()->query($sql);
  // Verificar se existe algum registro na tabela (linha).
  if ($results->num_rows) {
    while ($cliente = $results->fetch_object()) {
      $tabela .= "<tr><td>{$cliente->id}</td>
                  <td>{$cliente->nome}</td>
                  <td>{$cliente->email}</td>
                  <td>{$cliente->cidade}</td>
                  <td>{$cliente->estado}</td></tr>";
    }
  } else {
    $tabela = "Nenhum cliente encontrado";
  }
  fecharConexao();
  return $tabela;
}

// botão salvar 
if (isset($_POST['salvar'])) {
  inserir($nome, $email, $cidade, $estado);
};

// botão deletar 
if (isset($_POST['deletar'])) {
  delete($nome);
};

// botão atualizar
if (isset($_POST['editar'])) {
  atualizar($nome, $email);
}


$resultado = ler();
