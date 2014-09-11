<div style="background:rgb(28, 49, 37);">
<div style="margin-bottom:80px;">
	<?php
		echo $this->Html->image(
			'/img/header.jpg',
			array(
				'width' => '855px'
			));
		?>
	<nav class="art-nav">
	<ul class="art-hmenu">
		<li><?php echo $this->Html->link('Home', '/');?></li>
		<li class="dropdown" ><?php echo $this->Html->link('My Listings', array('controller' => 'properties', 'action' => 'index'), array('class' => 'active'));?>
		<ul class="sub-menu">
			<li><?php echo $this->Html->link('All Listings', array('controller' => 'properties', 'action' => 'index'));?></li>
			<li><?php echo $this->Html->link('New Listings', array('controller' => 'properties', 'action' => 'new_listings'));?></li>
			<li><?php echo $this->Html->link('Just Sold', array('controller' => 'properties', 'action' => 'sold_listings'));?></li>
		</ul></li>	
		<li><?php echo $this->Html->link('Buying', '/buying');?></li>
		<li><?php echo $this->Html->link('Selling', '/selling');?></li>
		<li><?php echo $this->Html->link('中 文', '/chinese');?></li>
		<li><?php echo $this->Html->link('About Me', '/about_me');?></li>
		<li><?php echo $this->Html->link('Contacts', '/contacts');?></li>
	</ul> 
	</nav>         	
</div>



<div  style="text-align: center; margin-top:20px; border:1px;">
	<h2><span style="font-weight: bold; ">
		<?php echo $property['Property']['address']; ?>
		, 
		<?php echo $property['Property']['city']; ?></span>
	</h2>
</div>
	
	
<div style="width:700px; height:450px; 
				border: 1px solid #93946B;
				margin-left:80px;
				margin-top:50px;
				background:#93946B">
	<ul class="tab-button"><li><?php echo $this->Html->link('Photos', array( 'controller' => 'properties', 'action' => 'view', $property['Property']['property_id'])); ?></li>
		<li class="current">Map</li>
	</ul>
	
	<?php $address = $property['Property']['address'].' '.
						$property['Property']['city'].' '.
						$property['Property']['province'].' '.
						$property['Property']['country'];
	?>
	<iframe
	width="648px"
	height="398px" style="margin-top:25px;margin-left:25px;"
	frameborder="0" style="border:0"
	src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCHai4kDB8GFfsWdHjkdC31hpNt9p_2_x4
    &q=<?php echo $address ?>">
	</iframe>
