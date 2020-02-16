function deleteTask() {
  var taskid = document.getElementById("task-id").innerHTML;
  document.location.href = "./logic/updatetask.php?id=" + taskid + "&task=delete";
}

function updateTask() {
  var taskid = document.getElementById("task-id").innerHTML;
  var taskname = document.getElementById("task-text-field-outlined").value;
  var tasknote = document.getElementById("notes-text-field-outlined").value;
  var datet = document.getElementById("datepicker").value;
  // console.log("./logic/updatetask.php?id=" + taskid + "&task=update" + "&name=" + taskname + "&notes=" + tasknote + "&due=" + datet)
  document.location.href = "./logic/updatetask.php?id=" + taskid + "&task=update" + "&name=" + taskname + "&notes=" + tasknote + "&due=" + datet;
}

function completeTask() {
  var taskid = document.getElementById("task-id").innerHTML;
  document.location.href = "./logic/updatetask.php?id=" + taskid + "&task=complete";
}
