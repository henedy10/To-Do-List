<?php 
require __DIR__."/login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
    
    <!-- لو فيه رسالة خطأ -->
    <div class="bg-red-100 text-red-500 pl-1 rounded mb-4 text-medium">
      <?php 
        if(isset($_SESSION['LoginErr'])){
          foreach($_SESSION['LoginErr'] as $error){
            echo "* $error<br>";
          }
          unset($_SESSION['LoginErr']);
        }
      ?>
    </div>

    <div class="bg-green-100 text-green-500 pl-1 rounded mb-4 text-medium">
      <?php 
        if(isset($_SESSION['SuccessMsg'])){
            echo "*". $_SESSION['SuccessMsg'] ."<br>";
          unset($_SESSION['SuccessMsg']);
        }
      ?>
    </div>

    <form action="./login.php" method="POST" class="space-y-5">
        <input type="hidden" name="CSRF_Token" value="<?php echo GenerateToken() ?>">
      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" required
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
      </div>

      <!-- Remember Me -->
      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" name="remember" class="text-blue-500 border-gray-300 rounded">
          Remember me
        </label>
        <a href="./changepassword/EditPassword.php" class="text-blue-500 hover:underline">Forgot password?</a>
      </div>

      <!-- Submit Button -->
      <button type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition">
        Login
      </button>
    </form>

    <!-- Register Link -->
    <p class="text-center text-sm text-gray-600 mt-6">
      Don’t have an account? 
      <a href="./SignUp/CreateAccount.php" class="text-blue-500 hover:underline">Sign up</a>
    </p>
  </div>

</body>
</html>
