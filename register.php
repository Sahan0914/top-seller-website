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


    if(isset($_POST['register'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
     
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
        $select_user->execute([$email, $number]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
     
        if($select_user->rowCount() > 0){
           $message[] = 'email or number already exists!';
        }else{
           if($pass != $cpass){
              $message[] = 'confirm password not matched!';
           }else{
              $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password, address) VALUES(?,?,?,?,?)");
              $insert_user->execute([$name, $email, $number, $cpass, $address]);
              $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
              $select_user->execute([$email, $pass]);
              $row = $select_user->fetch(PDO::FETCH_ASSOC);
              if($select_user->rowCount() > 0){
                 $_SESSION['user_id'] = $row['id'];
                
              }
              header('location:index.php');
           }
        }
     
    }

?>


   
    
    
    
    





      <section class="register container">
        <div class="section-title">
            <h1>Register</h1>
          </div>

        <div class="login-container">
            <form class="form" action="" method="POST">
                <p class="form-title"></p>
                <div class="input-container">
                    <input type="text" name="name" required placeholder="enter your name" class="form--input" maxlength="50">
                </div>
                <div class="input-container">
                    <input type="email" name="email" required placeholder="enter your email" class="form--input" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-container">
                    <input type="number" name="number" required placeholder="enter your number" class="form--input" min="0" max="9999999999" maxlength="10">
                </div>
                <div class="input-container">
                    <input type="text" name="address" required placeholder="enter your address" class="form--input" min="0"  maxlength="255">
                </div>
                <div class="input-container">
                    <input type="password" name="pass" required placeholder="enter your password" class="form--input" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-container">
                    <input type="password" name="cpass" required placeholder="confirm your password" class="form--input" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
               
                <button type="submit" name="register"  class="submit">
                    Register
                </button>
                <button type="submit"   class="submit">
                    <a href="login.php">Login</a>
                </button>
            </form>
        </div>
    
      </section>






      <?php 
	include './components/web/footer.php';
?>