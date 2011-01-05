<?php

	class DatabaseObject_Helper_ProductDisplay extends DatabaseObject
	{
		
		
		public static function retriveAllTagsForProductType($db, $product_tag_table, $userID)
		{
			$select=$db->select();
			$select->from($product_tag_table, 'distinct(tag)')
					->where('User_id = ?', $userID);
			echo $select;
			return $db->fetchAll($select);
		}		
		
		public static function retrieveSingleTagFroProduct($db, $product_table, $userID){
			$select=$db->select();
			$select->from($product_table, 'distinct(product_tag)')
				->where('User_id = ?', $userID);
				echo $select;
				return $db->fetchAll($select);
		}
	}


?>