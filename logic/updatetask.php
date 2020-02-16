<?php
require "./DBController.php";
$db_handle = new DBController();
$task = $_GET['task'];
$due = $_GET['due'];
$notes = $_GET['notes'];
$name = $_GET['name'];
$todo_id = str_replace("todoli", "", $_GET['id']);

if ($task == "update") {
  if ($due !== "") {
    $sql_date = date("Y-m-d", strtotime($due));
    $query = "UPDATE todos SET due='$sql_date', notes='$notes',  task='$name'  WHERE id = $todo_id";
  } else {
    $query = "UPDATE todos SET notes='$notes',  task='$name'  WHERE id = $todo_id";
  }
  $result = $db_handle->updateTask($query);
  if ($result == "") {
      header( "Location: ../?task=update-success" );
  } else {
    header( "Location: ../?task=update-fail" );
  }
} elseif ($task == "delete") {
  $result = $db_handle->delete("DELETE FROM todos WHERE id = $todo_id");
  if ($result == "") {
      header( "Location: ../?task=delete-success" );
  } else {
    header( "Location: ../?task=delete-fail" );
  }
} elseif ($task == "complete") {
  $query = "UPDATE todos SET complete=1  WHERE id = $todo_id";
  $result = $db_handle->updateTask($query);
  echo "RESULT: " . $result;
  if ($result == "") {
      header( "Location: ../?task=complete-success" );
  } else {
    header( "Location: ../?task=complete-fail" );
  }
} else {
  exit;
}

?>
