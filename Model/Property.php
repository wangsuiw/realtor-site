<?php
// app/Model/Property.php

class Property extends AppModel 
{
	public $primaryKey = 'property_id';
	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
			'foreignKey' => 'user_id'
        )
    );
}