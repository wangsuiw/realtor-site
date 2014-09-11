<table>
<?php
	echo $this->Form->create('Property', array('action' => 'search')); 
	echo $this->Form->input('keyword', array('label' => 'Search Keyword<br/>')); 
	echo $this->Form->end(__('Submit'));
	
	echo $this->Html->tableHeaders(array(
		 'MLS Number',
		'Address', 
		'City', 
		'Price'
	));
	
	
	
	$rows = array();
	foreach ($properties as $property )
	{
		$rows[]= array(
			$property['Property']['mls_number'], 
			$property['Property']['address'], 
			$property['Property']['city'], 
			$property['Property']['price']);
			
	}
	echo $this->Html->tableCells($rows);
	
?>
</table>
<div>
<?php echo $this->paginator->numbers();?>
</div>
	
