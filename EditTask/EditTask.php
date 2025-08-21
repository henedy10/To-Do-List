<?php
session_start();
require __DIR__."/../DB.php";

$sql_select_task="SELECT * FROM tasks WHERE id=?";
$stmt=$conn->prepare($sql_select_task);
$stmt->bind_param("i",$_GET['TaskId']);
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-white shadow p-4">
  <div class="container mx-auto flex items-center justify-between">
    <!-- Left: Logo -->
    <h1 class="text-xl font-bold text-gray-700">My To-Do List</h1>
    <!-- Right: Back to Home -->
    <a href="../home.php" class="text-blue-500 hover:text-blue-700 font-medium">Back</a>
  </div>
</nav>

<!-- Content -->
<div class="container mx-auto mt-10 max-w-lg bg-white shadow rounded-lg p-6">
  <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Task</h2>

  <!-- Edit Task Form -->
  <form action="./UpdateTask.php" method="POST" class="space-y-4">
    <input type="hidden" name="TaskId" value="<?php echo $row['id'] ?>">
    <!-- Task Title -->
    <div>
      <label class="block text-gray-600 mb-1">Task Title</label>
      <input 
        type="text" 
        name="task_title" 
        placeholder="Title Task"
        value="<?php echo $row['title'] ?? " "?>"
        class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200"
        required
      >
    </div>
      <div class="bg-red-100 text-red-500 pl-1 rounded mb-4 text-medium">
        <?php 
          if(isset($_SESSION['TitleErr'])){
            foreach($_SESSION['TitleErr'] as $error){
              echo "* $error<br>";
            }
            unset($_SESSION['TitleErr']);
          }
        ?>
      </div>
    <!-- Actions -->
    <div class="flex justify-end space-x-3 pt-4">
      <a href="../home.php" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Cancel</a>
      <button 
        type="submit" 
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        Save
      </button>
    </div>

  </form>
</div>

</body>
</html>
