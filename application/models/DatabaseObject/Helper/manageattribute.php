<?php

	class DatabaseObject_Helper_ManageAttribute extends DatabaseObject
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
		
		public static function confirmattributeidwithuploader($db, $table, $userID, $attributeID){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$attributeID)
			->where('uploader_id = ?', $userID);
			
			echo $select;
			return $db->fetchAll($select);
		}
		
		public static function loadAttributeIdDetail($db, $table, $id){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$id);
			
			$attribute['basicInfo'] = $db->fetchAll($select);
			//Zend_Debug::dump($attribute['basicInfo']);
			$attribute['name'] = $attribute['basicInfo'][0]['name_of_set'];
			$attribute['id']=$attribute['basicInfo'][0]['id'];
			$attribute['uploader_id']=$attribute['basicInfo'][0]['uploader_id'];
			//pulling attributeDetails now
			$select2 = $db->select();
			$select2->from($table.'_details', '*')
			->where('set_id =?', $id);
			$attributeDetails = $db->fetchAll($select2);
			$attribute['details']=$attributeDetails;
			$attribute['attributeTable']=$table.'_details';
			$attribute['table']=$table;
			return $attribute;
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
		
		public static function receiveAttributeSetFromId($db, $table, $set_id){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$set_id);
			echo $select;
			return $db->fetchAll($select);
		}
	}


?>