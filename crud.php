<?php
// Aula 10
// conexão
$connection = new mysqli('localhost', 'root', '', 'cadastro');

// Verifica se existe erro de conexão, se existir, termina e mostra a mensagem de erro
if ($connection->connect_error) {
  exit("Erro: {$connection->connect_error}");
}

// Delete
function delete($connection)
{
  $sql = "delete from clientes where nome = 'Ana Paula'";
  $connection->query($sql);
}

// Atualizar
function atualizar($connection, $nome)
{
  $sql = "update clientes set nome = 'Fernando da Silva' where id='1'";
  $connection->query($sql);
}


// Inserir
function inserir($connection, $nome, $email, $cidade, $estado)
{

  $sql = "insert into clientes(nome, email, cidade, estado)
  values('Ana Paula', 'ana@gmail.com', 'Jandira', 'SP')";
  $connection->query($sql);
}


// Ler
function ler($connection, $nome, $email, $cidade, $estado)
{

  $sql = "select * from clientes where nome = ? ";
  // prepara para string para a conexão
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('s', $nome);
  $stmt->execute();
  // traz o resultado como objeto
  $result = $stmt->get_result()->fetch_object();
  if ($result) {
    echo '<pre>';
    var_dump($result);
    echo '<pre>';
  } else {
    echo 'Cliente não encontrado';
  }
}
// Fechar as conexões
$stmt->close();
$connection->close();


//botão salvar 
if (isset($_POST['salvar'])) {
}
// Exibe tabela

// $result .= "<tr>
//                 <td>{$}</td>
//             <tr>"
