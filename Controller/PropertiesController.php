<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');
class PropertiesController extends AppController 
{
	public function beforeFilter() 
	{
        parent::beforeFilter();
		$this->Auth->allow('view');
		$this->Auth->allow('index');
		$this->Auth->allow('inquire');
		$this->Auth->allow('map');
		$this->Auth->allow('new_listings');
		$this->Auth->allow('sold_listings');
		$this->set('lastname', $this->Auth->user('last_name'));
	}
	public $components = array('Paginator');
	public $paginate = array(
        'fields' => array(
					'Property.property_id', 
					'Property.property_status',
					'Property.mls_number',
					'Property.address', 
					'Property.city',
					'Property.price',
					'Property.bedroom',
					'Property.bathroom',
					'Property.property_type',
					'Property.area',
					'Property.age',
					'Property.image',
					'Property.open_house',
					'Property.post_date'),
        'limit' => 5,
		'conditions' => array('Property.property_status NOT LIKE' => '3%'),
        'order' => array(
            'Property.post_date' => 'desc'
			)
        
    );
	public function inquire()
	{
		if($this->request->data)
		{
			$name = $this->request->data['Property']['name'];
			$toemail = $this->request->data['Property']['email'];
			$phone = $this->request->data['Property']['phone'];
			$message = $this->request->data['Property']['message'];
			$property_id = $this->request->data['Property']['property_id'];
			

			//reply to inquiring client
			$email = new CakeEmail('gmail');
			$email->from('nonreply@daniel-zhou.com');
			$email->to($toemail);
			$email->subject('Thank you for choosing us');       
			$email->send('Thank you. We have received your inquire and will get back to you soon.');
			
			
			
			$email2 = new CakeEmail('gmail');
			$email2->from('nonreply@daniel-zhou.com');
			$email2->emailFormat('html');
			
			$email2->to($toemail);
			$txt = '<p>Name: '.$name.'</p><p>Phone: '.$phone.'<p>email: '.$toemail.'</p><p>Message: '.$message.'</p><p>Link: <a href= "http://www.daniel-zhou.com/properties/view/'.$property_id.'">Property Link Goes Here</a></p>';
			$email2->subject('You have one inquire for viewing');       
			$email2->send($txt);
			return $this->redirect(array('action' => 'view' ,$property_id));
		}
	}

	public function new_listings()
	{
		$this->Paginator->settings = $this->paginate; 
		$this->set('properties', $this->paginate('Property'));
	}
	
	public function sold_listings()
	{
		$this->Paginator->settings = $this->paginate; 
		$this->set('properties', $this->paginate('Property'));
		$this->set('properties', $this->paginate('Property', array('Property.property_status LIKE' => '%2%')));
	}
	public function index2()
	{
		$this->layout = 'backend';
		
		$this->Paginator->settings = $this->paginate; 
		$this->set('properties', $this->Property->find('all'));
		//$this->set('WWW_ROOT', $WWW_ROOT);
		
	}
	
