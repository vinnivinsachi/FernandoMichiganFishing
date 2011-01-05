<?php

	class DatabaseObject_Order extends DatabaseObject
	{
		public $shippingAddress;
				public $products = array();

		public function __construct($db){
			parent::__construct($db, 'orders', 'order_id');
			$this->add('order_unique_id');
			$this->add('order_shipping_id');
			$this->add('buyer_Username');
			$this->add('buyer_UserID');
			$this->add('buyer_email');
			$this->add('buyer_name');
			$this->add('total_number_items');
			$this->add('total_costs');
			$this->add('total_reward_points');
			$this->add('reward_points_used');
			$this->add('reward_amount_deducted');
			$this->add('promotion_code_used');
			$this->add('promotion_amount_deducted');
			$this->add('final_total_costs');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->shippingAddress = new DatabaseObject_OrderShippingAddress($db);
		}
		
		protected function preInsert(){
			return true;
		}
		
		protected function postInsert(){
			return true;
		}
		
		protected function postLoad(){
			$this->shippingAddress->load($this->order_shipping_id);	
		}
	
		public function loadOrderByUniqueID($order_unique_id){
			$select = $this->_db->select();
			$select->from('orders')
				   ->where('order_unique_id = ?', $order_unique_id);
			//echo $select;
			return $this->_load($select);
		}
		
		public function loadOrderProducts(){
			$select = $this->_db->select();
			$select->from('orders_profile', '*')
					->where('order_unique_id = ?', $this->order_unique_id);
			//echo $select;
			$productArray = $this->_db->fetchAll($select);
			//Zend_Debug::dump($productArray);
			foreach($productArray as $k=>$v){
				$attributeSelect = $this->_db->select();
				$attributeSelect->from('orders_profile_attribute', '*')
				->where('order_profile_attribute_id = ? ', $v['order_profile_id']);
				$productAttribute = $this->_db->fetchAll($attributeSelect);
				$this->products[$v['order_profile_id']]=$v;
				$this->products[$v['order_profile_id']]['profile']=$productAttribute;
			}
		}
		
		public function loadOrderProductsForSeller($seller_id){
			$select = $this->_db->select();
			$select->from('orders_profile', '*')
					->where('product_UserId = ?', $seller_id)
					->where('order_unique_id = ?', $this->order_unique_id);
			//echo $select;
			$productArray = $this->_db->fetchAll($select);
			//Zend_Debug::dump($productArray);
			foreach($productArray as $k=>$v){
				$attributeSelect = $this->_db->select();
				$attributeSelect->from('orders_profile_attribute', '*')
				->where('order_profile_attribute_id = ? ', $v['order_profile_id']);
				$productAttribute = $this->_db->fetchAll($attributeSelect);
				$this->products[$v['order_profile_id']]=$v;
				$this->products[$v['order_profile_id']]['profile']=$productAttribute;
			}
			
		}
	}
?>