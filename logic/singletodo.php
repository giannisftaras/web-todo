<?php
$db_handle = new DBController();
$todo_db = "todos";
$complete = "";
$todo_id = str_replace("todoli", "", $_GET['id']);
$query = "Select * from todos where id = ?";
$todoist = $db_handle->runQuery($query, 's', array($todo_id));
if ($todoist[0]['due'] == "0000-00-00") {
  $new_date = "000";
} else {
  $new_date = date("d-m-Y", strtotime($todoist[0]['due']));
}
if ($todoist[0]['complete'] == "1") {
  $complete = "donetask";
}
?>