	public function search()
	{
		$this->layout = 'backend';
		$keyword = $this->request->data['Property']['keyword'];
		$this->Paginator->settings = $this->paginate; 
		$this->set('properties', $this->paginate('Property',
					array ('OR' => array(
						'Property.mls_number LIKE' => "%$keyword%"))));
	}
	public function edit($id)
	{
		$this->layout = 'backend';
		$property = $this->Property->findByProperty_id($id);
		$property_id = $id;
        if ($this->request->is(array('post', 'put'))) 
		{
			if($this->request->data)
			{
				$filename = $this->request->data['Property']['file']['name'];
				$this->request->data['Property']['image'] = $filename;
            }
			$this->Property->property_id = $property_id;
            if ($this->Property->save($this->request->data)) 
			{
				
				if($this->request->data['Property']['files'][0]['error'] === UPLOAD_ERR_OK)
				{
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . 'images', true, 0755);
				$dir->delete();
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . 'images', true, 0755);
				$files = $this->request->data['Property']['files'];
				
				foreach( $files as $file )
				{
					$filename = $file['name'];
					$filePath = "./img/property/".$property_id.'/images/'.$filename; 
					move_uploaded_file($file['tmp_name'], $filePath);
				}
				}
				if($this->request->data['Property']['file']['error'] === UPLOAD_ERR_OK)
				{
				//Process the upload of a single front image for 280x165
				$filename = $this->request->data['Property']['file']['name'];
				
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . '400x250', true, 0755);
				$dir->delete();
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . '400x250', true, 0755);
				$filePath = "./img/property/".$property_id.'/'.'400x250/'.$filename;
				$filePath2 = "./img/property/".$property_id.'/'.'650x400/'.$filename;
				$tmpfile = $this->request->data['Property']['file']['tmp_name'];
				move_uploaded_file($tmpfile, $filePath);
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . '650x400', true, 0755);
				$dir->delete();
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . '650x400', true, 0755);
				$file = new File($filePath, false, 755);
				$file->copy($filePath2, false);
				
			
				$MyImageCom = new ImageComponent(new ComponentCollection()); 
				$MyImageCom->prepare($filePath);
				$MyImageCom->resize(400,250);//width,height,Red,Green,Blue
				$MyImageCom->save($filePath);
				
				//Process the upload of a single front image for 480x350
				//$filename = $this->request->data['Property']['file']['name'];
				//$dir = new Folder(WWW_ROOT . 'img/property/'.$property_id.'/'.'480x350/', true, 0755);
				//$filePath = "./img/property/".$property_id.'/'.'480x350/'.$filename;
				//move_uploaded_file($tmpfile, $filePath);
					
				//$files = $dir->find('.*', true);
		
				//$MyImageCom = new ImageComponent(new ComponentCollection()); 
				$MyImageCom->prepare($filePath2);
				$MyImageCom->resize(650,400);//width,height,Red,Green,Blue
				$MyImageCom->save($filePath2);
				}
                $this->Session->setFlash(__('The property has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The Property could not be saved. Please, try again.'));
        }
		if (!$this->request->data)
        {
            $this->request->data = $property;
        }
	}
	public function add() 
	{
		$this->layout = 'backend';
        if ($this->request->is('post')) 
		{
			if($this->request->data)
			{
				$filename = $this->request->data['Property']['file']['name'];
				$this->request->data['Property']['image'] = $filename;
            }
			$this->Property->create();
            if ($this->Property->save($this->request->data)) 
			{
				$property_id = $this->Property->getLastInsertId();
				if($this->request->data['Property']['files'][0]['error'] === UPLOAD_ERR_OK)
				{
					$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . 'images', true, 0755);
					$files = $this->request->data['Property']['files'];
				
				foreach( $files as $file )
				{
					$filename = $file['name'];
					$filePath = "./img/property/".$property_id.'/images/'.$filename; 
					move_uploaded_file($file['tmp_name'], $filePath);
				}
				}
				if($this->request->data['Property']['file']['error'] === UPLOAD_ERR_OK)
				{
				//Process the upload of a single front image for 280x165
				$filename = $this->request->data['Property']['file']['name'];
				
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . '400x250', true, 0755);
				$filePath = "./img/property/".$property_id.'/'.'400x250/'.$filename;
				$filePath2 = "./img/property/".$property_id.'/'.'650x400/'.$filename;
				$tmpfile = $this->request->data['Property']['file']['tmp_name'];
				move_uploaded_file($tmpfile, $filePath);
				$dir = new Folder(WWW_ROOT . 'img'. DS . 'property'. DS . $property_id . DS . '650x400', true, 0755);
				$file = new File($filePath, false, 755);
				$file->copy($filePath2, false);
				
			
				$MyImageCom = new ImageComponent(new ComponentCollection()); 
				$MyImageCom->prepare($filePath);
				$MyImageCom->resize(400,250);//width,height,Red,Green,Blue
				$MyImageCom->save($filePath);
				
				//Process the upload of a single front image for 480x350
				//$filename = $this->request->data['Property']['file']['name'];
				//$dir = new Folder(WWW_ROOT . 'img/property/'.$property_id.'/'.'480x350/', true, 0755);
				//$filePath = "./img/property/".$property_id.'/'.'480x350/'.$filename;
				//move_uploaded_file($tmpfile, $filePath);
					
				//$files = $dir->find('.*', true);
		
				//$MyImageCom = new ImageComponent(new ComponentCollection()); 
				$MyImageCom->prepare($filePath2);
				$MyImageCom->resize(650,400);//width,height,Red,Green,Blue
				$MyImageCom->save($filePath2);
				}
                $this->Session->setFlash(__('The property has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
			$this->Session->setFlash(__('The Property could not be saved. Please, try again.'));
        }
    }
	public function images($id = null)
	{
		
	}
	public function view($id = null)
	{
		
		
        $this->set('property', $this->Property->findByProperty_id($id));
		$dir = new Folder(WWW_ROOT . 'img/property/'.$id.'/images/');
		$files = $dir->find('.*', true);
		$this->set('files', $files); 
	}
	public function index()
	{
		
		
		$this->Paginator->settings = $this->paginate; 
		$this->set('properties', $this->paginate('Property'));
	
	}
	public function city($city)
	{
		$this->layout = 'frontpage';
		
		$this->Paginator->settings = $this->paginate; 
		$this->set('city', $city);
		$this->set('properties', $this->paginate('Property', array('Property.city LIKE' => '%$city%')));
	
	}
	public function map($id = null)
	{
		
        $this->set('property', $this->Property->findByProperty_id($id));
		$dir = new Folder(WWW_ROOT . 'img/property/'.$id.'/');
		$files = $dir->find('.*', true);
		$this->set('files', $files); 
	}
	public function delete($id) 
	{
		if ($this->Property->delete($id)) 
		{
        	$this->Session->setFlash(__('The property with id: %s has been deleted.', $id));
      		return $this->redirect(array('action' => 'index2'));
    	}
		else
		{
			$this->Session->setFlash(__('Error'));
      		return $this->redirect(array('action' => 'index2'));
		}
	}
	
	
}