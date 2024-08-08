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



<section class="shop container">
    <div class="section-title">
        <h1>New Arrival</h1>
    </div>
    
    <div class="shop-items">
        <?php 
            $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY `id` DESC LIMIT 3");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                    <form action="" method="POST" class="p-form <?= $fetch_products['brand']; ?>">
                        <div class="shop-item ">
                            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                            <img src="./image/<?= $fetch_products['image']; ?>" alt="" class="item-img">
                            <h2 class="item-cat"><?= $fetch_products['brand']; ?></h2>
                            <h1 class="item-title"><?= $fetch_products['name']; ?></h1>
                            <span class="item-price">RS: <?= $fetch_products['price']; ?></span>
                            <div class="item-overlay">
                                <a href="detail.php?pid=<?= $fetch_products['id']; ?>" class="item-btn">View</a>
                            </div>
                        </div>
                    </form>
        <?php
                }
            } else {
                echo '<p class="empty">No products added yet!</p>';
            }
        ?>
    </div>
</section>


<section class="scroll">
    <div class="slider">
        <div class="slider-items">
            <div class="slider-item">Nike</div>
            <div class="slider-item">Apple</div>
            <div class="slider-item">Disney</div>
            <div class="slider-item">Loon</div>
            <div class="slider-item">Jumpman</div>
            <div class="slider-item">BMW</div>
            <div class="slider-item">Starbucks</div>
            <div class="slider-item">Nike</div>
            <div class="slider-item">Apple</div>
            <div class="slider-item">Disney</div>
            <div class="slider-item">Loon</div>
            <div class="slider-item">Jumpman</div>
            <div class="slider-item">BMW</div>
            <div class="slider-item">Starbucks</div>
        </div>
    </div>
</section>


 
<section class="shop container">
    <div class="section-title">
        <h1>Shop</h1>
    </div>
    
    <div class="shop-items">
        <?php 
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                    <form action="" method="POST" class="p-form <?= $fetch_products['brand']; ?>">
                        <div class="shop-item ">
                            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                            <img src="./image/<?= $fetch_products['image']; ?>" alt="" class="item-img">
                            <h2 class="item-cat"><?= $fetch_products['brand']; ?></h2>
                            <h1 class="item-title"><?= $fetch_products['name']; ?></h1>
                            <span class="item-price">RS: <?= $fetch_products['price']; ?></span>
                            <div class="item-overlay">
                                <a href="detail.php?pid=<?= $fetch_products['id']; ?>" class="item-btn">View</a>
                            </div>
                        </div>
                    </form>
        <?php
                }
            } else {
                echo '<p class="empty">No products added yet!</p>';
            }
        ?>
    </div>
</section>



    <section class="about container">
        <div class="section-title">
          <h1>About Us</h1>
          <p class="section-p">
            We are sell top quality best laptop for best price
            all so we have vweity of top brand laptop you can
             scroll thru web and oder our products
          </p>
        </div>
        <div class="row">
          <!-- Column One -->
          <div class="column">
            <div class="card">
              <div class="icon">
                <i class='bx bx-child'></i>
              </div>
              <h3>User Friendly</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis
                asperiores natus ad molestiae aliquid explicabo. Iste eaque quo et
                commodi.
              </p>
            </div>
          </div>
          <!-- Column Two -->
          <div class="column">
            <div class="card">
              <div class="icon">
                <i class="fa-solid fa-shield-halved"></i>
              </div>
              <h3>Super Secure</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis
                asperiores natus ad molestiae aliquid explicabo. Iste eaque quo et
                commodi.
              </p>
            </div>
          </div>
          <!-- Column Three -->
          <div class="column">
            <div class="card">
              <div class="icon">
                <i class="fa-solid fa-headset"></i>
              </div>
              <h3>Quick Support</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis
                asperiores natus ad molestiae aliquid explicabo. Iste eaque quo et
                commodi.
              </p>
            </div>
          </div>
        </div>
    </section>


<?php 
	include './components/web/footer.php';
?>