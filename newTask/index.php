<?php
include "db.php";  
if (isset($_GET['fetch'])) {
    $result = $conn->query("SELECT * FROM list ORDER BY id DESC");
    $list = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }
    echo json_encode($list);
    exit;
}


if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM list WHERE id=$id");
    echo "success";
    exit;
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $time = $_POST['time'];

    $conn->query("UPDATE list SET title='$title', description='$description', time='$time' WHERE id=$id");
    echo "success";
    exit;
}
?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TO-DO List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
   
    .container {
      text-align: center;
    }

    
    #editFormPopup {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(3px);
      padding-top: 80px;
      animation: fadeIn 0.3s ease;
    }

   
    .form-content {
      background-color: #ffffff;
      margin: auto;
      padding: 25px;
      border-radius: 12px;
      width: 90%;
      max-width: 450px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
      animation: popupScale 0.3s ease;
    }

    .close {
      float: right;
      font-size: 30px;
      cursor: pointer;
      color: #555;
    }

    .close:hover {
      color: red;
    }

    .form-content input {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .form-content button {
      width: 100%;
      padding: 12px;
      background-color: #0d6efd;
      color: white;
      border: none;
      border-radius: 6px;
    }

  
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes popupScale {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>

</head>

<body style="background-color: aliceblue;">
  <div class="container">
    <a href="add.php" class="btn btn-success mt-3">Add New TO-DO List</a>

    <h1 class="mt-3">My Daily TO - DO List</h1>

    <ul id="taskList" class="list-group mt-3"></ul>

    <div id="pagination" class="mt-3"></div>
  </div>


  <div id="editFormPopup">
    <div class="form-content">
      <span class="close" onclick="closeFormPopup()">&times;</span>
      <h2>Edit Task</h2>

      <input type="hidden" id="editTaskIndex">

      <label>Title:</label>
      <input type="text" id="editTitle">

      <label>Description:</label>
      <input type="text" id="editDescription">

      <label>Time:</label>
      <input type="text" id="editTime">

      <button onclick="saveEditedTask()">Save Changes</button>
    </div>
  </div>

  <script>
    const ITEMS_PER_PAGE = 5;
    let currentPage = 1;

    function displayTasks(page = 1) {
      const taskList = document.getElementById("taskList");
      taskList.innerHTML = "";

      const tasks = JSON.parse(localStorage.getItem("tasks")) || [];

      const start = (page - 1) * ITEMS_PER_PAGE;
      const end = start + ITEMS_PER_PAGE;
      const pageTasks = tasks.slice(start, end);

      pageTasks.forEach((task, index) => {
        const realIndex = start + index;

        const li = document.createElement("li");
        li.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");

        li.innerHTML = `
          <div>
            <strong>${task.title}</strong>
            <p>${task.description}</p>
            <span class="badge bg-info text-dark">${task.time}</span>
          </div>
          <div>
            <button class="btn btn-warning btn-sm me-2" onclick="editTask(${realIndex})">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="confirmRemove(${realIndex})">Remove</button>
          </div>
        `;

        taskList.appendChild(li);
      });

      createPaginationButtons(tasks.length);
    }

   
    function confirmRemove(index) {
      if (confirm("Are you sure you want to remove this task?")) {
        removeTask(index);
      }
    }

    
    function removeTask(index) {
      let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
      tasks.splice(index, 1);
      localStorage.setItem("tasks", JSON.stringify(tasks));

      displayTasks(currentPage);
    }

  
    function editTask(index) {
      const tasks = JSON.parse(localStorage.getItem("tasks")) || [];
      const task = tasks[index];

      document.getElementById("editTaskIndex").value = index;
      document.getElementById("editTitle").value = task.title;
      document.getElementById("editDescription").value = task.description;
      document.getElementById("editTime").value = task.time;

      document.getElementById("editFormPopup").style.display = "block";
    }

  
    function saveEditedTask() {
      const index = document.getElementById("editTaskIndex").value;
      let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

      tasks[index] = {
        title: document.getElementById("editTitle").value,
        description: document.getElementById("editDescription").value,
        time: document.getElementById("editTime").value
      };

      localStorage.setItem("tasks", JSON.stringify(tasks));
      closeFormPopup();
      displayTasks(currentPage);
    }

    function closeFormPopup() {
      document.getElementById("editFormPopup").style.display = "none";
    }

     function createPaginationButtons(totalItems) {
      const pagination = document.getElementById('pagination');
      pagination.innerHTML = '';

      const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);


      const prevBtn = document.createElement('button');
      prevBtn.classList.add('btn', 'btn-primary', 'me-2');
      prevBtn.textContent = "Previous";
      prevBtn.disabled = currentPage === 1;
      prevBtn.onclick = () => {
        currentPage--;
        displayTasks(currentPage);
      };
      pagination.appendChild(prevBtn);


      for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.classList.add('btn', currentPage === i ? 'btn-dark' : 'btn-secondary', 'me-1');
        btn.textContent = i;
        btn.onclick = () => {
          currentPage = i;
          displayTasks(i);
        };
        pagination.appendChild(btn);
      }


      const nextBtn = document.createElement('button');
      nextBtn.classList.add('btn', 'btn-primary', 'ms-2');
      nextBtn.textContent = "Next";
      nextBtn.disabled = currentPage === totalPages;
      nextBtn.onclick = () => {
        currentPage++;
        displayTasks(currentPage);
      };
      pagination.appendChild(nextBtn);
    }



    function removeTask(index) {
      let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
      tasks.splice(index, 1);
      localStorage.setItem('tasks', JSON.stringify(tasks));

      displayTasks(currentPage);
    }


    function changePage(page) {
      currentPage = page;
      displayTasks(page);
    }

    window.onload = () => displayTasks(1);
  </script>

</body>

</html>
