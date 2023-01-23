<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar navbar-expand-sm  navbar-dark">
      <div class="container">
        
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapsibleNavbar"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../admin/dashboard.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/placed_orders.php">Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/admin_accounts.php">Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/users_accounts.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/messages.php">Messages</a>
            </li>
          </ul>
        </div>
</nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn btn-outline-primary btn-lg">update profile</a>
         
         <a href="../components/admin_logout.php" class="btn btn-outline-danger btn-lg" onclick="return confirm('logout from the website?');">logout</a> 
      </div>

   </section>

</header>