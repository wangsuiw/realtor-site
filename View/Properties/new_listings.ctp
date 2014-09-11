<div style="background:#0F1410;">
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

<h2 class="heading" style="margin-bottom:20px"><span>My Listings</span></h2>
<div style=" float: right; right:100px;top:-50px;position:relative;">
Sort By: 
<select id="mySelect" onchange="if(this.options[this.selectedIndex].value != ''){window.top.location.href=this.options[this.selectedIndex].value}">
 <option value=" ">---- Options ----</option>
 <option value="<?php echo $this->webroot; ?>properties/index/sort:price/direction:asc">Price: Low to High </option>
 <option value="<?php echo $this->webroot; ?>properties/index/sort:price/direction:desc">Price: High to Low</option>
 <option value="<?php echo $this->webroot; ?>properties/index/sort:area/direction:asc">Area: Low to High</option>
 <option value="<?php echo $this->webroot; ?>properties/index/sort:area/direction:desc">Area: High to Low</option>
 </select> 
</div>

<?php 
	foreach ($properties as $property)
	{	
		$time_now = new DateTime('now');
		$post_date = new DateTime($property['Property']['post_date']);
		$post_date->modify("+30 days");
		if($time_now < $post_date && $property['Property']['property_status'] == 1)
		{
?>
		<div class="listing" style="
		margin-top: 3px;  
		border: 1px solid #304032; 
		width: 100%; 
		height: 300px;">
		<div style="float: left; width: 425px; ">
		
		<?php
		echo $this->Html->image(
			'/img/property/'.$property['Property']['property_id'].'/400x250/'.$property['Property']['image'],
			array(
				'width' => '400px',
				'height' => '250px',
				'style' => 'margin-top:25px; margin-left:25px;position: absolute; ',
				'url' => array(
						'controller' => 'properties',
						'action' => 'view',
						$property['Property']['property_id'])
				
			));
		?>
	
		<?php
		if($property['Property']['property_status'] == 2)
		{
		echo $this->Html->image(
			'/img/sold.png',
			array(
				'width' => '400px',
				'height' => '250px',
				'style' => 'margin-top:25px; margin-left:25px; position: absolute; z-index:99;',
				'url' => array(
						'controller' => 'properties',
						'action' => 'view',
						$property['Property']['property_id'])
				
			));
		}
		?>
		<?php
		$time_now = new DateTime('now');
		$post_date = new DateTime($property['Property']['post_date']);
		$post_date->modify("+30 days");
		if($time_now < $post_date && $property['Property']['property_status'] == 1)
		{
		echo $this->Html->image(
			'/img/new-listing.png',
			array(
				'width' => '420px',
				'height' => '270px',
				'style' => 'margin-top:15px; margin-left:7px; position: absolute; z-index:100;',
				'url' => array(
						'controller' => 'properties',
						'action' => 'view',
						$property['Property']['property_id'])
				
			));
		}
		?>
		<?php
		$time_now = new DateTime('now');
		$open_house = new DateTime($property['Property']['open_house']);
		
		if( $open_house > $time_now)
		{
		
		?>
		<p style="color:red;font-weight:bold;margin-top:132px; margin-left:710px; float:left;position: absolute; z-index:101;">Open House</p>
		<p style="color:red;font-weight:bold;margin-top:152px; margin-left:710px; float:left;position: absolute; z-index:101;"><?php $date = new DateTime($property['Property']['open_house']); echo date_format($date, 'l, F jS'); ?></p>
		<p style="color:red;font-weight:bold;margin-top:172px; margin-left:710px; float:left;position: absolute; z-index:101;"><?php $date = new DateTime($property['Property']['open_house']); echo date_format($date, 'g:ia'); ?></p>
		<?php }?>
		</div>
		
		<div style="margin-top:25px; margin-left:450px; float:left;position: absolute; color:#93946B;">
		
		<h2><?php echo $property['Property']['address'].', '.$property['Property']['city']; ?></h2>
		<hr />
		<br />
		<h1 style="color:white;">$<?php echo number_format($property['Property']['price']); ?></h1>
		<br />
		<div style=" float:left; ">
			<ul id="attribute">
				<li>MLS Number</li>
				<li>Property Type</li>
				<li>Bedrooms</li>
				<li>Bathrooms</li>
				<li>Flooring Area</li>
				<li>Age</li>
			</ul>
			<ul id="value">
				<li><?php echo $property ['Property']['mls_number']; ?></li>
				<li><?php echo $property ['Property']['property_type']; ?></li>
				<li><?php echo $property ['Property']['bedroom']; ?></li>
				<li><?php echo $property ['Property']['bathroom']; ?></li>
				<li><?php echo $property ['Property']['area']; ?></li>
				<li><?php echo $property ['Property']['age']; ?></li>
			</ul>
			<?php echo $this->Html->link('Enter', array(  'action' => 'view', $property['Property']['property_id']), array('class' => 'button', 'style' => 'margin-top:100px'));?>
</div>
		</div>
		</div>

<?php }
	}?>

<div style="margin-top: 30px; margin-bottom: 20px">
<?php 
echo $this->paginator->prev(' Prev ', array('class' => 'prev-page'), null, array());
echo $this->paginator->numbers( array('class' => 'page-number'));
echo $this->paginator->next('Next ', array('class' => 'next-page'), null, array());
?>
</div>
</div>