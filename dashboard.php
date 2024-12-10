<?php
include("auth_session.php");
include 'header.php'; // Include the header

$username = htmlspecialchars($_SESSION['username']); // Sanitize the output
    echo "<div class='welcome-message'>
            <h1>Welcome back, <b>{$username}</b>!</h1>
          </div>";

?>

<!-- Featured items -->
<div class="w3-container" id="featured items">
  <h3 class="w3-border-bottom w3-border-light-grey w3-padding-15" style="text-align: center; font-family:Arial, sans-serif;">Featured Items</h3>
</div>
<p>&nbsp;</p>
<?php
require('db.php');
$stmt = $con->prepare("SELECT * FROM Products LIMIT 9 OFFSET 15");

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  ?>
  <div class="w3-row-padding">
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="table">
            <a href="item.php?id=<?php echo $row["ItemName"]; ?>">
                <img src='img/<?php echo $row['Image']; ?>' alt='<?php echo $row["ItemName"]; ?>'>
            </a>
            <a href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo $row["Brand"]; ?></a>
            <a href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo $row["ItemName"]; ?></a>
            <p>£<?php echo $row["Price"]; ?></p>
        </div>
        <?php
    }
    ?>
</div>


  <?php
}
?>

<body>
  <?php
  //connect to db using the db script
  require('db.php');
  // When web page form submitted, insert values into the database.
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    //this makes only email format can sign to protect from attacks: user@example.com
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die("Invalid email address");
    }
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    $stmt_insert = $con->prepare("INSERT INTO `contact` (name, email, message) VALUES (?, ?, ?)");
    $stmt_insert->bind_param("sss", $name, $email, $message);
    $stmt_insert->execute();

    echo '<script> window.location="contactmessage.php"; </script> ';
  } else { ?>
    <p>&nbsp;</p>
<!-- Contact Section -->
<div style="display: flex; justify-content: center; align-items: center; min-height: 40vh; background-color: #f4f4f4;">
    <form class="form" action="" method="post" style="width: 100%; max-width: 600px; background-color: #fff; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
      <div class="w3-container w3-padding-32" id="contact">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16" style="font-family: sans-serif; text-align: center;">Contact Us</h3>
        <p style="color: rgba(122, 122, 122, 1); text-align: center;">If you have any queries or if we can be of any further assistance please contact us. We will respond within 24 hours.</p>
        <input class="w3-input w3-section w3-border" type="text" name="name" placeholder="Name" required style="margin-bottom: 10px; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
        <input class="w3-input w3-section w3-border" type="text" name="email" placeholder="Email" required style="margin-bottom: 10px; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
        <input class="w3-input w3-section w3-border" type="text" name="message" placeholder="Message" required style="margin-bottom: 20px; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
        <input type="submit" name="submit" value="Send" class="send-button" style="width: 100%; background-color: #000; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
      </div>
    </form>
</div>


    <?php
  }
  ?>

</body>


<?php
include 'footer.php'; // Include the footer
?>

</html>

<style>
.w3-row-padding {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* This will evenly space the items across the row */
    align-items: stretch; /* This makes sure all items align well vertically */
    padding: 0 20px; /* Adjust padding as needed */
}

.table {
    flex: 0 0 23%; /* Sets each item to take up exactly 23% of the container's width */
    margin: 10px; /* Ensure margin size does not prevent four items from fitting */
    box-sizing: border-box; /* Includes padding and border in the element's total width and height */
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 315px; /* Optional: Adjust depending on your design needs */
}

.table img {
    width: 100%; /* Ensures image takes the full width */
    max-width: 230px; /* Limits image width to keep uniform size */
    height: auto; /* Maintains aspect ratio */
}

.table a {
    text-align: center;
    display: block;
    color: #696969;
    text-decoration: none;
    margin-top: 5px;
    font-size: 14px;
}

.table p {
    text-align: center;
    font-size: 17px;
    color: black;
    margin-top: 5px;
}

.welcome-message {
    padding: 15px;
    /* Light grey background */
    background-color: #f4f4f4;  
    /*  Light grey border */
    border: 1px solid #ccc; 
    margin-top: 20px;
    /* // Center the text */
    text-align: center; 
}

.welcome-message h1 {
  /* // Dark grey color for text */
    color: #333; 
}

.welcome-message p {
    font-size: 12px;
}



@media (max-width: 1024px) {
    .table {
        flex: 0 0 48%; /* Two items per row */
    }
}

@media (max-width: 768px) {
    .table {
        flex: 0 0 100%; /* One item per row */
    }
}


</style>