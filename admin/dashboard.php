<?php 
    include '../components/db-connect.php';
	include '../components/admin/header.php';
    include '../components/admin/sidebar.php';

    session_start();

	$admin_id = $_SESSION['admin_id'];

	if(!isset($admin_id)){
	header('location:admin-login.php');
	}
?>

<section class="home-section">

<div class="home-nav">
<center><span class="title">Dashboard</span></center>
</div>

<div class="short-info">
    <div class="stat">
        <?php
            $total_erning = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE order_status = ?");
            $select_completes->execute(['completed']);
            while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                $total_erning += $fetch_completes['total_price'];
            }
        ?>
        <p class="number"><?= $total_erning; ?></p>
        <p class="label">Total </p>
    </div>
    <div class="stat">
        <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $numbers_of_orders = $select_orders->rowCount();
        ?>
        <p class="number"><?= $numbers_of_orders; ?></p>
        <p class="label">Completed Orders</p>
    </div>
    <div class="stat">
        <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $numbers_of_products = $select_products->rowCount();
        ?>
        <p class="number"><?= $numbers_of_products; ?></p>
        <p class="label">Products</p>
    </div>
    
</div>
    



<?php 
	include '../components/admin/footer.php';
?>