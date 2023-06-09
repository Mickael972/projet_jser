<?php

require_once 'bdd/pdo.php';
require_once 'functions/functions.php' ;

// recupération des données post email , pseudo , password//
['email' => $email, 'pseudo' => $pseudo, 'password' => $password] = $_POST;

if (empty($_POST) ||!isset($_POST['email']) ||!isset($_POST['password']) ||!isset($_POST['pseudo'])) {
    echo "<html><body><h1>Missing data</h1></body></html>";
    die();
}

// pour ma requète d'insertion d'utilisateur j'ai eu une erreur de type "parameter number of bound variables" et donc j'ai inséré des paramtres anonymes dans ma query//
$query = "INSERT INTO utilisateurs VALUES(?, ?, ?, ?)";
$stmt = $pdo->prepare($query);


try {
$stmt->execute([
    null,
    $pseudo,
    $email,
    password_hash($password, PASSWORD_DEFAULT)
]);
} catch (PDOException $e) {
    echo "Erreur lors de la création de utilisateurs : " . $e->getcode() . " / " . $e->getMessage();
    exit;
}

redirect('login.php');