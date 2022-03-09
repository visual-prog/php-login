<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registireren</title>
</head>
<body>

    <?php

if(isset($_POST["submit"])){


require("mysql.php");

$stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //username überprüfen
$stmt->bindParam(":user",$_POST["username"]);
$stmt->execute();
$count = $stmt->rowCount();
if($count == 0){

if($_POST["pw"] == $_POST["pw2"]){


$stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD) VALUES (:user, :pw)");
$stmt->bindParam(":user",$_POST["username"]);

$hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);

$stmt->bindParam(":pw", $hash);

$stmt->execute();

echo "Dein Account wurde angelegt";

} else {

echo "Die Passwörter stimmen nicht überein";

}
} else {
 

echo "Der Username ist bereits vergeben";

}


}


    ?>



    <h1>Account erstellen</h1>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required> <br>
        <input type="password" name="pw" placeholder="Passswort" required> <br>
        <input type="password" name="pw2" placeholder="Passwort wiederholen" required> <br>
        <button type="submit" name="submit">Erstellen</button>
    </form>
    <br>
    <a href="index.php">Hast du bereites einen Account?</a>


</body>
</html>