<?php 
    include './components/db-connect.php';
	include './components/web/header.php';
    
    session_start();

    if(isset($_SESSION['user_id'])){
       $user_id = $_SESSION['user_id'];
    }else{
       $user_id = '';
    };
 
    include './components/web/add-cart.php';

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
     
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
     
        if($select_user->rowCount() > 0){
           $_SESSION['user_id'] = $row['id'];
           header('location:index.php');
        }else{
           $message[] = 'incorrect username or password!';
        }
        header('login.php');
     
    }

?>




      <section class="register container">
        <div class="section-title">
            <h1>Login</h1>
          </div>

        <div class="login-container">
            <form class="form" action="" method="POST">
                <p class="form-title"></p>
                 <div class="input-container">
                 <input type="email" name="email" required placeholder="Enter your email"  maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
               </div>
               <div class="input-container">
               <input type="password" name="pass" required placeholder="Enter your password"  maxlength="10" oninput="this.value = this.value.replace(/\s/g, '')">

                </div>
                <button type="submit" name="login" class="submit">
                    login
                </button>
                <button type="submit"  class="submit">
                    <a href="register.php">Register</a>
                </button>
            </form>
        </div>
    
      </section>







      <?php 
	include './components/web/footer.php';
?>