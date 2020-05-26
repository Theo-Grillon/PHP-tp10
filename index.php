<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<div class="container">
    <form action="accueil.php" method="post">
        <div class="form-group">
            <label for="id">Identifiant</label>
            <input type="text" class="form-control" id="id" name="id">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>
<?php
include 'connexpdo.php';

$dsn = 'pgsql:host=localhost;port=5432;dbname=conge;';
$user = 'postgres';
$password = 'new_password';
$idcon = connexpdo($dsn, $user, $password);
$searchedId=$_POST['id'];
$pwd=$_POST['password'];
$res1=$idcon->prepare("SELECT count(*) as nbUsers from inscrits where id=? and password=?");
$res1->execute([$searchedId, $pwd]);
$res=$res1->fetch();
if ($_POST['id'] || $_POST['password']) {
    if ($res[0] > 0) {
        function getName(){return $_POST['id'];}
        header("Location:conges.php");
    }
    else {
        header("Location:inscription.php");
    }
}