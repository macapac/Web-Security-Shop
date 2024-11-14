<?php
include("auth_session.php");
include 'header.php'; // Include the header
?>

<body>
  <html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // passing the itemID to this page as a parameter
    $var = $_GET['id'];
    ?>
    <!-- Displaying the description of the item -->
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
      <div class="style-quarter">
        <h1><?php echo $var; ?></h1>
        <?php
        error_reporting(0);
        require('db.php');
        $query = "SELECT * FROM products WHERE ItemName = '$var'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          $stock = $row["Stock"];
          ?>
          <div class="w3-row-padding">
            <div class="w3-display-container">
              <div class="styling">
                <div class="pic"><?php echo "<img src='img/" . $row['Image'] . "' id='myimage' height='490' width ='490'>"; ?>
                </div>
                <div style="text-transform:uppercase; font-size: 20px;" class="w3-display-bottom w3-white w3-padding">
                  <?php echo $row["Brand"]; ?> </div>
                <div style="font-weight: 700;" class="w3-display-bottom w3-white w3-padding">
                  <p>£<?php echo $row["Price"]; ?> </p>
                </div>
                <p>Tax Included.</p>
                <ol>
                  <div class="w3-display-bottom w3-white w3-padding">
                    <p>• <?php echo $row["ItemName"]; ?> </p>
                  </div>
                  <div class="w3-display-bottom w3-white w3-padding">
                    <p>• Colour: <?php echo $row["Colour"]; ?> </p>
                  </div>
                  <div class="w3-display-bottom w3-white w3-padding">
                    <p>• Size: <?php echo $row["Size"]; ?> </p>
                  </div>
                  <div class="w3-display-bottom w3-white w3-padding">
                    <p>• Stock: <?php echo $stock; ?> </p>
                  </div>
                  <div class="w3-display-bottom w3-white w3-padding">
                    <p>• Condition: <?php echo $row["Condition"]; ?> </p>
                  </div>
                </ol>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>

      <?php
      // quantity function
      require('db.php');
      // checks if the selected quantity that the user has chose is valid by checking the items stock in the database
      $query = "SELECT * FROM products WHERE ItemName = '$var'";
      $result = mysqli_query($con, $query);
      while ($item = mysqli_fetch_array($result)) {
        if (isset($_POST['quantity']) && $_REQUEST['quantity'] > 0 && $_REQUEST['quantity'] <= $stock) {
          $quantity = $_REQUEST['quantity'];
          if (isset($_SESSION['cart'][$var])) {
            $_SESSION['cart'][$var]['Quantity'] += $quantity;
          } else {
            if ($_SESSION['cart'][$var]['Quantity'] + $quantity > $stock) {
              echo "<div style='font-size:12px; font-family:sans-serif; text-align:center; padding: 40px; position:fixed; background-color:white; border-style: solid; border-color:black; margin-left:460px; margin-top:-300px;' class='mes'>
						  <h3>Invalid Quantity</h3>
						  <p>Click <a style='text-decoration:underline; 'href=''>Here</a> to return</p>
						  </div>";
            } else {
              $_SESSION['cart'][$var] = array('ID' => $item["ItemID"], 'Quantity' => $quantity, 'Price' => $item["Price"]);
            }
          }
        } else {
        }
      }
      ?>

      <!-- Add to basket button, and quantity box-->
      <form action="" style="cursor: pointer; font-color:#606060;" method="post" name="addtobasket">
        <input style="display:block; margin-left: 560px; margin-bottom:35px;" type="integer" name="quantity" value="1"
          size="2" />
        <a
          style="text-decoration: none; font-weight: 700; letter-spacing:.08em; color: #606060; display: inline-block;"><input
            class="summary-checkout checkout-cta" type="submit" value="add to cart" /></a>
      </form>

      <!-- Buy it now button-->
      <div style="cursor: pointer;" class="summary-checkout">
        <button type="submit" value="Checkout" class="checkout-ctar"><a
            style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: white;" href="checkout.php">Buy
            It Now</a></button>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <!-- Back to shop button -->
      <div style="cursor: pointer;">
        <button class="backtoshop"><a
            style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: #3a3a3a;" href="shop.php"><i
              class="arrow left"></i> Back To Shop</button></a>
      </div>
</body>