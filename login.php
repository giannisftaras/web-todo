<?php
session_start();

require_once "./logic/Auth.php";
require_once "./logic/Util.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();

require_once "./logic/authCookieSessionValidate.php";

if ($isLoggedIn) {
    $util->redirect("./");
}

if (! empty($_POST["login"])) {
    $isAuthenticated = false;

    $username = $_POST["member_name"];
    $password = $_POST["member_password"];

    $user = $auth->getMemberByUsername($username);
    if (password_verify($password, $user[0]["member_password"])) {
        $isAuthenticated = true;
    }

    if ($isAuthenticated) {
        $_SESSION["member_id"] = $user[0]["member_id"];

        if (! empty($_POST["remember"])) {
            setcookie("member_login", $username, $cookie_expiration_time, "/");

            $random_password = $util->getToken(16);
            setcookie("random_password", $random_password, $cookie_expiration_time, "/");

            $random_selector = $util->getToken(32);
            setcookie("random_selector", $random_selector, $cookie_expiration_time, "/");

            $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
            $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);

            $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);

            $userToken = $auth->getTokenByUsername($username, 0);
            if (! empty($userToken[0]["id"])) {
                $auth->markAsExpired($userToken[0]["id"]);
            }

            $auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
        } else {
            $util->clearAuthCookie();
        }
        $util->redirect("./");
    } else {
        $message = "Λάθος όνομα ή κωδικός!";
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Σύνδεση</title>
  <link rel="shortcut icon" type="image/png" href="./assets/img/favicon.png"/>
  <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/6.0.0/normalize.min.css">
  <link rel="stylesheet" href="./assets/css/main-theme.css">
  <link rel="stylesheet" href="./assets/css/login.css">
</style>
</head>
    <body>
      <section class="header">
        <svg xmlns="http://www.w3.org/2000/svg" class="login-logo" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M22 19h-6v-4h-2.68c-1.14 2.42-3.6 4-6.32 4-3.86 0-7-3.14-7-7s3.14-7 7-7c2.72 0 5.17 1.58 6.32 4H24v6h-2v4zm-4-2h2v-4h2v-2H11.94l-.23-.67C11.01 8.34 9.11 7 7 7c-2.76 0-5 2.24-5 5s2.24 5 5 5c2.11 0 4.01-1.34 4.71-3.33l.23-.67H18v4zM7 15c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3zm0-4c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1z"/>
        </svg>
        <h1>Συνδεθείτε</h1>
        <div class="error-message mdc-typography"><?php if(isset($message)) { echo $message; } ?></div>
      </section>
      <form id="login-form" action="" method="post">
        <div class="mdc-text-field mdc-text-field--outlined username" data-mdc-auto-init="MDCTextField">
            <input type="text" class="mdc-text-field__input" autocomplete="off" id="username-textfield" name="member_name">
            <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch">
                    <label for="username-textfield" class="mdc-floating-label">Όνομα χρήστη</label>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
        <div class="mdc-text-field mdc-text-field--outlined password" data-mdc-auto-init="MDCTextField">
            <input type="password" class="mdc-text-field__input" id="password-textfield" name="member_password">
            <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__notch">
                    <label for="password-textfield" class="mdc-floating-label">Κωδικός πρόσβασης</label>
                </div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
        <div class="remember-me">
          <div class="mdc-checkbox checkbox-container" data-mdc-auto-init="MDCCheckbox">
            <input type="checkbox" class="mdc-checkbox__native-control" name="remember" id="remember-me-checkbox" checked/>
            <div class="mdc-checkbox__background">
              <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                <path class="mdc-checkbox__checkmark-path"
                      fill="none"
                      d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
              </svg>
              <div class="mdc-checkbox__mixedmark"></div>
            </div>
            <div class="mdc-checkbox__ripple"></div>
            <label for="remember-me-checkbox">Θυμήσου με</label>
          </div>
        </div>
      </form>
      <div class="button-container">
        <button type="submit" form="login-form" name="login" value="login" class="mdc-button mdc-button--raised login-button"><span class="mdc-button__ripple"></span>Συνδεση</button>
      </div>
    </body>
    <script type="text/javascript">
        mdc.autoInit();
    </script>
</html>
