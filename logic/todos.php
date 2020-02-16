<?php
$db_handle = new DBController();
$todo_db = "todos";
$query = "Select * from todos where member_id = ?";
$todoist = $db_handle->runQuery($query, 's', array("1"));
$task_count = 0;
$all_complete = 1;
if (!empty($todoist)) {
  foreach ($todoist as &$totask): ?>
    <?php
    if($totask['complete'] == "0") {
      $all_complete = 0;
    }
    $task_count += 1;
    ?>
    <li id="todoli<?php echo $totask['id']; ?>" class="mdc-list-item">
      <?php if ($totask['complete'] == "1") {
        echo '<span class="mdc-list-item__graphic material-icons donetask" aria-hidden="true">done</span>';
      } else {
        if ($totask['due'] !== "0000-00-00") {
          echo '<span class="mdc-list-item__graphic material-icons duetask" aria-hidden="true">alarm</span>';
        } else {
          echo '<span class="mdc-list-item__graphic material-icons" aria-hidden="true">trending_flat</span>';
        }
      } ?>
      <span class="mdc-list-item__text">
        <span class="mdc-list-item__primary-text"><?php echo $totask['task']; ?></span>
        <?php if ($totask['notes'] == "") {
          echo '<span class="mdc-list-item__secondary-text no-comment">Χωρίς σημείωση</span>';
        } else {
          echo '<span class="mdc-list-item__secondary-text">' . $totask["notes"] . '</span>';
        } ?>
      </span>
      <span class="mdc-list-item__meta material-icons" aria-hidden="true">info</span>
    </li>
  <?php endforeach; ?>
<?php } else {
  $all_complete = 0;
}
?>
