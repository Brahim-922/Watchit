<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/constants.php");
require_once("includes/classes/Account.php");


$account = new Account($con);

if(isset($_POST["submitButton"])){

    $firstName = Formsanitizer::sanitizeFormString($_POST["firstName"]);

    $lastName = Formsanitizer::sanitizeFormString($_POST["lastName"]);

    $username = Formsanitizer::sanitizeFormString($_POST["username"]);

    $email = Formsanitizer::sanitizeFormString($_POST["email"]);

    $email2 = Formsanitizer::sanitizeFormString($_POST["email2"]);

    $password = Formsanitizer::sanitizeFormString($_POST["password"]);

    $password2 = Formsanitizer::sanitizeFormString($_POST["password2"]);

   $success=$account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
    if($success){
        header("Location: index.php");
    }
}
function getInputValue($name) {
    if(isset($_POST[$name])) {
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
            <h3>Sign Up</h3>
            <span>Continuer sur WatchIT</span>
            </div>
            <form method="post">
            <?php echo $account->getError(Constants::$firstNameCharacteres) ?>

            <input type="text" name="firstName" placeholder="Prénom" value="<?php getInputValue("firstName"); ?>" required>

            <?php echo $account->getError(Constants::$lastNameCharacteres) ?>
            <input type="text" name="lastName" placeholder="Nom" value="<?php getInputValue("lastName"); ?>" required>

            <?php echo $account->getError(Constants::$usernameCharacteres) ?>
            <?php echo $account->getError(Constants::$usernameTaken) ?>
            <input type="text" name="username" placeholder="Username"  value="<?php getInputValue("username"); ?>"required>

            <?php echo $account->getError(Constants::$emailsDontMatch) ?>
            <?php echo $account->getError(Constants::$emailInvalide) ?>
            <?php echo $account->getError(Constants::$emailTaken) ?>
            <input type="text" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>

            <input type="text" name="email2" placeholder="Confirm email" value="<?php getInputValue("email2"); ?>" required>


            <?php echo $account->getError(constants::$passwordsDontMatch) ?>
            <?php echo $account->getError(constants::$passwordLength) ?>
            <input type="text" name="password" placeholder="Password" required>

            <input type="text" name="password2" placeholder="Confirmer votre mot de passe" required>

            <input type="submit" name="submitButton" value="SUBMIT" >

            </form>
            <a href="login.php" class="signInMessage">Avez-vous un compte? Connectez-vous ici!</a>
        </div>
    </div>
</body>
</html>