<?php

  /**
  * ObjectMembers
  *
  * @author Diego Castiglioni <diego.castiglioni@fengoffice.com>
  */
  class ObjectMembers extends BaseObjectMembers {
    
    	
  		static function addObjectToMembers($object_id, $members_array){
  			
  			foreach ($members_array as $member){
  				$exists = self::findOne(array("conditions" => array("`object_id` = ? AND `member_id` = ? ", $object_id, $member->getId()))) != null;
  				if (!$exists) {
	  				$om = new ObjectMember();
	  				$om->setObjectId($object_id);
	  				$om->setMemberId($member->getId());
	  				$om->setIsOptimization(0);
	  				$om->save();
  				}
  			}
  			
  			foreach ($members_array as $member){
  				$parents = $member->getAllParentMembersInHierarchy();
  				$stop = false;
  				foreach ($parents as $parent){
  					if (!$stop){
	  					$exists = self::findOne(array("conditions" => array("`object_id` = ? AND `member_id` = ? ", 
	  							  $object_id, $parent->getId())))!= null;
	  					if (!$exists){
	  						$om = new ObjectMember();
			  				$om->setObjectId($object_id);
			  				$om->setMemberId($parent->getId());
			  				$om->setIsOptimization(1);
			  				$om->save();
	  					} 	
	  					else $stop = true;	
  					} 
  				}
  			}
  		}
  		
  		
		/**
		 * Removes the object from those members where the user can see the object(and its corresponding parents)
		 * 
		 */
  		static function removeObjectFromMembers(ContentDataObject $object, Contact $contact, $context_members, $members_to_remove = null){
  			
  			if (is_null($members_to_remove)) {
  				$member_ids = array_flat(DB::executeAll("SELECT member_id FROM ".TABLE_PREFIX."object_members WHERE object_id = " . $object->getId()));
  			} else {
  				$member_ids = $members_to_remove;
  			}
  			
  			foreach($member_ids as $id){
				
				$member = Members::findById($id);
				if (!$member instanceof Member) continue;
				
				//can write this object type in the member
				$can_write = $object->canAddToMember($contact, $member, $context_members);
				
				
				if ($can_write){
					$om = self::findById(array('object_id' => $object->getId(), 'member_id' => $id));
					if ($om instanceof ObjectMember) {
						$om->delete();
					}
					
					$stop = false;
					while ($member->getParentMember() != null && !$stop){
						$member = $member->getParentMember();
						$obj_member = ObjectMembers::findOne(array("conditions" => array("`object_id` = ? AND `member_id` = ? AND 
									`is_optimization` = 1", $object->getId(),$member->getId())));
						if (!is_null($obj_member)) {
							$obj_member->delete();
						}
						else $stop = true;
					}
				}
			}
  		}
  		
  		
  		static function getMemberIdsByObject($object_id){
  			if ($object_id) {
	  			$db_res = DB::execute("SELECT member_id FROM ".TABLE_PREFIX."object_members WHERE object_id = $object_id AND is_optimization = 0");
	  			$rows = $db_res->fetchAll();
  			} else {
  				return array();
  			}
  				
  			$member_ids = array();
  			if(count($rows) > 0){
  				foreach ($rows as $row){
  					$member_ids[] = $row['member_id'];
  				}
  			}
  			
  			return $member_ids;
  		}
  		
  		
  		private $cached_object_members = array();
  		function getCachedObjectMembers($object_id, $all_object_ids = null) {
  			if (!isset($this->cached_object_members[$object_id])) {
  				if (is_array($all_object_ids) && count($all_object_ids) > 0) {
  					$obj_cond = "AND object_id IN (".implode(",", $all_object_ids).")";
  				} else {
  					$obj_cond = "AND object_id = $object_id";
  				}
  				$db_res = DB::execute("SELECT object_id, member_id FROM ".TABLE_PREFIX."object_members WHERE is_optimization = 0 $obj_cond");
  				$rows = $db_res->fetchAll();
  				foreach ($rows as $row) {
  					if (!isset($this->cached_object_members[$row['object_id']])) $this->cached_object_members[$row['object_id']] = array();
  					$this->cached_object_members[$row['object_id']][] = $row['member_id'];
  				}
  				
  				if (is_array($all_object_ids)) {
  					foreach ($all_object_ids as $oid) {
  						if (!isset($this->cached_object_members[$oid])) $this->cached_object_members[$oid] = array();
  					}
  				}
  			}
  			return array_var($this->cached_object_members, $object_id, array());
  		}
  		
  		
  		
    	static function getMembersByObject($object_id){
  			$ids = self::getMemberIdsByObject($object_id);
  			$members = Members::findAll(array("conditions" => "`id` IN (".implode(",", $ids).")"));
  			
  			return $members;				  
  		}
  		
  		
  		static function getMembersByObjectAndDimension($object_id, $dimension_id, $extra_conditions = "") {
  			$sql = "
  				SELECT m.* 
  				FROM ".TABLE_PREFIX."object_members om 
  				INNER JOIN ".TABLE_PREFIX."members m ON om.member_id = m.id 
  				WHERE 
  					dimension_id = '$dimension_id' AND 
  					om.object_id = '$object_id' 
  					$extra_conditions
  				ORDER BY m.name";
  			
  			$result = array();
  			$rows = DB::executeAll($sql);
  			if (!is_array($rows)) return $result;
  			
  			foreach ($rows as $row) {
  				$member = new Member();
  				$member->setFromAttributes($row);
  				$member->setId($row['id']);
  				$result[] = $member;
  			}
  			return $result;
  		}
     
  		
  } // ObjectMembers 

?>