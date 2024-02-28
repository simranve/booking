<?php
require_once('vendor/autoload.php');
$data =isset($_GET['data'])?$_GET['data']: null;
$name = 'Simran Gupta';
if($data != null){
	// var_dump(base64_decode($product));die();
	$data1 = base64_decode($data);
	$product = json_decode($data1);

}else{
	header("Location: index.php");
}
// echo "<pre>";
// var_dump($product);die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Detail Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="product-image">
      <img src=<?php echo $product->images; ?> alt="Product Image">
    </div>
    <div class="product-details">
      <h1>Product Name</h1>
      <p class="price"><?php echo $product->name; ?></p>
      <p><?php echo $product->shortDescription; ?></p>
      <div class="product-options">
        <div class="d-flex justify-content-between align-items-center">
		    <big class="text-muted"><?php echo $value['currency'].' '.$value['price']; ?></big>
        </div>
        
        <a type="button" class="btn btn-outline-secondary" href="payment.php?data=<?php echo $data; ?>">Book Now!!</a>
      </div>
    </div>
  </div>
<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
  justify-content: space-around;
  align-items: flex-start;
  margin-top: 50px;
}

.product-image img {
  max-width: 100%;
  height: auto;
}

.product-details {
  max-width: 400px;
}

.product-details h1 {
  font-size: 24px;
}

.price {
  font-size: 20px;
  color: #333;
}

.product-options {
  margin-top: 20px;
}

.product-options label {
  font-size: 16px;
}

.product-options input[type="number"] {
  width: 60px;
  padding: 5px;
  margin-right: 10px;
}

.product-options a {
  padding: 8px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  font-size: 16px;
}

.product-options a:hover {
  background-color: #0056b3;
}

</style>
</body>
</html>
