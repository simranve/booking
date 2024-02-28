<?php
require_once('vendor/autoload.php');
$no_adults = isset($_POST['no_adults'])?$_POST['no_adults']: null;
$no_children =  isset($_POST['no_children'])?$_POST['no_children']: null;
$no_infants =  isset($_POST['no_infants'])?$_POST['no_infants']: null;
$start_date =  isset($_POST['start_date'])?$_POST['start_date']: null;
$product_list = [];
if(isset($_POST['no_adults']) && $_POST['no_adults']){
	// $input = [];
	if(isset($_POST['no_adults']) && $_POST['no_adults']) $input['no_adults'] = $_POST['no_adults'];
	if(isset($_POST['no_children']) && $_POST['no_children']) $input['no_children'] = $_POST['no_children'];
	if(isset($_POST['no_infants']) && $_POST['no_infants']) $input['no_infants'] = $_POST['no_infants'];
	if(isset($_POST['start_date']) && $_POST['start_date']) $input['start_date'] = $_POST['start_date'];
	$parameters =  http_build_query($input);
	// echo $parameters;

	$client = new \GuzzleHttp\Client();
	$response = $client->request('GET', 'https://api.rezdy-staging.com/v1/products/marketplace?apiKey=69f708868ddc45eaa1f9b9fad1ddeba5&limit=48&'.$parameters, [
	  'headers' => [
	    'accept' => 'application/json',
	  ],
	]);
	$response = json_decode($response->getBody());
	$all_products = [];

	if(isset($response->requestStatus) && isset($response->requestStatus->success) && $response->requestStatus->success == true){
		$all_products = $response->products;
		if(count($all_products)){
			foreach ($all_products as $key => $value) {
				if(isset($value->priceOptions)){

					$product_list[$key]['images'] = (count($value->images))?$value->images[0]->thumbnailUrl:'assets/img/thumbnail.png';
					$product_list[$key]['name'] =  $value->name;
			        $product_list[$key]['shortDescription'] =  $value->shortDescription;
			        $product_list[$key]['price'] =  (count($value->priceOptions))?$value->priceOptions[0]->price:'NA';
			        $product_list[$key]['price_id'] =  (count($value->priceOptions))?$value->priceOptions[0]->id:null;
			        $product_list[$key]['currency'] =  $value->currency;
			        $product_list[$key]['productCode'] =  $value->productCode;
			        $product_list[$key]['base_64'] = base64_encode(json_encode($product_list[$key]));
			        $product_list[$key]['priceOptions'] =  $value->priceOptions;
				}
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
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    // Get today's date
    $(document).ready(function() { //DISABLED PAST DATES IN APPOINTMENT DATE
        var dateToday = new Date();
        var month = dateToday.getMonth() + 1;
        var day = dateToday.getDate();
        var year = dateToday.getFullYear();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        $('#start_date').attr('min', maxDate);
    });
    </script>
    <div style="padding: 90px;">
        <div class="container" style="">
            <div id="booking" class="section">
                <div class="section-center">
                    <div class="container">

                        <div class="booking-form">
                            <div class="form-header">
                                <h2 class="h2 text-black text-bold">Make Your Reservation here!!</h2>
                            </div>
                            <form method="post" class="search_form">
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <h3 class="text-black ml-3">No of Adults</h3>
                                        </div>
                                    </div>    
								<div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" min="1" type="number" name="no_adults" required
                                                placeholder="No. of Adults" value="<?php echo($no_adults); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
								<div class="col-md-6">
                                        <div class="form-group">
                                            <h3 class="text-black ml-3">No of Children</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <input class="form-control" min="0" type="number" name="no_children"
                                                required placeholder="No. of Children"
                                                value="<?php echo($no_children); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
								<div class="col-md-6">
                                        <div class="form-group">
                                            <h3 class="text-black ml-3">No. of Infants</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <input class="form-control" min="0" type="number" name="no_infants" required
                                                placeholder="No. of Infants" value="<?php echo($no_infants); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
								<div class="col-md-6">
                                        <div class="form-group">
                                            <h3 class="text-black ml-3">Date to book</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
									<div class="form-group"> <input class="form-control" min="" id="start_date"
                                                name="start_date" type="date" required
                                                value="<?php echo($start_date); ?>">
                                            <!--  <span class="form-label">Check In</span> -->
                                        </div>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-md-12 mt-1">
                                        <button class="submit-btn mt-4" onclick="this.classList.toggle('button--loading')">Search</button>
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
	<div class="text-center loader_div" style="display: none;"><div class="loader"></div></div>
    <?php if(count($product_list)){ ?>

    <div class="album py-5 bg-dark">
	<!-- <h2>Products listing here</h2> -->
	<div class="container">
            <div class="row">
                <?php foreach($product_list as $key => $value) { ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">

                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=No Image here"
                            alt="No image here" style="height: 225px; width: 100%; display: block;"
                            src="<?php echo $value['images']; ?>" data-holder-rendered="true">
                        <div class="card-body">
                            <h2 class="h6"><?php echo $value['name']; ?></h2>
                            <p class="card-text"><?php echo $value['shortDescription']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="justify-content-between align-items-center">
                            <?php if(isset($value['priceOptions']) && count($value['priceOptions'])){ foreach ($value['priceOptions'] as $key1 => $value1) { if($key1 <3){ 
									if($key1 == 0) $label = 'Adult';
									if($key1 == 1) $label = 'Child';
									if($key1 == 2) $label = 'Infant';?>
									<big class="text-muted"><?php echo $value1->price.' per '.$label; ?></big><br>
								<?php }}}else{?>	
								<big class="text-muted"><?php echo $value['price']; ?>/Adult</big>
								<?php }?>
                                </div>
                                <div class="btn-group">
                                    <a type="button" class="btn btn-sm btn-outline-secondary"
                                        href="product.php?data=<?php echo $value['base_64']; ?>">View product</button>
                                        <a type="button" class="btn btn-outline-secondary"
                                            href="pay.php?data=<?php echo $value['base_64']; ?>">Book Now!!</a>
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
    <script>
    window.jQuery || document.write('<script src="assets/dist/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="assets/dist/assets/js/vendor/popper.min.js"></script>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/assets/js/vendor/holder.min.js"></script>
    <script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'No image here'
    });
    </script>
    <script type="text/javascript">
      	$( document ).ready(function() {
		   $(".search_form").submit(function(evt) {
		   	console.log('hi');
		      $(".loader_div").show();
		  });
		});
    </script>
</body>

</html>