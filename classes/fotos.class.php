<?
	class fotos extends DB{
		function __construct(){
			parent::__construct();
		}
		function getDir(){
			try{
				$sql = "SELECT id, title, titleRus FROM fotos";
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
				$sql = "SELECT id, title, titleRus FROM fotos WHERE id = '$id'";
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
					$sql = "INSERT INTO fotos (id, title) VALUES ('$id', '$title')";
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
				$sql = "delete  FROM fotos WHERE id = '$id'";
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
				$sql = "SELECT title FROM fotos WHERE id = '$id'";
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
		function fotoCnt($albumId){
			try{	
				$sql = "SELECT id FROM fotos WHERE id LIKE '$albumId%' order by id desc limit 1";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				$array = $this->db2Arr($res);
				$lastId = $array[0]['id'];
				$cnt = str_replace($albumId,'',$lastId);
				return $cnt;
			}catch (Exception $error){
				return false;
			}
		}
		function fotoArr($id){
			try{
				$idArr = explode('_',$id);
				$idTemp = $idArr[0].'_';
				$sql = "SELECT id FROM fotos WHERE id like '$idTemp%' order by id asc";
				$res = $this->_db->query($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);
			}catch (Exception $error){
				return false;
			}
		}
	}
?>