<?php
include "db.php";

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $time = $_POST['time'];

    $conn->query("INSERT INTO list (title, description, time) VALUES ('$title', '$description', '$time')");
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TO do list</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<style>
  
  .container {
    border: 1px solid;
    border-radius: 25px;
    margin-top: 20px;
    background-color: azure;
    padding: 20px;
}

  h1 {
    font-size: 34px;
    text-align: center;
    padding-top: 25px;
}
span {
    color: blue;
    font-style: italic;
}


  input#text {
    height: 25px;
    border-radius: 6px;
  }
  button#saveButton {
    width: 100px;
}
</style>



  <body style="background-color: aliceblue;">

    <div class="container">

      <h1>Daily Routine  <span>To-Do List</span>  </h1>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" class="form-control">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" id="description" class="form-control">
      </div>
       <div class="mb-3">
        <label for="time" class="form-label">Time</label>
        <input type="time" id="time" class="form-control">
      </div>
      <button type="button" class="btn btn-success" id="saveButton">Save</button>
    </div>

    <script>
       
      const saveButton = document.getElementById('saveButton');
      const titleInput = document.getElementById('title');
      const descriptionInput = document.getElementById('description');
      const timeInput = document.getElementById('time');

      saveButton.addEventListener('click', function () {
        const title = titleInput.value;
        const description = descriptionInput.value;
        const time = timeInput.value;

        if (title === "" || description === "" || time === "") {
          alert("Please fill in all fields!");
          return;
        }

        
        const tasks = JSON.parse(localStorage.getItem('tasks')) || [];

       
        tasks.push({ title, description, time });

       
        localStorage.setItem('tasks', JSON.stringify(tasks));
         
       
        window.location.href = 'index.php';
      });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"></script>
  </body>


</html>