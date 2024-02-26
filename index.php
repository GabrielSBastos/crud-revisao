<?php

require "conexao.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Novo registro criado com sucesso.";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
};

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
    }
};

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["id"];
    
    $sql = "DELETE FROM users WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro excluído com sucesso.";
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
</head>
<body>

<h2>Adicionar Novo Usuário</h2>
<form method="post" action="">
    <label for="name">Nome:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" name="submit" value="Salvar">
</form>

<h2>Lista de Usuários</h2>
<?php $sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nome: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 resultados";
}; ?>

<h2>Atualizar Usuário</h2>
<form method="post" action="">
    <label for="id_update">ID do Usuário:</label><br>
    <input type="text" id="id_update" name="id"><br>
    <label for="name_update">Nome:</label><br>
    <input type="text" id="name_update" name="name"><br>
    <label for="email_update">Email:</label><br>
    <input type="email" id="email_update" name="email"><br><br>
    <input type="submit" name="update" value="Atualizar">
</form>

<h2>Excluir Usuário</h2>
<form method="post" action="">
    <label for="id_delete">ID do Usuário:</label><br>
    <input type="text" id="id_delete" name="id"><br><br>
    <input type="submit" name="delete" value="Excluir">
</form>

</body>
</html>
