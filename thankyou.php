<?php
require_once('vendor/autoload.php');
$adults = isset($_POST['adults'])?$_POST['adults']: null;
$children =  isset($_POST['children'])?$_POST['children']: null;
$infants =  isset($_POST['infants'])?$_POST['infants']: null;
$date =  isset($_POST['date'])?$_POST['date']: null;
$product_list = [];
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
             "firstName" => "Rick", 
             "lastName" => "Sanchez", 
             "phone" => "+61484123456" 
          ], 
       "items" => [
                [
                   "productCode" => "P00TNX", 
                   "quantities" => [
                      [
                         "optionLabel" => "Adult", 
                         "value" => 1 
                      ],
                      // [
                      //    "optionLabel" => "Children", 
                      //    "value" => 1 
                      // ] ,
                      // [
                      //    "optionLabel" => "Infants", 
                      //    "value" => 1 
                      // ]  
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
          color: #2979FF;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #2979FF;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <?php if($error) echo $error; ?> 
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>We received your purchase request;</p>
      </div>
    </body>
    <script type="text/javascript">
      setTimeout(function () {
         window.location.href = "./"; //will redirect to your blog page (an ex: blog.html)
      }, 5000); //will call the function after 2 secs.
    </script>
</html>