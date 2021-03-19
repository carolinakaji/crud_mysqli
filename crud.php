<?php

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$stmt = '';
$connection = new mysqli('localhost', 'root', '', 'cadastro');
$resultado = '';

function abrirConexao($connection)
{
  // conexão
  // Verifica se existe erro de conexão, se existir, termina e mostra a mensagem de erro
  if ($connection->connect_error) {
    exit("Erro: {$connection->connect_error}");
  }
  return $connection;
}

// Fechar as conexões
function fecharConexao($stmt, $connection)
{
  if (gettype($stmt) == 'string') {
    $connection->close();
  } else {
    $connection->close();
    $stmt->close();
  }
}

// Delete
function delete($connection, $nome)
{
  $sql = "delete from clientes where nome = ? ";
  abrirConexao($connection)->query($sql);
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('s', $nome);
  $stmt->execute();
}

// Atualizar
function atualizar($connection, $nome, $email)
{
  $sql = "update clientes set email = ? where nome = ? ";
  abrirConexao($connection)->query($sql);
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('ss', $email, $nome);
  $stmt->execute();
}

// Inserir
function inserir($connection, $nome, $email, $cidade, $estado)
{
  $sql = "insert into clientes(nome, email, cidade, estado)
  values(?, ?, ?, ?)";
  abrirConexao($connection)->query($sql);
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('ssss', $nome, $email, $cidade, $estado);
  $stmt->execute();
}


// Ler
function ler($connection, $stmt)
{;
  $tabela = '';
  $sql = "select * from clientes";
  // Fazendo uma query
  $results = abrirConexao($connection)->query($sql);
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
  return $tabela;
}

// validação



// botão salvar 
if (isset($_POST['salvar'])) {
  inserir($connection, $nome, $email, $cidade, $estado);
};

// botão deletar 
if (isset($_POST['deletar'])) {
  delete($connection, $nome);
};

// botão atualizar
if (isset($_POST['editar'])) {
  atualizar($connection, $nome, $email);
}


$resultado = ler($connection, $stmt);
fecharConexao($stmt, $connection);
