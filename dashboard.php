<?php
include("auth_session.php");
include 'header.php'; // Include the header
?>

<!-- Featured items -->
<div class="w3-container" id="featured items">
  <h3 class="w3-border-bottom w3-border-light-grey w3-padding-15" style="text-align: center; fontfamily: sans-serif;">
    Featured Items</h3>
</div>

<?php
require('db.php');
$query = "SELECT * FROM Products LIMIT 8 OFFSET 10";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
  ?>
  <div style="height:315px; width:270px; " class="table">
    <div class="w3-row-padding">
      <div style="text-align: center;" class="w3-display-container">
        <div class="w3-display-bottom w3-white w300-padding"><a href="item.php?id=<?php echo
          $row["ItemName"]; ?>">
            <?php echo "<img src='img/" . $row['Image'] . "'height='235' width ='230'>";
            ?>
          </a> </div>
        <div><a style="font-size:12px; color:#696969; text-decoration:none; margin-bottom:-15px"
            href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo $row["Brand"]; ?></a></div>
        <div><a style="font-size:14px; color:black; text-decoration:none; " href="item.php?id=<?php echo
          $row["ItemName"]; ?>"><?php echo $row["ItemName"]; ?></a></div>
        <div style="text-align: center; margin-top:-15px; padding-bottom:15px; font-size:17px; marginbottom:0px;"
          class="w3-display-bottom w3-white w300-padding">
          <p>£<?php echo $row["Price"]; ?> </p>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<body>
  <?php
  //connect to db using the db script
  require('db.php');
  // When web page form submitted, insert values into the database.
  if (isset($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
    $name = mysqli_real_escape_string($con, $name);
    $email = $_REQUEST['email'];
    $email = mysqli_real_escape_string($con, $email);
    $message = $_REQUEST['message'];
    $message = mysqli_real_escape_string($con, $message);
    $insertquery = "INSERT into `contact` (name, email, message)
VALUES ('$name', '$email', '$message')";
    $result = mysqli_query($con, $insertquery); //execute the query
    echo '<script> window.location="contactmessage.php"; </script> ';
  } else { ?>
    <p>&nbsp;</p>
    <!-- Contact Section -->
    <form class="form" action="" method="post">
      <div class="w3-container w3-padding-32" id="contact">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16" style="font-family: sansserif;">Contact Us</h3>
        <p style="color: rgba(122, 122, 122, 1)" class="padding2">If you have any queries or if we can be of
          any further assistance please contact us. We will respond within 24 hours.</p>
        <input class="w3-input w3-section w3-border" type="text" name="name" placeholder="Name" required>
        <input class="w3-input w3-section w3-border" type="text" name="email" placeholder="Email" required>
        <input class="w3-input w3-section w3-border" type="text" name="message" placeholder="Message" required>
        <input type="submit" name="submit" value="Send" class="send-button">
      </div>
    </form>
    <?php
  }
  ?>

</body>

</html>