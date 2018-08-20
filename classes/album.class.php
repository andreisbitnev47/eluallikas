<?php
	class album extends DB{
		function __construct(){
			parent::__construct();
		}
		function getDir(){
			try{
				$sql = "SELECT id, title, src, titleRus FROM albums";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);
			}catch (Exception $error){
				return false;
			}
		}
		function getOneDir($id){
			try{
				$sql = "SELECT id, title, src, titleRus FROM albums WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);
			}catch (Exception $error){
				return false;
			}
		}
		function addDir($title, $id, $src){
			try{
					$sql = "INSERT INTO albums (title, id, src) VALUES ('$title', '$id', '$src')";
					$res = $this->_db->query($sql);
					if (!$res){
						throw new Exception ($this->_db->LastErrorMsg());
					}else{
						return true;
					}
				
			}catch (Exception $error){
				return false;
			}
		}
		function deleteDir($id){
			try{
				$sql = "delete  FROM albums WHERE id = '$id'";
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return true;
			}catch (Exception $error){
				return false;
			}
		}
		function getNameDir($id){
			try{
				$sql = "SELECT title FROM albums WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				$array = $this->db2Arr($res);
				$name = $array[0]['title'];
				return $name;
			}catch (Exception $error){
				return false;
			}
		}
		function albumCnt(){
			try{	
				$sql = "SELECT id FROM albums order by id desc limit 1";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				$array = $this->db2Arr($res);
				$id = $array[0]['id'];
				$i= str_replace('alb','',$id);
				$i= $this->clearStr($i);//число последнего альбома
				return $i;	
			}catch (Exception $error){
				return false;
			}
		}
		function translateTitle($id, $titleRus){
			try{
					$sql = "UPDATE albums SET titleRus = '$titleRus' where id='$id'";
					$res = $this->_db->exec($sql);
					if (!$res){
						throw new Exception ($this->_db->LastErrorMsg());
					}else{
						return true;
					}
				
			}catch (Exception $error){
				return false;
			}
		}
	}