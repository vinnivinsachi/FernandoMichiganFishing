<?php

	class DatabaseObject_Helper_ProductListing extends DatabaseObject
	{
		
		
		public static function getImageAttribute($db, $username, $product_type_table, $product_id, $options=array())
		{
			$select=$db->select();
			$select->from('image_attribute', $options['value'])
				->where('username = ?',$username)
				->where('product_id = ?', $product_id)
				->where('product_type_table = ?', $product_type_table);
				
			if($options['group']==true)
			{
				$select->group('attribute_name');
			}
			//echo $select.'<br /><br />';
			return $db->fetchAll($select);
		}
		
		public static function getMeasurementAttribute($db, $username, $product_type_table, $product_id, $options=array())
		{
			$select=$db->select();
			$select->from('measurement_attribute', $options['value'])
				->where('username = ?',$username)
				->where('product_id = ?', $product_id)
				->where('product_type_table = ?', $product_type_table);
				
			if($options['group']==true)
			{
				$select->group('attribute_name');
			}
			//echo $select.'<br /><br />';
			return $db->fetchAll($select);
			
		}
		
		public static function getSizeAttribute($db, $username, $product_type_table, $product_id, $options=array())
		{
			$select=$db->select();
			$select->from('size_attribute', $options['value'])
				->where('username = ?',$username)
				->where('product_id = ?', $product_id)
				->where('product_type_table = ?', $product_type_table);
				
			if($options['group']==true)
			{
				$select->group('attribute_name');
			}
			//echo $select.'<br /><br />';
			return $db->fetchAll($select);
		}
		
		public static function addTagToObject(DatabaseObject $product, $tag, $seller_type, $userID){
			
			  $data = array(
				  'Products_id' => $product->getId(),
				  'tag'      => $tag,
				  'User_id' =>$userID
			  );			
		
			if($seller_type == 'storeSeller'){
			$product->_db->insert('products_tags', $data);
			}elseif($seller_type == 'generalSeller'){
			$product->_db->insert('user_products_tag', $data);
			}
		}
		
		public static function loadTagForObject(DatabaseObject $product, $seller_type){
			$select=$product->getDb()->select();
			if($seller_type =='storeSeller'){
					$select->from('products_tags', '*')
				->where('Products_id = ?', $product->getId());
			
			}elseif($seller_type=='generalSeller'){
				$select->from('user_products_tag', '*')
				->where('Products_id = ?', $product->getId());
			}
			return $product->getDb()->fetchAll($select);
		}
		
		public static function removeTagFromObject(DatabaseObject $product, $tagid, $seller_type, $userID){
			//echo 'tag id is: '.$tagid;
			//echo 'product type is: '.$product->product_type;
			echo 'tag id is: '.$tagid.'<br />';
			echo 'seller type is: '.$seller_type.'<br />';
			echo 'product id: '.$product->getId();'<br />';
			
			if($seller_type == 'storeSeller'){
				echo 'here';
			$product->_db->delete('products_tags', array("Products_id = '".$product->getId()."'",
														 "tag_id = '".$tagid."'",
														 "User_id = '".$userID."'"
															 )); 
			}elseif($seller_type == 'generalSeller'){
				echo 'here2';
			$product->_db->delete('user_products_tag', array(
														 "Products_id = '".$product->getId()."'",
														 "tag_id = '".$tagid."'",
														 "User_id = '".$userID."'"
															 )); 
			}
			//echo "here";
		}
		
		public static function markAsNew(DatabaseObject $product, $status, $seller_type){
			
				$id = $product->getId();
				$data = array('new' => $status);
		
				$product->_db->update($product->_table, $data, "$product->_idField = $id");

		}
		
		public static function retrieveAllProduct($db, $productTable, $userID, $options=array()){
			$select = $db->select();
			$select->from($productTable, '*')
			->where('User_id = ?', $userID);
			
			if($options['no_options']==false){
				foreach($options as $k=>$v){
					if($k!='no_options'){
					$select->where("$k = ?", $v);
					}
				}
			}
			echo $select;
			return $db->fetchAll($select);
		}
		
		public static function confirmproductforuploader($db, $productTable, $userID, $productID){
			
			$select = $db->select();
			$select->from($productTable, '*')
				->where('owner_id=?', $userID)
				->where('products_id=?', $productID);
			echo $select;
			return $db->fetchAll($select);
		}
		
		public static function confirmattributeidwithuploader($db, $table, $userID, $attributeID){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$attributeID)
			->where('uploader_id = ?', $userID);
			
			echo $select;
			return $db->fetchAll($select);
		}
		
		public static function confirmattributenamewithuploader($db, $table, $userID, $attributeName){
			$select = $db->select();
			$select->from($table, '*')
			->where('name_of_set=?',$attributeName)
			->where('uploader_id=?',$userID);
			echo $select;
			
			$item = $db->fetchAll($select);
			
			if (count($item)==1){
				return true;
			}else{
				return false;
			}
		}
		
		
	}


?>