</div>
<div class="tab-container big-tabs" 
		Style="width:99%; ">
						
					<ul class="etabs">
				    	<li><a href="#desc">Description</a></li>
				    	<li><a href="#mortgage">Mortgage</a></li>
				    	<li><a href="#inquire">Inquiring</a></li>
					</ul>
					<div id="desc" class="panel" style="color:white;">
				    	<h2 class="title"><span>Property Address</span></h2>
						<br />
						<p ><?php 
						$address = $property['Property']['address'].' '.
						$property['Property']['city'].' '.
						$property['Property']['province'].' '.
						$property['Property']['country'];
						echo $address ?></p>
						
						<br />
						<h2 class="title"><span>Property Features</span></h2>
						<br />
						<p ><?php echo $property['Property']['description']; ?></p>
						<br />
						
						<h2 class="title"><span>Property Information</span></h2>
						<div style="margin-top:30px;">
                        <div style="  ">
							<ul id="attribute">
								<li>Property Price</li>
								<li>Property Status</li>
								<li>MLS Number</li>
								<li>Property Type</li>
								<li>Property Taxes</li>
								<li>Maintenance Fee</li>
								
							</ul>
							
							<ul id="value">
							<li style="color:red;">$<?php echo $price = number_format($property['Property']['price']); ?></li>
							<?php 	
									$property_status = '';
									if ( $property['Property']['property_status'] == 1) 
									{
										$property_status = 'Active';
									}
									else if ( $property['Property']['property_status'] == 2) 
									{
										$property_status = 'SOLD';
									}
							?>
								<li><?php echo $property_status; ?></li>
								<li><?php echo $property['Property']['mls_number']; ?></li>
								<li><?php echo $property['Property']['property_type']; ?></li>
								<li>$<?php echo number_format($property['Property']['property_tax']); ?></li>
								<li>$<?php echo number_format($property['Property']['maintenance_fee']); ?></li>
								
							</ul>
						</div>
						<div style="">
							<ul id="attribute">
								<li>Bedrooms</li>
								<li>Bathrooms</li>
								<li>Floor Area</li>
								<li>Lot Frontage</li>
								<li>Lot Depth</li>
								<li>Age</li>
							</ul>
							<ul id="value">
								<li><?php echo $property['Property']['bedroom']; ?></li>
								<li><?php echo $property['Property']['bathroom']; ?></li>
								<li><?php echo $property['Property']['area']; ?> sq.ft.</li>
								<li><?php echo $property['Property']['lot_frontage']; ?> ft</li>
								<li><?php echo $property['Property']['lot_depth']; ?> ft</li>
								<li><?php echo $property['Property']['age']; ?></li>
								
							</ul>
							
						</div>
						
						
						</div>
						
						
					</div>
					<?php 
					if (isset($_POST['submit'])) {
					echo $_POST['interest']; 
					}?>	
					
				<div id="mortgage" class="panel">
					<h3 style="color:white">Mortgage Calculator</h3>
					<br />
					<div style="width:49%; color:white;">
					
				
						<label for="interest">Interest Rate</label>
						<input type="text" id="interest" name="interest" value="5"/> %
						<label for="term">Term</label>
						<input type="text" id="term" value="25" /> years
						<label for="down">Down Payment</label>
						<input type="text" id="down" value="<?php echo $property['Property']['price']*0.05; ?>" /> $
						<input type="hidden" id="price" value="<?php echo $property['Property']['price']; ?>" />
						<input type="hidden" id="maintenance" value="<?php echo $property['Property']['maintenance_fee']; ?>" />
						<input type="hidden" id="age" value="<?php echo $property['Property']['age']; ?>" />
						<input type="hidden" id="propertyTax" value="<?php echo $property['Property']['property_tax']; ?>" />
					</div> 
					<button onclick="mortgageCalculator()" onload = "mortgageCalculator()" >Calculate</button>
					
					<script>
					function mortgageCalculator()
					{
						var propertyTax = parseFloat(document.getElementById('propertyTax').value);
						var age = parseFloat(document.getElementById('age').value);
						var monthlyMaintenance = parseFloat(document.getElementById('maintenance').value);
						var interestRate = parseFloat(document.getElementById('interest').value);
						var term = parseFloat(document.getElementById('term').value);
						var downPayment = parseFloat(document.getElementById('down').value);
						var price = parseFloat(document.getElementById('price').value);
						var mortgage = price - downPayment;
						var insurance = mortgage * 0.035;
						//gst included
						if ( age == 0)
						{
							var GST = price *0.05;
						}
						else 
						{
							var GST = 0;
						}
						if ( price <= 200000 )
						{
							var PPT = price * 0.01;
						}
						else if ( price > 200000)
						{
							var PPT = 200000 * 0.01 + (price - 200000) * 0.02;
						}
						var GSTPPT = GST + PPT;
						
						var totalMortgage = mortgage + insurance + GSTPPT;
						
						
						var monthlyMortgage = mortgage * interestRate/100 * Math.pow((1 + interestRate/100 ), term) /  ((1 + interestRate/100 )^term - 1);
						var monthlyPropertyTax = propertyTax /12;
						var totalMonthlyMortgage = monthlyMortgage + monthlyPropertyTax + monthlyMaintenance;
						
						downPayment = accounting.formatMoney(downPayment, "$");
						mortgage = accounting.formatMoney(mortgage, "$");
						insurance = accounting.formatMoney(insurance, "$");
						GSTPPT = accounting.formatMoney(GSTPPT, "$");
						
						totalMortgage = accounting.formatMoney(totalMortgage, "$");
						monthlyMortgage = accounting.formatMoney(monthlyMortgage, "$", 2);
						monthlyPropertyTax = accounting.formatMoney(monthlyPropertyTax, "$");
						monthlyMaintenance = accounting.formatMoney(monthlyMaintenance, "$");
						totalMonthlyMortgage = accounting.formatMoney(totalMonthlyMortgage, "$");
						
						
		
						document.getElementById("down_value").innerHTML=downPayment;
						document.getElementById("mortgage_value").innerHTML=mortgage;
						
						document.getElementById("insurance_value").innerHTML=insurance;
						document.getElementById("GSTPPT_value").innerHTML=GSTPPT;
						
						document.getElementById("totalMortgage_value").innerHTML=totalMortgage;
						document.getElementById("monthlyMortgage_value").innerHTML=monthlyMortgage;
						document.getElementById("monthlyPropertyTax_value").innerHTML=monthlyPropertyTax;
						document.getElementById("monthlyMaintenance_value").innerHTML=monthlyMaintenance;
						document.getElementById("totalMonthlyMortgage_value").innerHTML=totalMonthlyMortgage;
						
						
						
						
						
				
					}
					</script>
				
					<div style="float:right;margin-top:-130px">
					<h2 style="background-color:#304032;text-align:center;width:51%">Summary</h2>
					<table>
					<tr>
						<th style="width:300px">Mortgage Term</th>
						<th style="width:100px">Amount</th>
					</tr>
					<tr>
						<td>Down Payment</td>
						<td id="down_value" style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<td>First Mortgage Amount</td>
						<td id="mortgage_value" style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<td>Insurance Fee (3.5% of Mortgage)</td>
						<td id="insurance_value" style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<td>Property Sales and Transfer Taxes</td>
						<td id="GSTPPT_value" style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<th style="width:300px;text-align:left;">Total Mortgage Payment</th>
						<th id="totalMortgage_value" style="width:100px;text-align:right;">$</th>
					</tr>
					<tr>
						<td>Monthly Mortgage Payment</td>
						<td id="monthlyMortgage_value" style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<td>Estmated Monthly Property Taxes</td>
						<td id= "monthlyPropertyTax_value" style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<td>Monthly Condo Maintenane Fee</td>
						<td id="monthlyMaintenance_value"style="text-align:right;color:black;">$</td>
					</tr>
					<tr>
						<th style="width:300px;text-align:left;">Total Monthly Payment</th>
						<th id = "totalMonthlyMortgage_value" style="width:100px;text-align:right;">$</th>
					</tr>
					</table>
					</div>
						
				</div>
				  	
				<div id="inquire" class="panel">
					<h2 style="color:white;">Send us your questions about this property</h2>
					<div style="width:50%; color:white;">
				    	<?php echo $this->Form->create('Property', array( 'action' => 'inquire')); 
						?>
						
						<?php
						
						
						echo $this->Form->input('name', array('label' => 'Name','required'));
						echo $this->Form->input('email', array('label' => 'Email', 'required'));
						echo $this->Form->input('phone', array('label' => 'Phone', 'required')); 
						echo $this->Form->input('property_id', array('type' => 'hidden', 'value' => $property['Property']['property_id'])); 

						?>
						<label for="">Message / Question:</label>
						<?php echo $this->Form->textarea('message', 
										array( 
										'form' => 'contact',
										'rows' => 8,
										'cols' => 50,
										'required'
										)); ?>
						
						
						<?php echo $this->Form->end('Submit'); ?>
						<?php
						/**
							echo $this->Form->input('last_name', array('placeholder' => 'Last Name', 'label' => 'Last Name:')); 
							echo $this->Form->input('phone_number', array('placeholder' => 'Phone Number ', 'label' => 'Phone Number: '));
							echo $this->Form->input('email_address', array('placeholder' => 'Email:', 'label' => 'Email'));							
							echo $this->Form->textarea('Message', 
										array( 
										'form' => 'contact',
										'rows' => 5
										)); 
							echo $this->Form->end('submit');
							*/
						?>
					
					</div>
				</div>	
					
					
	</div>
</div>
	
<?php
echo $this->Html->script('jquery.fancybox.js');
	echo $this->Html->script('jquery.fancybox-thumbs.js');
	?>
	
<script  type="text/javascript">
$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
			openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,
				prevEffect : 'fade',
				nextEffect : 'fade',

				closeBtn  : true,
				arrows    : true,
				nextClick : true,
				width  : 150,
						height : 150,
				
				helpers : {
					thumbs : {
						width  : 150,
						height : 150
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	
 <script type="text/javascript">
    $(document).ready( function() {
      $('.tab-container').easytabs();
    });
 </script>	
<?php
echo $this->Html->script('/js/singleProperty/jquery.easytabs.min.js');
?>