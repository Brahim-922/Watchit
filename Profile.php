<?php
require_once("includes/header.php");
require_once("includes/paypalConfig.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/constants.php");
require_once("includes/classes/BillingDetails.php");

$detailsMessage = "";
$passwordMessage = "";
$subscriptionMessage = "";


if(isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    if($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)) {
        $detailsMessage = "<div class='alertSuccess'>
                                Details updated successfully!
                            </div>";
    }else {
        $errorMessage = $account->getFirstError();

        $detailsMessage = "<div class='alertError'>
                                $errorMessage
                            </div>";
    }
}
if(isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)) {
        $passwordMessage = "<div class='alertSuccess'>
                                Mise à jour de votre mot de passe avec succès!
                            </div>";
    }else {
        $errorMessage = $account->getFirstError();

        $passwordMessage = "<div class='alertError'>
                                $errorMessage
                            </div>";
    }
}
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $token = $_GET['token'];
    $agreement = new \PayPal\Api\Agreement();

    $subscriptionMessage = "<div class='alertError'>
                            Something went wrong!
                        </div>";
  
    try {
      // Execute agreement
      $agreement->execute($token, $apiContext);

        $result = BillingDetails::insertDetails($con, $agreement, $token, $userLoggedIn);
        // $result = $result && $user->setIsSubscribed(1);

        if($result) {
            $subscriptionMessage = "<div class='alertSuccess'>
                            Vous etes abonnée !
                        </div>";
        }


    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } 
  else if (isset($_GET['success']) && $_GET['success'] == 'false') {
    $subscriptionMessage = "<div class='alertError'>
    L'utilisateur a annulé ou quelque chose s'est mal passé !
                        </div>";
  }

?>

<div class="settingsContainer column">

<div class="formSection">

<form method="POST">

    <h2>Vos données</h2>
    
    <?php
    $user = new User($con, $userLoggedIn);

    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName();
    $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
    ?>

    <input type="text" name="firstName" placeholder="Prénom" value="<?php echo $firstName; ?>">
    <input type="text" name="lastName" placeholder="Nom" value="<?php echo $lastName; ?>">
    <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">

    <div class="message">
        <?php echo $detailsMessage; ?>
    </div>
    
    <input type="submit" name="saveDetailsButton" value="Save">


</form>


</div>
<div class="formSection">

<form method="POST">
<h2>Mise à jour du mot de passe</h2>
<input type="password" name="oldPassword" placeholder="Mot de passe actuel">
<input type="password" name="newPassword" placeholder="Nouveau mot de passe">
<input type="password" name="newPassword2" placeholder="Confirmer votre mot de passe">

<div class="message">
        <?php echo $passwordMessage; ?>
    </div>

<input type="SUBMIT" name="savePasswordButton" value="Enregistrer">

</form>


</div>

<div class="formSection">
        <h2>Abonnement</h2>

        <div class="message">
            <?php echo $subscriptionMessage; ?>
        </div>

        <?php

        if($user->getIsSubscribed()){

            echo "<h3> Vous etes abonné, veuillez vous rendre sur le site de paypal pour annuler </h3>";

        }else{
          echo"<a href='billing.php'>Abonnez-vous à WATCHIT</a>";

        }
?>


</div>
</div>