<?php
	class slider extends DB{
		function addSlide($title){
			try{
				$dt = time();
				$sql = "INSERT INTO slides (title, datetime)
										VALUES ('$title', '$dt')";
				$res = $this->_db->exec($sql);
				if(!$res)
					throw new Exception($this->_db->lastErrorMsg());
				return true;
			}catch (Exception $error){
				return false;
			}
		}
		function getSlides(){
			try{
				$sql = "SELECT id, title, datetime FROM slides";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);	
			}catch (Exception $error){
				return false;
			}
		}
		
		function deleteSlide($id){
			try{
				$sql = "DELETE FROM slides WHERE id = '$id'";
				$res = $this->_db->exec($sql);
				if(!$res)
					throw new Exception($this->_db->lastErrorMsg());
				return true;
			}catch (Exception $error){
				return false;
			}
		}
	}