<?php

	class DatabaseObject_Helper_Admin_OrderManager extends DatabaseObject
	{
		
		public static function loadAllOrderProfiles($db, $type=null, $date=null){
			$select=$db->select();
			$select->from('orders_profile','*');
			if($type!=null){
			$select->where('product_order_status = ?', $type);
			}
			//date is only specified when durin admin order process
			if($date!=null){
				if($type=='delivered')
				$select->where('late_delivery_confirmation_date >= ?', $date);
				elseif($type=='return delivered')
				$select->where('late_return_delivery_confirmation_date >= ?', $date);	
			}
			
			$select->order('product_latest_delivery_date DESC');

			$result = $db->fetchAll($select);
			//echo $select;
			//Zend_Debug::dump($result);
			
			return $result;
		}
		
		public static function changeOrderStatus($db, $date){
			
			$data = array('product_order_status'=>'completed',
						  'order_profile_completion_date'=>$date);
			
			$db->update('orders_profile', $data, "late_delivery_confirmation_date <= '".$date."' AND product_order_status = 'delivered'");
			
			$data = array('product_order_status'=>'return completed',
						  'order_profile_return_completion' =>$date);
			$db->update('orders_profile', $data, "late_return_delivery_confirmation_date <= '".$date."' AND product_order_status = 'return delivered'");
			
		}
		
	
	}
?>