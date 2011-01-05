<?php

	//pg 221
	class DatabaseObject_ContactUs extends DatabaseObject
	{		
		const STATUS_DRAFT = 'D';
		const STATUS_LIVE = 'L';
		
		
		private $databaseColumn = 'id';

		public function __construct($db)
		{
			parent::__construct($db, 'online_message', 'id'); //database, table, idField
			$this->add('first_name');
			$this->add('last_name');
			$this->add('email');
			$this->add('description');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
						
			//ah everthing here added can be automatically called because when instantiated, authough it is not inserted into the database, its value can be retrieved. because of the add funciton puts in the databaseobject arrays, and paired with the _get function, everything here can be retrieved. 
			
		}
		
		protected function preInsert()
		{
		
			//$this->_newPassword = Text_Password::create(8);
			//$this->password = $this->_newPassword;
			//$this->profile->num_posts =10;
			
			return true;
		}
		
		protected function postLoad()
		{
			//$this->profile->setUserId($this->getId());
			//$this->profile->load();
			
	
		}
		
		protected function postInsert()
		{
			/*$this->profile->setUserId($this->getId());
			$this->profile->save(false);
			
			$this->sendEmail('user-register.tpl');
			
			if($this->user_type == 'clubAdmin')
			{
				DatabaseObject_StaticUtility::addClubNumber($this->_db, $this->university_id);
				DatabaseObject_StaticUtility::addTypeClubNumber($this->_db, $this->type_id);
			}*/
			
			//echo "message being sent";
			//$this->addToIndex();
			return true;
		}
		
		protected function postUpdate()
		{
			
			return true;
		}
		
		protected function preDelete() 
		{
		
			return true;
		}
		
		public function sendLive()
		{
			
		}		
		
		public function loadByID($id)
		{
			$select = $this->_db->select();
			
			$select->from('online_message')
				   ->where('id = ?', $id);
				   
				 //  echo "<br />$select<br />";
		
			return $this->_load($select);
		}
		
		public static function GetObjects($db, $options=array()) //got the user, got form, got to, got order. 
		{
			
		}

	}
?>