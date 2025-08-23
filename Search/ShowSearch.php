<?php
    session_start();
    require __DIR__."\..\DB.php";

    $sql_show_tasks="SELECT * FROM tasks WHERE user_id=?";
    $stmt= $conn->prepare($sql_show_tasks);
    $stmt->bind_param("i",$_SESSION['user_id']);
    $stmt->execute();
    $result=$stmt->get_result();


    $sql_count_complete_tasks="SELECT COUNT(*) FROM tasks WHERE user_id=? AND complete=1";
    $stmt_count_complete_tasks= $conn->prepare($sql_count_complete_tasks);
    $stmt_count_complete_tasks->bind_param("i",$_SESSION['user_id']);
    $stmt_count_complete_tasks->execute();
    $stmt_count_complete_tasks->bind_result($count_complete); 
    $stmt_count_complete_tasks->fetch(); 

?>

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

                <!-- Right: Logout -->
                <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                    <a href="../logout.php" class="text-red-500 hover:text-red-700 font-medium">Logout</a>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="container mx-auto mt-8 max-w-2xl px-4">

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 text-center mb-6">
                <div class="bg-white shadow rounded p-3">
                    <p class="text-gray-500 text-sm">Total</p>
                    <p class="text-xl font-bold text-gray-700"><?php echo $result->num_rows ?></p>
                </div>
                <div class="bg-white shadow rounded p-3">
                    <p class="text-gray-500 text-sm">Completed</p>
                    <p class="text-xl font-bold text-green-600"><?php echo $count_complete ?></p>
                </div>
                <div class="bg-white shadow rounded p-3">
                    <p class="text-gray-500 text-sm">Pending</p>
                    <p class="text-xl font-bold text-yellow-600"><?php echo $result->num_rows-$count_complete ?></p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex justify-center space-x-4 mb-6">
                <a href="../home.php" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">All</a>
                <a href="../StatusTask/PendingTasks.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Pending</a>
                <a href="../StatusTask/CompleteTasks.php" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Completed</a>
            </div>

            <!-- Task List -->
            <div class="bg-white shadow rounded-lg divide-y">
                <?php 
                    if(!empty($_SESSION['tasks'])): 
                    foreach($_SESSION['tasks'] as $task):
                ?>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 py-3 gap-2 hover:bg-gray-50 transition">

                        <div class="flex items-center space-x-3">
                            <form action="../EditTask/UpdateStatusTask.php" method="POST">
                                <input type="hidden" name="CSRF_Token" value="<?php echo GenerateToken() ?>">
                                <input type="hidden" name="TaskId" value="<?php echo $task['id'] ?>">
                                <input 
                                    type="checkbox"
                                    name="status"
                                    class="h-5 w-5 text-blue-500 task-check"
                                    onchange="this.form.submit()" 
                                    value="1"
                                    <?php if($task['complete'] == 1) echo 'checked'; ?>
                                >
                                <span class="task-text <?php echo $task['complete'] ? 'line-through text-gray-400' : 'text-gray-700'; ?>text-gray-700"> <?php echo $task['title']?> </span>
                            </form>
                        </div>

                        <div class="flex space-x-2 justify-end">

                            <form action="../EditTask/EditTask.php" method="GET">
                                <input type="hidden" name="CSRF_Token" value="<?php echo GenerateToken() ?>">
                                <input type="hidden" name="TaskId" value="<?php echo $task['id'] ?>">
                                <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm">Edit</button>
                            </form>

                            <form action="../DeleteTask/DeleteTask.php" method="POST" onsubmit="return confirmDelete();">
                                <input type="hidden" name="CSRF_Token" value="<?php echo GenerateToken() ?>">
                                <input type="hidden" name="TaskId" value="<?php echo $task['id'] ?>">
                                <button  class="text-red-500 hover:text-red-700 text-sm" type="submit">Delete</button>
                            </form>

                        </div>
                    </div>
                <?php 
                    endforeach; 
                    else: 
                ?>
                <div class="px-4 py-6 text-center text-gray-500">No tasks found.</div>
                <?php endif; ?>
            </div>
        </div>

    <!-- Small Script to toggle line-through -->
        <script>
            function confirmDelete() {
                return confirm("Are you sure to delete it?");
            }
        </script>
    </body>
</html>
