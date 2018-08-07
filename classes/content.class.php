<?
class content extends DB{
	function __construct(){
			parent::__construct();
		}
	function createDirDB($title){
		try {
			$sql = "CREATE TABLE $title (id TEXT primary key,
										content TEXT, 
										contentRus TEXT)";
			$res = $this->_db->exec($sql);
			if (!$res)
				Throw new Exception ($this->_db->LastErrorMsg());
			return true;
		}catch (Exception $error){
			return $error;
		}
	}
	function deleteDirDB($title){
		try {
			$sql = "drop table $title";
			$res =	$this->_db->exec($sql);
			if (!$res)
				Throw new Exception ($this->_db->LastErrorMsg());
			return true;
		}catch (Exception $error){
			return false;		
		}
	}
	function getDivs($pageName){
			try{
				$sql = "SELECT id, content, contentRus FROM $pageName order by id asc";
				$res = $this->_db->query($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);
			}catch (Exception $error){
				return false;
			}
	}
	function saveContent($id, $finInput, $pageName){
			try{
				$sql = "INSERT INTO $pageName (id, content) VALUES ('$id', '$finInput')";
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return true;
			}catch (Exception $error){
				return false;
			}
	}
	function getPicName($id, $pageName){
		try{
			$sql = "select content FROM $pageName WHERE id = '$id'";
			$res = $this->_db->query($sql);
			if (!$res)
				throw new Exception ($this->_db->LastErrorMsg());
			else{
				$res = $this->db2Arr($res);
				$content = $res[0]['content'];
				$arr=array(); //temporary array
				for ($i = strlen($content)-1; $i>=0; $i--){
					if ($content[$i]=='>' or $content[$i]=="'")
						continue;
					else {
						array_unshift($arr, $content[$i]);
						if ($content[$i] == '/')
							break;
					}
				}
				unset ($arr[0]);
				foreach ($arr as $letter){
					$name = $name.$letter;
				}
				return $name;
			}	
		}catch (Exception $error){
			return false;
		}
	}
	function deleteDiv($id, $pageName){
			try{
				$picName = $this->getPicName($id, $pageName);
				$picPath = '../pics/pagePics/'.$picName;
				if(file_exists($picPath))
					unlink($picPath);
				$sql = "delete  FROM $pageName WHERE id = '$id'";
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return true;
			}catch (Exception $error){
				return false;
			}
	}
	function saveContentRus($id, $finInput, $pageName){
			try{
				$sql = "UPDATE $pageName set contentRus = '$finInput' WHERE id = '$id'";
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return true;
			}catch (Exception $error){
				return false;
			}
	}
	function getContentById($id, $pageName){
			try{
				$sql = "select content from $pageName where id ='$id'";
				$res = $this->_db->query($sql);
				$arr = $this->db2Arr($res);
				$content = $arr[0]['content'];
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				return $content;
			}catch (Exception $error){
				return false;
			}
	}

}
?>