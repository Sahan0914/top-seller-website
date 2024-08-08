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

?>




      <section class="profile container">
        <div class="section-title">
            <h1>Profile</h1>
          </div>
        <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
          <div class="prof">
            <div class="profile-box ">
               
                <h2 class="p-category"> <?= $fetch_profile['email']; ?></h2>
                <a href="#" class="p-title"> <?= $fetch_profile['name']; ?></a>
                <span class="p-date"><?= $fetch_profile['number']; ?></span>
                <span class="p-date"><?= $fetch_profile['address']; ?></span>
                <div class="bt">
                    <a href="update.php?uid=<?= $fetch_profile['id']; ?>" class="p-btn">Update</a>
                    <a href="logout.php" class="p-btn">logout</a>
                </div>
            </div>
        </div>
            

                <div class="prof">
                <?php
                    if($user_id == ''){
                        echo '<p class="empty">please login to see your orders</p>';
                    }else{
                        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                        $select_orders->execute([$user_id]);
                        if($select_orders->rowCount() > 0){
                            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="profile-order ">
                        <p>PLACED ON : <span><?= $fetch_orders['placed_on']; ?></span></p>
                        <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                        <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                        <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                        <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                        <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
                        <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                        <p>Total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
                        <p>Payment status : <span style="color:<?php if($fetch_orders['order_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['order_status']; ?></span> </p>
                    </div>
                <?php
                  }
                  }else{
                     echo '<p class="empty">no orders placed yet!</p>';
                  }
                  }
                ?>
                </div>
        <?php
            }else{
        ?>
            <div class="wrapper-1" style="height: 60vh;">
                <div class="card-1">
                    <div class="card-1-info">
                    <h4 class="name">Login or Register first !!</h4>
                    </div>
                </div>
                <div class="" >
                    <button><a href="login.php" class="">Login or Register</a></button>
                </div>        
            </div>
        <?php
        }
        ?>
            
      </section>







      <?php 
	include './components/web/footer.php';
?>