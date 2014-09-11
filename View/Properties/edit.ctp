<article class="module width_full clear" style="width: 950px;">
<?php
	echo $this->Form->create('Property', array (  
										'type' => 'file'
										)); 
?>

	
<header><h3>Property Information</h3></header>
<div class="module_content">

	<fieldset>
		<?php echo $this->Form->input('property_status', 
										array( 
										'options' => array(
													1 => 'Active',
													2 => 'Sold',
													3 => 'Inactive'
													),
										'empty' => '(Choose One)',
										'label' => 'property status *'
										)); ?>
	</fieldset>
	<fieldset>
		<?php echo $this->Form->input('property_type', 
										array( 
										'options' => array(
													1 => 'House',
													2 => 'Apartment',
													3 => 'Duplex',
													4 => 'Commercial Property'
													),
										'empty' => '(Choose One)',
										'label' => 'property type *'
										)); ?>
	</fieldset>
	<fieldset>
		<label>Property Location</label>
		<br />
		<br />
		<?php echo $this->Form->input('address', 
										array( 
										'placeholder' => 'Address',
										'label' => false
										
										)); ?>
		<?php echo $this->Form->input('city', 
										array( 
										'placeholder' => 'City',
										'label' => false
										
										)); ?>
		<?php echo $this->Form->input('province', 
										array( 
										'label' => false,
										'value' => 'British Columbia'
										)); ?>

		<?php echo $this->Form->input('country', 
										array( 
										'label' => false,
										'value' => 'Canada'
										)); ?>
	
	</fieldset>
	<fieldset>
		<label>Property Description</label>
		<?php echo $this->Form->textarea('description', 
										array( 
										'form' => 'Property',
										'rows' => 5
										)); ?>

	</fieldset>	
	<fieldset style="width:20%; float:left; margin-right: 0.5%;">
	
		<?php echo $this->Form->input('mls_number', 
										array( 
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:20%; float:left; margin-right: 0.5%;">
	
		<?php echo $this->Form->input('price', 
										array(
										'label' => 'price ($)',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:20%; float:left; margin-right: 0.5%;">
	
		<?php echo $this->Form->input('age', 
										array( 
										'label' => 'age',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:20%; float:left;  margin-right: 2%;">
	
		<?php echo $this->Form->input('maintenance_fee', 
										array( 
										'label' => 'Maintenance Fee ($)',
										'style' => 'width:80%;',
										'value' => 0
										)); ?>
	
	</fieldset>	
	<fieldset style="width:100%;">
	<label><h3>House Measurement</h3></label>
	<br />
	<br />
	
	<fieldset style="width:20%; float:left; margin-right: 5%;">
	
		<?php echo $this->Form->input('area', 
										array( 
										'label' => 'Area (sq.ft.)',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:20%; float:left; margin-right: 5%;">
	
		<?php echo $this->Form->input('lot_frontage', 
										array( 
										'label' => 'Lot Frontage (ft)',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:20%; float:left; margin-right: 20%;">
	
		<?php echo $this->Form->input('lot_depth', 
										array( 
										'label' => 'lot depth (ft)',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>
	</fieldset>		
	<fieldset style="width:100%;">
	<label><h3>Rooms And Flooring</h3></label>
	<br />
	<br />
	<fieldset style="width:20%; float:left; margin-right: 5%;">
	
		<?php echo $this->Form->input('bedroom', 
										array( 
										'label' => 'bedroom',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:20%; float:left; margin-right: 5%;">
	
		<?php echo $this->Form->input('bathroom', 
										array( 
										'label' => 'bathroom',
										'style' => 'width:80%;'
										)); ?>
	
	</fieldset>	
	<fieldset style="width:23%; float:left; margin-right: 20%;">
	
		<?php echo $this->Form->input('basement', 
										array( 
										'options' => array(
													1 => 'None',
													2 => 'Half',
													3 => 'Full'
													),
										'empty' => '(Choose one)'
										
										)); ?>
	
	</fieldset>	
	</fieldset>
	<h2>Open House</h2>
	<?php echo $this->Form->input('open_house', array(
												'type' => 'datetime',
												'label' => false
												)); ?>
	
	<fieldset style=" float:left;  margin-right: 500%;" >
	
		<?php echo $this->Form->input('file', array(
												'type' => 'file', 
												'multiple',
												'label' => 'upload Front A Image:'
												)); ?>
	
	</fieldset>
	<fieldset style=" float:left;  margin-right: 500%;" >
	
		<?php echo $this->Form->input('files.', array(
												'type' => 'file', 
												'multiple',
												'label' => 'upload Images:'
												)); ?>
	
	</fieldset>	
	
</div>
<?php echo $this->Form->input('post_date', array(
											'type' => 'hidden',
											'value' => NULL
											));?>
<?php echo $this->Form->input('property_id', array(
											'type' => 'hidden'
											));?>											
<footer style=" float:left;  margin-right: 500%;">
	<div class="submit_link"  >
	<?php echo $this->Form->end('Submit'); ?>
	</div>
	
</footer>
</article>
	