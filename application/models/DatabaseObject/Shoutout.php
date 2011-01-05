<?php

	//must have getProductForUser()
	//must have generateGSDetailsSession()
	class DatabaseObject_Shoutout extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'user_products_shoutout', 'user_products_shoutout_id');
			$this->add('User_id');
			$this->add('Username');
			$this->add('product_id');
			$this->add('product_category');
			$this->add('product_image_id');
			$this->add('product_type_seller');
			$this->add('product_name');
			$this->add('product_tag');
			$this->add('shoutout_name');
			$this->add('shoutout_email');
			$this->add('shoutout_user_receive_notification', 1);
			$this->add('shoutout_email_verification_cancelling', Text_Password::create(20, 'unpronounceable'));
			$this->add('shoutout_username');
			$this->add('shoutout_user_id');
			$this->add('shoutout_message');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			//this attribute is purely for the sake of passing it to other objects
		}
		
		//because of all the constraints make sure that all the profile stuff that is connected iwth the product must have something done to it when messing with the database. 
		protected function postLoad(){
			
		}
		
		protected function postInsert(){
			
			return true;
		}
		
		protected function postUpdate(){
			return true;
		}
		
		protected function preDelete(){
			
			return true;
		}
		
		protected function preInsert(){
			
			return true;
		}
		
		
	}
?>