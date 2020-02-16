<?php
session_start();
require_once "./logic/authCookieSessionValidate.php";
if(!$isLoggedIn) {
    header("Location: ./login.php");
    exit;
}

$snackmessage = "";
if (isset($_GET['task'])) {
  switch ($_GET['task']) {
    case "delete-success":
        $snackmessage = "Η εργασία διαγράφηκε επιτυχώς";
        break;
    case "delete-fail":
        $snackmessage = "Σφάλμα κατά τη διαγραφή της εργασίας";
        break;
    case "update-success":
        $snackmessage = "Η εργασία ενημερώθηκε επιτυχώς";
        break;
    case "update-fail":
        $snackmessage = "Σφάλμα κατά την ενημέρωση της εργασίας";
        break;
    case "complete-success":
        $snackmessage = "Η εργασία ολοκληρώθηκε επιτυχώς";
        break;
    case "complete-fail":
        $snackmessage = "Σφάλμα κατά την ενημέρωση της εργασίας";
        break;
    case "add-success":
        $snackmessage = "Η εργασία προστέθηκε επιτυχώς";
        break;
    case "add-fail":
        $snackmessage = "Σφάλμα κατά την προσθήκη της εργασίας";
        break;
}
}

?>

<!DOCTYPE html>
<html lang="el">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Εργασίες ToDo</title>
      <link rel="shortcut icon" type="image/png" href="./assets/img/favicon.png"/>
      <link rel="stylesheet" href="https://unpkg.com/material-components-web@3.2.0/dist/material-components-web.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
      <script src="https://unpkg.com/material-components-web@3.2.0/dist/material-components-web.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="./assets/css/main-theme.css">
      <link rel="stylesheet" href="./assets/css/index.css">
      <script async src="./assets/js/index.js"></script>
    </head>
    <body class="main-body">
      <div id="snackmessage" style="display: none;"><?php echo $snackmessage; ?></div>
      <header class="mdc-top-app-bar mdc-top-app-bar--short mdc-top-app-bar--short-collapsed drawer-top-app-bar" data-mdc-auto-init="MDCTopAppBar" id="app-bar">
        <div class="mdc-top-app-bar__row">
          <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
            <button class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Settings" onclick="location.href='./logic/logout.php';">power_settings_new</button>
          </section>
        </div>
      </header>
      <div class="mdc-top-app-bar--fixed-adjust centered">
        <h3 class="mdc-typography--headline3">Εργασίες ToDo</h3>
        <h6 class="mdc-typography--headline6 subtitle">Προσθέστε και διαχειριστείτε τις εργασίες σας!</h6>
      </div>
      <div id="tasklist" class="mdc-card centered">
        <ul class="mdc-list todolist mdc-list--two-line">
          <?php require_once "./logic/todos.php"; ?>
      </div>
      <div id="nolist" class="mdc-card centered <?php if(!$task_count=="0") { echo "blocked"; } ?>">
        <h6 class="mdc-typography--headline6">Δεν έχετε κάποια εργασία!</h6>
        <h6 class="mdc-typography--subtitle1 subtitle">Προσθέστε την πρώτη και οργανώστε τη μέρα σας!</h6>
      </div>
      <div id="completelist" class="mdc-card centered <?php if(!$all_complete=="1") { echo "blocked"; } ?>">
        <img class="prize" src="./assets/img/prize.svg" height="150" width="150">
        <h6 class="mdc-typography--headline6">Συγχαρητήρια!</h6>
        <h6 class="mdc-typography--subtitle1 subtitle">Ολοκληρώσατε όλες σας τις εργασίες!</h6>
      </div>
      <div id="input-card" class="mdc-card centered input-card">
        <form class="addform" id="add-task-form" action="./logic/addtask.php" method="post">
          <div class="mdc-text-field text-field create-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon" data-mdc-auto-init="MDCTextField">
            <input type="text" class="mdc-text-field__input" aria-describedby="text-field-outlined-shape-three-helper-text" name="task-name" autocomplete="off" required>
            <i class="material-icons mdc-text-field__icon">create</i>
            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
              <div class="mdc-notched-outline__leading"></div>
              <div class="mdc-notched-outline__notch" style="">
                <label class="mdc-floating-label" for="text-field-outlined-shape-three" style="">Γράψτε την εργασία σας εδώ...</label>
              </div>
              <div class="mdc-notched-outline__trailing"></div>
            </div>
          </div>
          <button class="mdc-button">  <span class="mdc-button__ripple"></span>Προσθήκη</button>
        </form>
      </div>
      <div id="completedTasks"><?php echo $all_complete; ?></div>
      <div id="tasksCount"><?php echo $task_count; ?></div>
      <button id="create-button" class="mdc-fab app-fab--absolute" aria-label="Δημιουργία εργασίας">
        <div class="mdc-fab__ripple"></div>
        <span id="fab-icon" class="mdc-fab__icon material-icons">add</span>
      </button>
      <div class="mdc-snackbar" data-mdc-auto-init="MDCSnackbar">
        <div class="mdc-snackbar__surface">
          <div class="mdc-snackbar__label" role="status" aria-live="polite">Εργασίες</div>
          <div class="mdc-snackbar__actions">
            <button class="mdc-icon-button mdc-snackbar__dismiss material-icons" title="Κλείσιμο">close</button>
          </div>
        </div>
      </div>
    </body>
    <script type="text/javascript">
      window.mdc.autoInit();
    </script>
</html>
