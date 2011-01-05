<?php
	class DatabaseObject_ShoppingCartProfile extends DatabaseObject
	{
		public $productShippingAddress=null;
		public $profile =null;
		
		public function __construct($db){
			parent::__construct($db, 'shopping_cart_profile', 'shopping_cart_profile_id');
			
			$this->add('order_unique_id');
			$this->add('cart_id');
			$this->add('product_id');
			$this->add('product_type');
			$this->add('product_market');
			$this->add('product_Username');
			$this->add('product_UserId');
			$this->add('product_name');
			$this->add('product_tag');
			$this->add('product_user_email');
			$this->add('product_user_name');
			$this->add('product_image_id');
			$this->add('reward_points');
			$this->add('shipping_costs');
			$this->add('backorder_time');
			$this->add('product_price');
			$this->add('product_user_receivable');
			$this->add('product_tracking');
			$this->add('product_tracking_carrier');
			$this->add('product_latest_delivery_date',time()+345600, self::TYPE_TIMESTAMP);
			$this->add('product_absolute_latest_delivery_date', time()+518400, self::TYPE_TIMESTAMP);
			$this->add('product_tracking_shipping_date');
			$this->add('ts_created',time(), self::TYPE_TIMESTAMP);
			$this->add('order_shipping_id');
			$this->add('product_returned', 0);
			$this->add('product_returned_tracking');
			$this->add('product_returned_tracking_carrier');
			$this->add('product_returned_latest_delivery_date');
			$this->add('product_returned_shipping_date');
			$this->add('buyer_name');
			$this->add('buyer_UserID');
			$this->add('buyer_Username');
			$this->add('buyer_email');
			$this->add('buyer_affiliation');
			$this->add('useMyMeasurement');
			$this->profile= new Profile_ShoppingCartProfileAttribute($db);
		}
		
		protected function preInsert(){
			
			return true;
		}
		
		protected function postInsert(){
			$this->profile->setProfileId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function preDelete(){
			echo 'here at profile detlete';
			$this->profile->delete();
			echo 'here at profile delete 2';
			return true;
		}
		
		protected function postLoad(){
			//$this->shippingAddress->load($this->order_shipping_id);	
			$this->profile->setProfileId($this->getId());
			$this->profile->load();
		}
	
		public function loadCartOnly($order_unique_id){
			$select = $this->_db->select();
			$select->from('shopping_cart')
				   ->where('order_unique_id = ?', $order_unique_id);
			//echo $select;
			return $this->_load($select);
		}
		public function loadShippingAddressForProduct(){
			$this->productShippingAddress= new DatabaseObject_OrderShippingAddress($this->db);
			$this->productShippingAddress->load($this->order_shipping_address_id);
		}
	}
?>