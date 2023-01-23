<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number =$_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ?  AND message = ?  AND number =?");

   $select_message->execute([$name, $email,$msg,$number]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, message,number) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $msg, $number ]);

      $message[] = 'sent message successfully!';

   }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <!-- icons  -->
    <link rel="apple-touch-icon" sizes="180x180" href="fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
    <link rel="manifest" href="fav/site.webmanifest">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main.css?v=<?=time()?>" type="text/css" >
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
  
  /* Set the size of the div element 
  that contains the map */
  #map {
      height: 400px;
      width: 400px;
      align:center;
  }
    
  
</style>
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="contact">
<h3>Contact Us</h3>
<form action="" method="post">

   <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
      <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

      
      
      <input type="text" name="name" placeholder="Name" required  maxlength="20" class="box" value="<?= $fetch_profile["name"]; ?>" >   
      <input type="email" name="email" placeholder="Email" required maxlength="50" class="box" value="<?= $fetch_profile["email"]; ?>"  >
     
      <input type="tel"  name="number" placeholder="Phone number" class="box" minlength="7" maxlength="15" required value="<?= $fetch_profile["number"]; ?>">
      <textarea name="msg" class="box" placeholder="Message" cols="30" rows="10" required ></textarea>
      
      <button type="submit" value="send message" name="send" class="btn-1"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </button>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty-1">You need to login first</p>';
   }
   ?>
   
   

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>