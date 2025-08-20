<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>To-Do List</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-white shadow p-4">
  <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">

    <!-- Left: Logo -->
    <div class="w-full md:w-1/3 text-center md:text-left">
      <h1 class="text-xl font-bold text-gray-700">My To-Do List</h1>
    </div>

    <!-- Center: Search -->
    <div class="w-full md:w-1/3 flex justify-center">
      <form action="#" method="GET" class="flex w-full max-w-md">
        <input  
          type="text"  
          name="search"  
          placeholder="Search tasks..."  
          class="flex-1 border rounded-l px-3 py-2 focus:outline-none"
        >
        <button  
          type="submit"  
          class="bg-gray-500 text-white px-4 py-2 rounded-r hover:bg-gray-600"
        >
          Search
        </button>
      </form>
    </div>

    <!-- Right: Logout -->
    <div class="w-full md:w-1/3 flex justify-center md:justify-end">
      <a href="./logout.php" class="text-red-500 hover:text-red-700 font-medium">Logout</a>
    </div>

  </div>
</nav>

<!-- Content -->
<div class="container mx-auto mt-8 max-w-2xl px-4">

  <!-- Add Task -->
  <form class="flex flex-col sm:flex-row mb-6 gap-2">
    <input  
      type="text"  
      placeholder="Add a new task..."  
      class="flex-1 border rounded px-4 py-2 focus:outline-none"
    >
    <button  
      type="submit"  
      class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
    >
      Add
    </button>
  </form>

  <!-- Task List -->
  <div class="bg-white shadow rounded-lg divide-y">
    
    <!-- Example Task Item -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 py-3 gap-2">
      <div class="flex items-center space-x-3">
        <input type="checkbox" class="h-5 w-5 text-blue-500 task-check">
        <span class="task-text text-gray-700">Example Task 1</span>
      </div>
      <div class="flex space-x-2 justify-end">
        <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Edit</a>
        <a href="#" class="text-red-500 hover:text-red-700 text-sm">Delete</a>
      </div>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 py-3 gap-2">
      <div class="flex items-center space-x-3">
        <input type="checkbox" class="h-5 w-5 text-blue-500 task-check">
        <span class="task-text text-gray-700">Example Task 2</span>
      </div>
      <div class="flex space-x-2 justify-end">
        <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Edit</a>
        <a href="#" class="text-red-500 hover:text-red-700 text-sm">Delete</a>
      </div>
    </div>

  </div>

</div>

<!-- Small Script to toggle line-through -->
<script>
  document.querySelectorAll(".task-check").forEach(check => {
    check.addEventListener("change", function() {
      let text = this.nextElementSibling;
      if(this.checked){
        text.classList.add("line-through", "text-gray-400");
      } else {
        text.classList.remove("line-through", "text-gray-400");
      }
    });
  });
</script>

</body>
</html>
