var card = document.getElementById("input-card");
card.style.visibility = "hidden";
var fab = document.getElementById("create-button");
var fab_icon = document.getElementById("fab-icon");
fab.addEventListener("click", showCreator);

document.querySelectorAll('.mdc-list-item').forEach(item => {
  item.addEventListener('click', event => {
    document.location.href = "./task.php?id=" + item.id;
  })
})

function showCreator() {
  if (card.style.visibility == "hidden") {
    fab_icon.innerHTML = "clear";
    card.style.visibility = "visible";
  } else {
    fab_icon.innerHTML = "add";
    card.style.visibility = "hidden";
  }
}

var taskcout = document.getElementById("tasksCount");
var compleTasks = document.getElementById("completedTasks");
if (taskcout.innerHTML == "0" || compleTasks.innerHTML == "1") {
  tasklist.style.display = "none";
}

document.addEventListener('DOMContentLoaded', (event) => {
  setTimeout(function(){
    const snackbar = new mdc.snackbar.MDCSnackbar(document.querySelector('.mdc-snackbar'));
    if (document.getElementById("snackmessage").innerHTML != "") {
        snackbar.labelText = document.getElementById("snackmessage").innerHTML;
        snackbar.open();
    }
  }, 2000);
})
