<?php
  require "./DBController.php";
  $db_handle = new DBController();
  if (isset($_POST['task-name'])) {
    $task_name = $_POST['task-name'];
    $query = "INSERT INTO todos (member_id, task) VALUES ('1', '$task_name')";
    $result = $db_handle->updateTask($query);
    if ($result == "") {
        header( "Location: ../?task=add-success" );
    } else {
      header( "Location: ../?task=add-fail" );
    }
  }
?>
