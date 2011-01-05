<?php

	class DatabaseObject_Helper_Ordermanager extends DatabaseObject
	{
		
		
		public static function retrieveOrdersForUser($db, $user_id)
		{
			$orderArray = array();
			$select=$db->select();
			$select->from('orders', '*')
					->where('buyer_UserID = ?', $user_id)
					->order('ts_created DESC');
			//echo $select;
			$idArray= $db->fetchAll($select);
			
			foreach($idArray as $k =>$v){
				$order = new DatabaseObject_Order($db);
				$order->load($v['order_id']);
				$order->loadOrderProducts();
				
				
				$messageThreads=  array();
				foreach($order->products as $k=>$v){
					
					$MessageSelect=$db->select();
					$MessageSelect->from('sender_message' , '*')
					->where('sender_subject = ? ', 'orderID: '.$order->order_unique_id)
					->where('product_id = ?', $v['product_id'])
					->where('product_type_seller = ?', $v['product_market'])
					->order('ts_created DESC');
					//echo $MessageSelect.'<br />';
					$productMessageThreads = $db->fetchAll($MessageSelect);
					
					if(count($productMessageThreads)>0){
					$order->products[$k]['messageThreads'] = $productMessageThreads;
					//Zend_Debug::dump($v['messageThreads']);
					}
				}
				
				$orderArray[]=$order;

				//Zend_Debug::dump($order->products);
				
			}
			return $orderArray;
		}
		
		public static function retrieveOrdersForSeller($db, $user_id){
			$orderArray=array();
			$select = $db->select();
			$select->from('orders_profile', 'order_unique_id')
				   ->where('product_UserId = ?', $user_id)
				   ->group('order_unique_id')
				   ->order('ts_created DESC');
				   //->order(array( 'product_id DESC', 'ts_created DESC' ));
			//echo $select;
			$idArray = $db->fetchAll($select);
			
			foreach($idArray as $k =>$v){
				echo 'key is: '.$k.' value is: '.$v['order_unique_id'].'<br />';
				$order = new DatabaseObject_Order($db);
				$order->loadOrderByUniqueID($v['order_unique_id']);
				echo 'here at load<br />';
				//$order->load($v['order_id']);
				$order->loadOrderProductsForSeller($user_id);
				
				$messageThreads=  array();
				foreach($order->products as $k=>$v){
					
					$MessageSelect=$db->select();
					$MessageSelect->from('sender_message' , '*')
					->where('sender_subject = ? ', 'orderID: '.$order->order_unique_id)
					->where('product_id = ?', $v['product_id'])
					->where('product_type_seller = ?', $v['product_market'])
					->order('ts_created DESC');
					//echo $MessageSelect.'<br />';
					$productMessageThreads = $db->fetchAll($MessageSelect);
					
					if(count($productMessageThreads)>0){
					$order->products[$k]['messageThreads'] = $productMessageThreads;
					}
				}
				$orderArray[]=$order;
			}
			
			return $orderArray;
		}
		
	}
?>