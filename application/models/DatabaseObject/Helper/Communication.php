<?php

	class DatabaseObject_Helper_Communication extends DatabaseObject
	{
		
		
		public static function retriveShoutOutForProduct($db, $product_id,  $product_category,$product_type)
		{
			$select=$db->select();
			$select->from('user_products_shoutout', '*')
					->where('product_id = ?', $product_id)
					->where('product_type_seller = ?', $product_type)
					->where('product_category = ?', $product_category)
					->order('ts_created DESC');
			//echo $select;
			return $db->fetchAll($select);
		}
		
		public static function retrieveShoutOutMessagesForUser($db, $user_id){
			$select = $db->select();
			$select->from('user_products_shoutout', '*')
				   ->where('User_id = ?', $user_id)
				   ->order('ts_created DESC');
				   //->order(array( 'product_id DESC', 'ts_created DESC' ));
				   
			//echo $select;
			return $db->fetchAll($select);
			
		}
		
		public static function retrieveMessagesForUser($db, $user_id, $messageBox){
			$select = $db->select();
			if($messageBox == 'inbox'){
				$select->from('receiver_message', '*')
				   ->where('receiver_email = ?', $user_id)
				   ->order('ts_created DESC');
			}elseif($messageBox=='outbox'){
				$select->from('sender_message', '*')
				   ->where('sender_email = ?', $user_id)
				   ->order('ts_created DESC');
			}
				   //->order(array( 'product_id DESC', 'ts_created DESC' ));
			//echo $select;
			return $db->fetchAll($select);
			
		}
		
	}
?>