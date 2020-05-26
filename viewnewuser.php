<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<div class="container">
    <form action="inscription.php" method="post">
        <div class="form-group">
            <label for="Nom">Nom</label>
            <input type="text" class="form-control" id="Nom" name="Nom">
        </div>
        <div class="form-group">
            <label for="Prenom">Prénom</label>
            <input type="text" class="form-control" id="Prenom" name="Prenom">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_conf">Confirmer mot de passe</label>
            <input type="text" class="form-control" id="password_conf" name="password_confirm">
        </div>
        <button type="submit" class="btn btn-primary">Inscription</button>
    </form>
</div>
<?php
include 'connexpdo.php';

$dsn = 'pgsql:host=localhost;port=5432;dbname=conge;';
$user = 'postgres';
$password = 'new_password';
$idcon = connexpdo($dsn, $user, $password);
if ($_POST['Nom'] && $_POST['Prenom'] && $_POST['password'] && $_POST['password_confirm']){
    $id=$_POST['Prenom'][0].$_POST['Nom'];
    echo $id;
    echo $_POST['password'];
    while ($_POST['password_confirm'] != $_POST['password']){
        echo "Erreur veuillez rentrez des mots de passe identiques";
    }
    $result=$idcon->prepare("INSERT INTO inscrits (id, password) VALUES (?,?)");
    $result->execute([$id,$_POST['password']]);
    header('Location:accueil.php');
}

exit();