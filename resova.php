<?php
require_once('vendor/autoload.php');
$adults = isset($_GET['adults'])?$_GET['adults']: null;
$children =  isset($_GET['children'])?$_GET['children']: null;
$infants =  isset($_GET['infants'])?$_GET['infants']: null;
$date =  isset($_GET['date'])?$_GET['date']: null;
$product_list = [];
if(isset($_GET['adults']) && $_GET['adults']){
	// $input = [];
	if(isset($_GET['adults']) && $_GET['adults']) $input['adults'] = $_GET['adults'];
	if(isset($_GET['children']) && $_GET['children']) $input['children'] = $_GET['children'];
	if(isset($_GET['infants']) && $_GET['infants']) $input['infants'] = $_GET['infants'];
	if(isset($_GET['date']) && $_GET['date']) $input['date'] = $_GET['date'];
	$send_parameters =  http_build_query($input);
	// echo $send_parameters;

	$client = new \GuzzleHttp\Client();
	$response = $client->request('GET', 'https://api.rezdy-staging.com/v1/products/marketplace?apiKey=69f708868ddc45eaa1f9b9fad1ddeba5&limit=12&'.$send_parameters, [
	  'headers' => [
	    'accept' => 'application/json',
	  ],
	]);
	$data = json_decode($response->getBody());
	$products = [];

	if(isset($data->requestStatus) && isset($data->requestStatus->success) && $data->requestStatus->success == true){
		$products = $data->products;
		if(count($products)){
			foreach ($products as $key => $value) {
				$product_list[$key]['images'] = (count($value->images))?$value->images[0]->thumbnailUrl:'data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18de9f5045f%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18de9f5045f%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.9453125%22%20y%3D%22117.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E';
				$product_list[$key]['name'] =  $value->name;
		        $product_list[$key]['shortDescription'] =  $value->shortDescription;
		        $product_list[$key]['price'] =  (count($value->priceOptions))?$value->priceOptions[0]->price:'NA';
		        $product_list[$key]['price_id'] =  (count($value->priceOptions))?$value->priceOptions[0]->id:null;
		        $product_list[$key]['currency'] =  $value->currency;
		        $product_list[$key]['productCode'] =  $value->productCode;
		        $product_list[$key]['base_64'] = base64_encode(json_encode($product_list[$key]));
			}
		}
		// var_dump($product_list);die();
		
	}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Booking</title>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>
  	<div style="background-image: linear-gradient(to right, #7B1FA2, #E91E63); padding: 40px;">
	    <div class="container" style="">
	    	<div id="booking" class="section">
			  <div class="section-center">
			    <div class="container">
			      <div class="row">
			        <div class="booking-form">
			          <div class="form-header">
			            <h2 class="h2 text-white text-bold">Make Your Reservation <small>by Resova</small></h2>
			          </div>
			          <form method="get">
			            <div class="row">
			              <div class="col-md-4">
			                <div class="form-group">
			                	<label class="text-white ml-3">Number of Adults</label>
			                	<input class="form-control" type="number" name="adults" required placeholder="No. of Adults" value="<?php echo($adults); ?>"> 
			             	</div>
			              </div>
			              <div class="col-md-4">
			                <div class="form-group ">
			                	<label class="text-white ml-3">Number of Children</label>
			                	<input class="form-control" type="number" name="children" required placeholder="No. of Children"  value="<?php echo($children); ?>"> 
			             	</div>
			              </div>
			              <div class="col-md-4">
			                <div class="form-group ">
			                	<label class="text-white ml-3">Number of Infants</label>
			                	<input class="form-control" type="number" name="infants" required placeholder="No. of Infants" value="<?php echo($infants); ?>"> 
			             	</div>
			              </div>
			            </div>
			            <div class="row">
			              <div class="col-md-6">
			               	<label class="text-white ml-3">Date</label>
			                <div class="form-group"> <input class="form-control" name="date" type="date" required value="<?php echo($date); ?>"><!--  <span class="form-label">Check In</span> --> </div>
			              </div>
			              <div class="col-md-6 mt-1">
							<button class="submit-btn mt-4">Search</button>
			              </div>
			            </div>
			            <!-- <div class="form-btn"> <button class="submit-btn">Book Now</button> </div> -->
			          </form>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
	    </div>
	</div>
    <?php if(count($product_list)){ ?>

	    <div class="album py-5 bg-light">
	        <div class="container">
		        <div class="row">
	          	<?php foreach($product_list as $key => $value) { ?>
		            <div class="col-md-4">
		              <div class="card mb-4 box-shadow">

		                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?php echo $value['images']; ?>" data-holder-rendered="true">
		                <div class="card-body">
		                	<h2 class="h4"><?php echo $value['name']; ?></h2>
		                  	<p class="card-text"><?php echo $value['shortDescription']; ?></p>
							<div class="d-flex justify-content-between align-items-center">
								<big class="text-muted"><?php echo $value['currency'].' '.$value['price']; ?></big>
								<div class="btn-group">
								  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> -->
								  <a type="button" class="btn btn-sm btn-outline-secondary" href="payment.php?data=<?php echo $value['base_64']; ?>">Book</a>
								</div>
							</div>
		                </div>
		              </div>
		            </div>
		    	 <?php } ?>

		  	  </div>
			</div>
		</div>
    <?php }?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="dist/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="dist/assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
