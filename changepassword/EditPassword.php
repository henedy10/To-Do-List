<?php
session_start();
require __DIR__."/../csrf.php";
?>
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
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Update Password</h2>
    
    <!-- لو فيه رسالة خطأ -->


      <form action="./UpdatePassword.php" method="POST" class="space-y-5" >
        <input type="hidden" name="CSRF_Token" value="<?php echo GenerateToken() ?>">

        <div class="bg-red-100 text-red-500 pl-1 rounded mb-4 text-medium">
            <?php 
                if(isset($_SESSION['EditPasswordErr'])):
                  foreach($_SESSION['EditPasswordErr'] as $error):
                    echo "* $error<br>";
                  endforeach;
                  unset($_SESSION['EditPasswordErr']);
                endif;
            ?>
        </div>
        <!-- Email -->
        <div class="mb-1">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <!-- New Password -->
        <div class="mb-1">
            <label for="newpassword" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input type="password" id="newpassword" name="newpassword" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <!-- Confirm New Password -->
        <div class="mb-1">
            <label for="confirmpassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 mt-1 rounded-lg transition">
            Udate
        </button>
      </form>
  </div>
</body>
</html>
