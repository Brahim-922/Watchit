<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);


if(isset($_POST["submitButton"])){
    if(isset($_POST["submitButton"])){

        
        $username = Formsanitizer::sanitizeFormString($_POST["username"]);
    
        $password = Formsanitizer::sanitizeFormString($_POST["password"]);
    
      
    
       $success=$account->login($username, $password);
        if($success){
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }
}
 
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WatchIt</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
</head>
<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
<img src="assets/images/logo.png" alt="logo">
            <h3>Sign In</h3>
            <span>Continuer sur WatchIT</span>
            </div>
            <form method="post">

            <?php echo $account->getError(Constants::$loginFailed) ?>
            <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required>

            <input type="text" name="password" placeholder="Password" required>

            <input type="submit" name="submitButton" value="SUBMIT" >

            </form>
            <a href="register.php" class="signInMessage">Besoin d'un compte? Inscrivez-vous ici!</a>
        </div>
    </div>
</body>
</html>