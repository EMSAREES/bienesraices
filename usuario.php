<?php
// importar la conexion
    require 'include/config/database.php';
    $db = conectarDB();

// crear un email y password
    $email = "correo@gmail.com";
    $password = "123456";

    $passwordHadh = password_hash($password, PASSWORD_DEFAULT);

//  queary para crear el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHadh');";

// agregarlo a la base de dato
    mysqli_query($db, $query);