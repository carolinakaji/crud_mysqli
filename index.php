<?php include './crud.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <title>CRUD com MySQLi</title>
</head>

<body>
  <main class="container">
    <h2 class="center">Cadastro de Clientes</h2>
    <form action="index.php" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Digite seu nome" id="nome" type="text" class="validate" name="nome">
          <label for="nome">Nome</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Digite seu e-mail" id="email" type="email" class="validate" name="email">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <input placeholder="Digite sua cidade" id="nome" type="text" class="validate" name="cidade">
          <label for="nome">Cidade</label>
        </div>
        <div class="input-field col s4">
          <input placeholder="Digite seu estado" id="nome" type="text" class="validate" name="estado">
          <label for="nome">Estado</label>
        </div>
      </div>
      <div class="row">
        <button class="waves-effect waves-light btn" name="salvar"><i class="material-icons right">save</i>Salvar</button>
        <button class="waves-effect waves-light btn amber" name="editar"><i class="material-icons right">edit</i>Editar</button>
        <button class="waves-effect waves-light btn red darken-1" name="deletar"><i class="material-icons right">delete</i>Deletar</button>
      </div>
    </form>

    <div>
      <table class="striped">
        <thead class="grey lighten-1">
          <th>ID</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Cidade</th>
          <th>Estado</th>
        </thead>
        <?php echo $resultado ?>
      </table>
    </div>
  </main>
</body>

</html>