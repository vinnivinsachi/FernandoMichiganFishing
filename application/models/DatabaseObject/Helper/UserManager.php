<?php

	class DatabaseObject_Helper_UserManager extends DatabaseObject
	{
		
		
		public static function loadByReferral($db, $referralID){
			$select=$db->select();
			$select->from('users',array('referral_id', 'referee_id'))
				->where('referee_id =? ', $referralID);
			
			$result = $db->fetchAll($select);
			//Zend_Debug::dump($result);
			if(count($result)==1){
				return true;
			}else{
				return false;
			}
		}
		
		public static function addRewardPointToUser($db, $userPointAdded, $amount, $resource, $ipOfEvent, $userCausedUsername, $userCausedId, $userCausedPointAdded=''){
			
			//update reward point in user
			$select = $db->select();
			$select->from('users', 'reward_point')
				->where('referee_id = ?', $userPointAdded);
			$currentAvailablePoint = $db->fetchAll($select);
			
			$data = array('reward_point' => $currentAvailablePoint[0]['reward_point']+$amount);
			
			$db->update('users', $data, "referee_id = '$userPointAdded'");
			
			//track reward point for user
			$data2 = array(
				  'user_points_added' => $userPointAdded,
				  'point'      => $amount,
				  'name_of_event' => $resource,
				  'location_id'      => $ipOfEvent,
				  'user_caused_Username' => $userCausedUsername,
				  'user_caused_id' =>$userCausedId,
				  'user_caused_point_addition' =>$userCausedPointAdded
			  );			
			$db->insert('reward_point_tracking', $data2);
		}
		
		public static function loadRewardPointTracking($db, $userUniqueCode){
			$select = $db->select();
			$select->from('reward_point_tracking', '*')
			->where('user_points_added = ?', $userUniqueCode)
			->order('time DESC');
			echo '<br />here at selecting reward point: '.$select.'<br />';
			return $db->fetchAll($select);
		}		
		
		public static function loadUserReviews($db, $userUniqueId){
			$select = $db->select();
			$select->from('user_review','*')
				->where('User_id = ?', $userUniqueId)
				->order('ts_created DESC');
			return $db->fetchAll($select);
		}
		
		public static function loadUserEmail($db, $userID){
			$select = $db->select();
			$select->from('users', 'email')
				->where('userID = ?', $userID);
			//echo $select;
			return $db->fetchOne($select);
		}
		
		public static function loadUserMeasurements($db, $userRefereeID, $userSex){
			$select = $db->select();
			if($userSex=='man'){
			$select->from('user_men_measurement', '*')
				->where('User_referee_id = ?', $userRefereeID);
			}elseif($userSex=='woman'){
			$select->from('user_women_measurement', '*')
				->where('User_referee_id = ?', $userRefereeID);
			}
			//echo $select;
			return $db->fetchAll($select);
		}
	
	}
?>