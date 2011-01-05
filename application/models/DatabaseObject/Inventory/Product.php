<?php
// this class handles all the invenory that are being added with an inventory image and video. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 
// this product has very flexible profile attributes

	class DatabaseObject_Inventory_Product extends DatabaseObject
	{
		protected $_uploadedFile;
		protected $table;
		public $profile;
		public $attributeSet = false;
		
		public function __construct($db)
		{	
			parent::__construct($db, 'inventory_products', 'inventory_products_id');
			$this->add('product_type_table');
			$this->add('product_id');
			$this->add('User_id');
			$this->add('Username');
			$this->add('price');
			$this->add('filename');
			$this->add('inventory_name');
			$this->add('video');
			$this->add('quantity',1);	
			$this->add('description');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			
			$this->profile = new Profile_Inventory_Products($db);
		}
		
		
		
		protected function postLoad(){
			//$this->getImages();
			$this->profile->setProductId($this->getId());
			$this->profile->load();
			//$this->images = $this->getImages();
		}

		
		public function uploadFile($path)
		{
			if(!file_exists($path)||!is_file($path))
			{
				//echo $path;
				throw new Exception('unable to find uploaded file');
			}
			
			if(!is_readable($path))
			{	
				//echo $path;
				throw new Exception('unable to read uploaded file');
			}
			
			$this->_uploadedFile = $path;
		}
		
	
		
		public function preInsert()
		{
			//first check that we can write hte upload directory
			if($this->filename!='')
			{
				echo 'here at database filename exist';
				$path = $this->GetUploadPath();
				echo $path;
				if(!file_exists($path) || !is_dir($path))
				{
					mkdir($path, 0777, true);
					echo "path made";
				}
				
		
			
			}else{
				echo 'here at filename dose not exist';
			}
			return true;
		}
		
		public function postInsert()
		{
			$this->profile->setProductId($this->getId());
			$this->profile->save(false);
			echo 'here at insert profile';
			if(strlen($this->_uploadedFile)>0)
			{
				return move_uploaded_file($this->_uploadedFile, $this->getFullPath());
			}
			
			
			return false;
		}
		
		protected function postUpdate(){
			$this->profile->save(false);
			return true;
		}
		
		public function preDelete()
		{
			if($this->filename!='')
			{
				echo 'filename is: '.$this->filename.'<br />';
				unlink($this->getFullPath());
				
				$pattern = sprintf('%s/%d.*', $this->GetThumbnailPath(), $this->getId());
				
				foreach(glob($pattern) as $thumbnail)
				{
					unlink($thumbnail);
				}
			}			
			$this->profile->delete();

			return true; //make sure this return true becaues otherwise the database will be rolled back.
		}
		
		//this path(functionality must be called) must be set before 
		//setting :username/:product_type_table/:product_id/:acctribute_name
		//example:   tester1/pants/2/color
		public function setSaveFilePath($username, $product_type_table, $product_id)
		{
			//$this->username=$username;
			$this->username = $username;
			echo 'here at image username: '.$username.'<br />';
			$this->product_type_table=$product_type_table;
			$this->product_id = $product_id;
			$this->attributeSet=true;
		}
		
		
		public function loadForPost($User_id, $username, $inventory_id){
			$select = $this->_db->select();
			$select->from($this->_table, '*')
					->where('username = ?', $username)
					->where('User_id = ?', $User_id)
					->where('inventory_products_id = ?', $inventory_id);
			
			echo $select.'<br />';
			return $this->_load($select);
		}
		
		
		
		
		public function GetUploadPath()
		{
			$config = Zend_Registry::get('config');
			
			if($this->username != NULL)
			{
				$username= $this->username; //from loggedin user to view images of other club images. 
			}else{
				$username = Zend_Auth::getInstance()->getIdentity()->username; //from logged in people to view self images. 
			}
			
			echo sprintf('%s/uploaded-files/%s/%s/%s/InventoryProducts', $config->paths->data, $username, $this->product_type_table, $this->product_id); 
		 	return sprintf('%s/uploaded-files/%s/%s/%s/InventoryProducts', $config->paths->data, $username, $this->product_type_table, $this->product_id); 
			
		}
		
		
		public function GetThumbnailPath()
		{
			$config = Zend_Registry::get('config');
			if($this->username != NULL)
			{
				$username= $this->username; //from loggedin user to view images of other club images. 
			}
			/*elseif(!isset(Zend_Auth::getInstance()->getIdentity()->username))
			{
				$username= $_SESSION['clubUsername']; //from unlogged in people to view other club images. 
			}
			*/else{
				$username = Zend_Auth::getInstance()->getIdentity()->username; //from logged in people to view self images. 
			}
			
			echo sprintf('%s/tmp/thumbnails/%s/%s/%s/InventoryProducts', $config->paths->data, $username, $this->product_type_table, $this->product_id); 
			return sprintf('%s/tmp/thumbnails/%s/%s/%s/InventoryProducts', $config->paths->data, $username, $this->product_type_table, $this->product_id); 
		}
		
		public function createThumbnail($maxW, $maxH, $thumbType='')
		{
			$fullpath=$this->getFullPath();
			
			
			if($maxW==0 && $maxH!=0)
			{
				$filename = sprintf('%d.H%d_%s', $this->getId(), $maxH, $thumbType);
			}
			elseif($maxH==0 && $maxW!=0)
			{
				$filename = sprintf('%d.W%d_%s', $this->getId(), $maxW, $thumbType);
			}
		
			$ts=(int)filemtime($fullpath);

			$info=getImageSize($fullpath);
			
			$w = $info[0];
			$h = $info[1];
			
			$ratio = $w/$h;  // width: height ratio
			
			$maxW = min($w, $maxW);//new width can't be more than $maxW
			
			if($maxW==0) 	//check if only max height has een specified
			{
				$maxW=$w;
			}
			
			$maxH = min($h, $maxH);
			if($maxH ==0)
			{
				$maxH = $h;
			}
			
			$newW = $maxW;
			$newH = $newW/$ratio;
			if($newH >$maxH)
			{
				$newH = $maxH;
				$newW = $newH * $ratio;
			}
			
			if($w==$newW && $h ==$newH)
			{
				//no thumbnail required, just return the original path
				return $fullpath;
			}
			
			
			switch($info[2])
			{
				case IMAGETYPE_GIF:
					$infunc = 'ImageCreateFromGif';
					$outfunc = 'ImageGif';
					break;
				case IMAGETYPE_JPEG:
					$infunc = 'ImageCreateFromJpeg';
					$outfunc = 'ImageJpeg';
					break;
				case IMAGETYPE_PNG:
					$infunc = 'ImageCreateFromPng';
					$outfunc = 'ImagePng';
					break;
				
				default;
					throw new Exception('Invalid image type');
			}
			
			// create a unique filename based on the specified optins 
			//autocreate the directory for storing thumbnails
			$path =$this->GetThumbnailPath();
			if(!file_exists($path)){
				//echo "here at make path";
				mkdir($path, 0777, true);
			}
			
			if(!is_writable($path)){
				throw new Exception('Unable to write to thumbnail dir: '.$path);
			}
			
			//determin the full path for the new thumbnail
			$thumbPath = sprintf('%s/%s.jpg', $path, $filename);
			//echo $thumbPath;
			
			if(!file_exists($thumbPath)){
				//read the image into GD
				$im = @$infunc($fullpath);
				if(!$im){
					throw new Exception('Unable to read image file');
				}				
				//create the output image
				$thumb = ImageCreateTrueColor($newW, $newH); //creating a new image of new hight
				//now resample the origianl image to the new image 
				ImageCopyResampled($thumb, $im, 0,0,0,0, $newW, $newH, $w, $h); //converting the image to the new image.
				$outfunc($thumb, $thumbPath);  //this writes (the image and the location)
			}
				
			if(!file_exists($thumbPath)){
				throw new Exception('Unkonw error occurred creating thumbnail');
			}
			if(!is_readable($thumbPath)){
				throw new Exception('Unable to read thumbnail');
			}
			return $thumbPath; //this returns the paths.
		}
				
				
		public function getFullPath(){
			return sprintf('%s/%d.jpg', $this->GetUploadPath(),$this->getId());
		}
		
		public static function GetImagehash($id, $w=0, $h=0){
			$id = (int)$id;
			$w = (int)$w;
			$h = (int) $h;
			return 	sprintf('%d.%dx%d', $id, $w, $h);
		}
		
		public static function GetImages($db, $options=array(), $databaseColumn, $table) //table passed not right/
		{
			//initialize the otions
			$defaults = array($databaseColumn =>array());
			
			foreach ($defaults as $k=>$v){
				$options[$k] = array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			$select = $db->select();
			$select->from(array('i'=>$table), array('i.*'));
			//filter results on specified post ids (if any)
			if(count($options[$databaseColumn])>0){
				$select->where('i.'.$databaseColumn.' in (?)', $options[$databaseColumn]);
			}
			
			if(!empty($options['limit'])){
				$select->limit($options['limit']);
			}else{
				//$select->limit(12);
			}
	
			$select->order('i.ranking');
			
			echo "select is: ".$select."<br />";
			$data = $db->fetchAll($select); 
			$images = parent::buildMultiple($db, __CLASS__, $data);
			return $images;
		}
		
	}
?>