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

	if(isset($_POST['delete'])){
		$cart_id = $_POST['cart_id'];
		$delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
		$delete_cart_item->execute([$cart_id]);
		$message[] = 'cart item deleted!';
	}

	 if(isset($_POST['update_qty'])){
		$cart_id = $_POST['cart_id'];
		$qty = $_POST['qty'];
		$qty = filter_var($qty, FILTER_SANITIZE_STRING);
		$update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
		$update_qty->execute([$qty, $cart_id]);
		$message[] = 'cart quantity updated';
	}

	$grand_total = 0;
?>

    <section class="cart container">
        <div class="section-title">
          <h1>Cart</h1>
        </div>
        
            <div class="cart-box">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <form action=""  method="POST">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                    <div class="cart-item">
                        <img src="./image/<?= $fetch_cart['image']; ?>" >
                        <div class="c-content">
                        <h3><?= $fetch_cart['name']; ?></h3>
                        <h4>Price: Rs: <span class="price"><?= $fetch_cart['price']; ?></span></h4>
                        <h4>Sub: <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></h4>
                        <input type="number" name="qty" class="button" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                        <button type="submit" class="c-btn1" name="update_qty">Update</button>
                        <button class="c-btn1" name="delete" onclick="return confirm('delete this item?');">Delete</button>
                        </div>
                    </div>
                </form>

            <?php
					$grand_total += $sub_total;
				}
			?>

                <div class="cart-total">
                    <h1>Total: Rs: <?= $grand_total; ?></h1>
                    <div>
                    <button class="c-btn"><a href="index.php">Back</a></button>
                    <button class="c-btn"><a href="checkout.php" <?= ($grand_total > 1) ? '' : 'disabled'; ?> >Checkout</a></button>
                    </div>
                </div>
            <?php
                    } else {
                        echo '
                    <div class="wrapper-1" style="height: 40vh;">
                        <div class="card-1">
                            <div class="card-1-info">
                            <h4 class="name">Your Cart is empty !!</h4>
                            </div>
                        </div>
                        <div class="button-container-1" >
                            <a href="index.php.php" class="detail__button button">Shop now</a>
                        </div>        
                    </div>
                    ';
                    }
            ?>
            </div>
      </section>







<?php 
	include './components/web/footer.php';
?>