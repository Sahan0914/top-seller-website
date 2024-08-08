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



    <section class="detail container">
        <div class="section-title">
          <h1>Details</h1>
        </div>

        <?php
            $pid = $_GET['pid'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$pid]);
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
            <div class="d-box">
                <div class="d-img">
                    <img src="./image/<?= $fetch_products['image']; ?>">
                </div>
                <div class="right">
                    <div class="basic-info">
                        <h1><?= $fetch_products['name']; ?></h1>
                        <h2>Rs:<?= $fetch_products['price']; ?></h2>
                        <h2><?= $fetch_products['brand']; ?> - <?= $fetch_products['category']; ?></h2>
                    </div>
                    <div class="description">
                        <p><?= $fetch_products['description']; ?></p>
                    </div>
                    <div class="d-btns">
                        <form action="" method="post" class="hform" >
                            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                            <input type="hidden" name="qty" class="q-qty" min="1" max="99" value="1" maxlength="2">
                            <button type="submit" name="add_to_cart" class="d-btn" >Add to cart</button>
                        </form>
                        <button class="d-btn"><a href="index.php">Back</a></button>
                    </div>
                </div>
            </div>
        <?php
                }
            }else{
                echo '<p class="empty">no products added yet!</p>';
            }
        ?>

    </section>







<?php 
	include './components/web/footer.php';
?>