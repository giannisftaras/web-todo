<?php
session_start();
require_once "./logic/authCookieSessionValidate.php";
if(!$isLoggedIn) {
    header("Location: ./login.php");
    exit;
}

require "./logic/singletodo.php";

?>

<!DOCTYPE html>
<html lang="el">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Επεξεργασία ToDo</title>
      <link rel="shortcut icon" type="image/png" href="./assets/img/favicon.png"/>
      <link rel="stylesheet" href="https://unpkg.com/material-components-web@3.2.0/dist/material-components-web.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
      <script src="https://unpkg.com/material-components-web@3.2.0/dist/material-components-web.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="./assets/css/main-theme.css">
      <link rel="stylesheet" href="./assets/css/task.css">
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="main-body">
      <header class="mdc-top-app-bar mdc-top-app-bar--short mdc-top-app-bar--short-collapsed drawer-top-app-bar" data-mdc-auto-init="MDCTopAppBar" id="app-bar">
        <div class="mdc-top-app-bar__row">
          <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
            <button class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Settings" onclick="location.href='./';">arrow_back</button>
          </section>
        </div>
      </header>
      <div style="display: none;" id="task-id"><?php echo $todoist[0]['id']; ?></div>
      <div class="mdc-top-app-bar--fixed-adjust centered">
        <div class="mdc-card inputs-card">
          <div class="mdc-text-field text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
            <input type="text" id="task-text-field-outlined" class="mdc-text-field__input" aria-describedby="text-field-outlined-helper-text" value="<?php echo $todoist[0]['task']; ?>">
            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
              <div class="mdc-notched-outline__leading"></div>
              <div class="mdc-notched-outline__notch" style="">
                <label class="mdc-floating-label" for="task-text-field-outlined" style="">Τίτλος</label>
              </div>
              <div class="mdc-notched-outline__trailing"></div>
            </div>
          </div>
          <div class="mdc-text-field text-field mdc-text-field--outlined" data-mdc-auto-init="MDCTextField">
            <input type="text" id="notes-text-field-outlined" class="mdc-text-field__input" aria-describedby="text-field-outlined-helper-text" value="<?php echo $todoist[0]['notes']; ?>">
            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
              <div class="mdc-notched-outline__leading"></div>
              <div class="mdc-notched-outline__notch" style="">
                <label class="mdc-floating-label" for="notes-text-field-outlined" style="">Σημειώσεις</label>
              </div>
              <div class="mdc-notched-outline__trailing"></div>
            </div>
          </div>
          <div>
            <h6 class="mdc-typography--subtitle1 duedate">Ημερομηνία προθεσμίας</h6>
            <input id="datepicker" width="276" value="<?php if ($new_date !== "000") { echo $new_date; } ?>"/>
          </div>
          <div class="button-container">
            <button class="mdc-button mdc-button--accent" onclick="location.href='./';"><span class="mdc-button__ripple"></span>Ακύρωση</button>
            <button class="mdc-button mdc-button--raised <?php echo $complete; ?>" onclick="updateTask()"><span class="mdc-button__ripple"></span>Αποθήκευση</button>
          </div>
        </div>
        <div class="mdc-card actions-card <?php echo $complete; ?>">
          <p style="text-align: center;">Διαγραφή ή ολοκλήρωση εργασίας</p>
          <div class="fab-container">
            <button onclick="deleteTask()" class="mdc-fab delete-task" aria-label="Favorite">
              <div class="mdc-fab__ripple"></div>
              <span class="mdc-fab__icon material-icons">delete</span>
            </button>
            <button onclick="completeTask()" class="mdc-fab complete-task" aria-label="Favorite">
              <div class="mdc-fab__ripple"></div>
              <span class="mdc-fab__icon material-icons">done</span>
            </button>
          </div>

        </div>
      </div>
    </body>
    <script type="text/javascript">
      window.mdc.autoInit();
      $('#datepicker').datepicker({
            showOtherMonths: true,
            format: 'dd-mm-yyyy'
        });
    </script>
    <script async src="./assets/js/task.js"></script>
</html>
