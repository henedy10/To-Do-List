<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Sign Up</h2>
    
    <!-- لو فيه رسالة خطأ
    <div class="bg-red-100 text-red-500 pl-1 rounded mb-4 text-medium">
      <?php 
        if(isset($_SESSION['Err'])){
          foreach($_SESSION['Err'] as $error){
            echo "* $error<br>";
          }
          unset($_SESSION['Err']);
        }
      ?>
    </div> -->

    <form action="#" method="POST" class="space-y-5">
        <input type="hidden" name="CSRF_Token" value="#">
        <!-- Username -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="email" id="email" name="email" 
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>
    
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" 
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" 
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" id="password" name="password" 
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition">
            Sign Up
        </button>
    </form>
  </div>

</body>
</html>
