<?php
	class DatabaseObject_OrderProfile extends DatabaseObject
	{
		public $productShippingAddress=null;
		public $profile =null;
		
		public function __construct($db){
			parent::__construct($db, 'orders_profile', 'order_profile_id');
			
			$this->add('order_unique_id');
			$this->add('order_id');
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
			$this->add('product_latest_delivery_date');
			$this->add('product_absolute_latest_delivery_date');
			$this->add('ts_created');
			$this->add('order_shipping_id');
			$this->add('product_returned', 0);
			$this->add('product_returned_tracking');
			$this->add('product_returned_tracking_carrier');
			$this->add('product_tracking_shipping_date');
			$this->add('product_returned_shipping_date');			
			$this->add('product_returned_latest_delivery_date');
			$this->add('product_order_status', 'unshipped');
			//the are 5 status here, unshipped, shipped, (admin)delivered, return shipped, (admin)return delivered, order completed, order return completed, payment refunded to buyer, payment transfered to seller, cancelled by buyer, cancelled by seller.
			$this->add('late_delivery_confirmation_date');
			$this->add('order_profile_completion_date');
			//time for payment transfered
			$this->add('payment_transfered_date');
			$this->add('order_profile_return_completion');
			$this->add('late_return_delivery_confirmation_date');
			//time for payment returned
			$this->add('payment_returned_date');
			$this->add('buyer_name');
			$this->add('buyer_UserID');
			$this->add('buyer_Username');
			$this->add('buyer_email'); 
			$this->add('buyer_affiliation');
			$this->add('useMyMeasurement');
			$this->add('payment_to_seller', '0');
			$this->add('refund_to_buyer', '0');
			$this->add('seller_review_written','0');
			$this->add('cancellation_reason');
			$this->profile= new Profile_OrderProfileAttribute($db);
		
		}
		
		protected function preInsert(){
			
			return true;
		}
		
		protected function postInsert(){
			$this->profile->setProfileId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function postLoad(){
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