<?php
require_once('vendor/autoload.php');
$data =isset($_GET['data'])?$_GET['data']: null;
$name = 'Simran Gupta';
if($data != null){
	$product = json_decode(base64_decode($data));

}else{
	header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  </head>
  <body>

    <div class="container">
    	<div class="screen flex-center">
			<form class="popup flex p-lg" action="done.php" method="get">
				<input type="hidden" name="data" value="<?php echo $data; ?>">
			    <div class="close-btn pointer flex-center p-sm">
			      <i class="ai-cross"></i>
			    </div>
			    
			      <!-- CARD FORM -->
			    <div class="flex-fill flex-vertical">
			        <div class="header flex-between flex-vertical-center">
			          <div class="flex-vertical-center">
			            <i class="ai-bitcoin-fill size-xl pr-sm f-main-color"></i>
			            <span class="title">
			              <strong>Stripe Pay Mock</strong>
			            </span>
			          </div>
			        </div>
			        <div class="card-data flex-fill flex-vertical">
			          
			          <div class="flex-between flex-vertical-center">
			            <div class="card-property-title">
			              <strong>Card Number</strong>
			            </div>
			            <div class="f-main-color pointer"><i class="ai-pencil"></i> </div>
			          </div>
			          
			          <div class="flex-between">
			            <div class="card-number flex-vertical-center flex-fill">
			              <div class="card-number-field flex-vertical-center flex-fill">
			                
			                
							<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="24px" height="24px"><path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"/><path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"/><path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"/></svg>
			                
			                
			                <input class="numbers" type="number" min="1" max="9999" placeholder="4242">-
			                <input class="numbers" type="number" placeholder="4242">-
			                <input class="numbers" type="number" placeholder="4242">-
			                <input class="numbers" type="number" placeholder="4242" data-bound="carddigits_mock" data-def="4242">
			              </div>
			              <i class="fa fa-check-circle fa-1x" aria-hidden="true"></i>
			            </div>
			          </div>
			          
			          <!-- Expiry Date -->
			          <div class="flex-between">
			            <div class="card-property-title">
			              <strong>Expiry Date</strong>
			            </div>
			            <div class="card-property-value flex-vertical-center">
			              <div class="input-container half-width">
			                <input class="numbers" data-bound="mm_mock" data-def="00" type="number" min="1" max="12" step="1" placeholder="MM">  
			              </div>
			              <span class="m-md">/</span>
			              <div class="input-container half-width">
			                <input class="numbers" data-bound="yy_mock" data-def="01" type="number" min="23" max="99" step="1" placeholder="YY">
			              </div>
			            </div>
			          </div>
			          
			          <div class="flex-between">
			            <div class="card-property-title">
			              <strong>CVC</strong>
			            </div>
			            <div class="card-property-value">
			              <div class="input-container">
			                <input id="cvc" type="password">
			                <i id="cvc_toggler" data-target="cvc" class="ai-eye-open pointer"></i>
			              </div>
			            </div>
			          </div>
			          
			          <!-- Name -->
			          <div class="flex-between">
			            <div class="card-property-title">
			              <strong>Cardholder Name</strong>
			            </div>
			            <div class="card-property-value">
			              <div class="input-container">
			                <input id="name" data-bound="name_mock" data-def="Mr. Cardholder" type="text" class="uppercase" placeholder="CARDHOLDER NAME" value="<?php echo($name) ?>">
			                <i class="ai-person"></i>
			              </div>
			            </div>
			          </div>
			          <!-- Name -->
			          <div class="flex-between">
			            <div class="card-property-title">
			              <strong>Phone number</strong>
			            </div>
			            <div class="card-property-value">
			              <div class="input-container">
			                <input id="number" data-bound="number_mock" type="text" class="uppercase" placeholder="Phone number" value="+91 1234 567 890">
			                <i class="ai-person"></i>
			              </div>
			            </div>
			          </div>
			          
			          
			        </div>
			        <div class="action flex-center">
			          <button type="submit" class="b-main-color pointer">Pay Now</button>
			        </div>
			    </div>
			    
			      <!-- SIDEBAR -->
			    <div class="sidebar flex-vertical">
			    <div>
			    </div>
			        <div class="purchase-section flex-fill flex-vertical">
			          
			          <div class="card-mockup flex-vertical">
			            <div class="flex-fill flex-between">
			            	<div class="text-center" style="width: 100%; margin-top: 20px;">
			              		<i class="fa fa-wifi fa-3x" aria-hidden="true"></i>
			              	</div>
			            </div>
			            <div>
			              <div id="name_mock" class="size-md pb-sm uppercase ellipsis"><?php echo "$name"; ?></div>
			              <div class="size-md pb-md">
			                <strong>
			                  <span class="pr-sm">
			                    &#x2022;&#x2022;&#x2022;&#x2022;
			                  </span>
			                  <span id="carddigits_mock">4242</span>
			                </strong>
			              </div>
			              <div class="flex-between flex-vertical-center">
			                <strong class="size-md">
			                  <span id="mm_mock">01</span>/<span id="yy_mock">23</span>
			                </strong>
			                
			                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="24px" height="24px"><path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"/><path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"/><path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"/></svg>
			              </div>
			            </div>
			          </div>
			          
			          <ul class="purchase-props" style="margin-top: 40px;">
			            <li class="flex-between">
			              <span>Company</span>
			              <strong>Touch It</strong>
			            </li>
			            <li class="flex-between">
			              <span>OrderId</span>
			              <strong><?php echo($product->price_id); ?></strong>
			            </li>
			            <li class="flex-between">
			              <span>Product Batch no.</span>
			              <strong><?php echo($product->productCode); ?></strong>
			            </li>
			            <li class="flex-between">
			              <span>Amount</span>
			              <strong><?php echo $product->price; ?> <?php echo($product->currency); ?> </strong>
			            </li>
			          </ul>
			        </div>
			        <div class="separation-line"></div>
			        <div class="total-section flex-between flex-vertical-center">
			          <div class="flex-fill flex-vertical">
			            <div class="total-label f-secondary-color">Deposit Amount(20%)</div>
			            <div>
			              <strong><?php echo $product->price/5; ?></strong>
			              <small><span class="f-secondary-color"><?php echo $product->currency; ?></span></small>
			            </div>
			          </div>
			          <i class="ai-coin size-lg"></i>
			        </div>
			      </div>
			  </d>
			</form>
		</div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/dist/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/dist/assets/js/vendor/popper.min.js"></script>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
  <script type="text/javascript">
  	
/* COPY INPUT VALUES TO CARD MOCKUP */
const bounds = document.querySelectorAll('[data-bound]');

for(let i = 0; i < bounds.length; i++) {
  const targetId = bounds[i].getAttribute('data-bound');
  const defValue = bounds[i].getAttribute('data-def');
  const targetEl = document.getElementById(targetId);
  bounds[i].addEventListener('keyup', () => targetEl.innerText = bounds[i].value || defValue );
}


/* TOGGLE CVC DISPLAY MODE */
const cvc_toggler = document.getElementById('cvc_toggler');

cvc_toggler.addEventListener('click', () => {
  const target = cvc_toggler.getAttribute('data-target');
  const el = document.getElementById(target);
  el.setAttribute('type', el.type === 'text' ? 'password' : 'text');
});

  </script>
</html>
