<?php
require_once('vendor/autoload.php');
$data =isset($_GET['data'])?$_GET['data']: null;
$error = null;
if($data != null){
  // var_dump(base64_decode($product));die();
  $data1 = base64_decode($data);
  $product = json_decode($data1);
  try {
    $client = new \GuzzleHttp\Client();
    $parameters = [
       "customer" => [
             "firstName" => "Simran", 
             "lastName" => "Gupta", 
             "phone" => "+91 1234 567 890" 
          ], 
       "items" => [
                [
                   "productCode" => "P00TNX", 
                   "quantities" => [
                      [
                         "optionLabel" => "Adult", 
                         "value" => 1 
                      ]
                   ] 
                ] 
             ], 
       "creditCard" => [
                            "cardToken" => "tok_1JZPuSH6OlZMtMyGuVyMcVt7" 
                         ] 
    ]; 
    // $parameters = json_encode($parameters);
    $response = $client->request('POST', 'https://api.rezdy-staging.com/v1/bookings?apiKey=69f708868ddc45eaa1f9b9fad1ddeba5', [
      'headers' => [
        'apiKey' => '69f708868ddc45eaa1f9b9fad1ddeba5',
        'accept' => 'application/json',
      ],
      'form_params' => $parameters,
    ]);
    $data = json_decode($response->getBody());
  }catch (Exception $e) {
    // $error = $e->getMessage();
      // echo 'Caught exception: ',  $e->getMessage(), "\n";
  }

}else{
  header("Location: index.php");
}
// echo "<pre>";
// var_dump($product);die();
?>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
}

h1 {
    color: rgba(34, 28, 28, 0.5);
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
}

p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
}

i {
    color: rgba(34, 28, 28, 0.5);
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
}

</style>

<body>
    <?php if($error) echo $error; ?>
    <div class="card">
        <h1>Payment done!!</h1>
    </div>
</body>

</html>