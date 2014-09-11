

<article class="module width_full">
<header><h3>My Properties</h3></header>


<table class="tablesorter" cellspacing="0" style="text-align:center;">
<thead> 
<?php

	echo $this->Html->tableHeaders(array(
	/**
		$this->paginator->sort('property_id', 'Id'),
		$this->paginator->sort('mls_number', 'MLS Number'),
		$this->paginator->sort('address', 'Address'), 
		$this->paginator->sort('city', 'City'), 
		$this->paginator->sort('price', 'Price'),
	**/
		'Id',
		'MLS Number',
		'Property Status',
		'Address',
		'City',
		'Price',
		'Open House',
		'Actions'
	));
	
?>
</thead>
<tbody>  
<?php
	
	$rows = array();
	foreach ($properties as $property )
	{
		//check the status of the property: active, sold, or inactive.
		$status;
		if($property['Property']['property_status'] == 1)
		{
			$status = 'active';
		}
		else if($property['Property']['property_status'] == 2)
		{
			$status = 'sold';
		}
		else if($property['Property']['property_status'] == 3)
		{
			$status = 'inactive';
		}
		//check the open house date is passed or not
		$open_house_datetime = date_create($property['Property']['open_house']);
		$open_house_timestamp = date_format($open_house_datetime, 'YmdHis');
		$current_datetime = new DateTime();
		$current_timestamp = date_format($current_datetime, 'YmdHis');
		if (floatval($open_house_timestamp) == -11130000000)
		{
			$open_house = "None";
		}
		else if( floatval($open_house_timestamp) > floatval($current_timestamp) && floatval($open_house_timestamp) != -11130000000)
		{
			$open_house = $property['Property']['open_house'];
		}
		else 
		{
			$open_house = "Passed";
		}
		$rows[]= array(
			$property['Property']['property_id'],
			$property['Property']['mls_number'], 
			$status,
			$property['Property']['address'], 
			$property['Property']['city'], 
			$property['Property']['price'],
			$open_house, 
			'<a href="'.$this->webroot.'properties/edit/'.$property['Property']['property_id'].'"><img src="'.$this->webroot.'img/icn_edit.png" title="Edit" ><a style = "margin-left:10px;position:relative"href="'.$this->webroot.'properties/view/'.$property['Property']['property_id'].'"><img src="'.$this->webroot.'img/icn_categories.png" title="View" ><a onclick = "return confirm( \'Are you sure to delete it ?\')" style = "margin-left:10px;position:relative"href="'.$this->webroot.'properties/delete/'.$property['Property']['property_id'].'"><img src="'.$this->webroot.'img/icn_trash.png" title="trash" >');
			
	
	}
		echo $this->Html->tableCells($rows);	
?>
</tbody> 
</table>	
</article>	
