<?
	class nav extends DB{
		function __construct(){
			parent::__construct();
		}
		function getDir(){
			try{
				$sql = "SELECT id, title, titleRus FROM navigation";
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
				$sql = "SELECT id, title, titleRus FROM navigation WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);
			}catch (Exception $error){
				return false;
			}
		}
		function addDir($title, $id){
			try{
					$sql = "INSERT INTO navigation (id, title) VALUES ('$id', '$title')";
					$res = $this->_db->query($sql);
					if (!$res){
						throw Exception ($this->_db->LastErrorMsg());
					}else{
						return true;
					}
				
			}catch (Exception $error){
				return false;
			}
		}
		function deleteDir($id){
			try{
				$sql = "select title FROM navigation WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				$res = $this->db2arr($res);
				$title = $res['0']['title'];
				$sql = "delete  FROM navigation WHERE id = '$id'";
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				$path = "../inc/$title.php";
				if(file_exists($path))
					unlink($path);
				return true;
			}catch (Exception $error){
				return false;
			}
		}
		function getNameDir($id){
			try{
				$sql = "SELECT title FROM navigation WHERE id = '$id'";
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
		function translateDir($id, $titleRus){
			try{
					$sql = "UPDATE navigation SET titleRus = '$titleRus' where id='$id'";
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
?>