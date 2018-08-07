<?
	class blocks extends DB{
		function __construct(){
			parent::__construct();
		}
		function getBlocks(){
			try{
				$sql = "SELECT id, title, img, descr, titleRus, descrRus FROM blocks order by id asc";
				$res = $this->_db->query($sql);
				if (!$res){
					throw new Exception ($this->_db->LastErrorMsg());
				}else{
					return $this->db2Arr($res);
				}
			}catch (Exception $error){
				return false;
			}
		}
		function getOneDir($id){
			try{
				$sql = "SELECT id, title, titleRus FROM blocks WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw Exception ($this->_db->LastErrorMsg());
				return $this->db2Arr($res);
			}catch (Exception $error){
				return false;
			}
		}
		function addDir($id, $title, $img, $descr){
			try{
					$sql = "INSERT INTO blocks(id, title, img, descr) VALUES ('$id', 
																						'$title',
																						'$img',
																						'$descr')";
					$res = $this->_db->query($sql);
					if (!$res){
						throw new Exception ($this->_db->LastErrorMsg());
					}else{
						$img = 'pics/blocks/'.unserialize($img);
						$path = fopen ("../inc/block-$id.php", 'w');
						fwrite($path, "<article><div id='pageBody'><h2>$title<h2><img src='$img'><p>$content</p></div></article>");
						fclose ($path);
						return true;
					}
			}catch (Exception $error){
				return $error;
			}
		}
		function deleteBlock($id){
			try{
				$sql = "select img FROM blocks WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				$res = $this->db2arr($res);
				$img = $res['0']['img'];
				
				$sql = "delete  FROM blocks WHERE id = '$id'";
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				$path = '../pics/blocks/'.unserialize($img);
				if(file_exists($path))
					unlink($path);
				$path = "../inc/block-$id.php";
				if(file_exists($path))
					unlink($path);
				return true;
			}catch (Exception $error){
				return false;
			}
		}
		function getNameDir($id){
			try{
				$sql = "SELECT title FROM blocks WHERE id = '$id'";
				$res = $this->_db->query($sql);
				if (!$res)
					throw new Exception ($this->_db->LastErrorMsg());
				$array = $this->db2Arr($res);
				$name = $array[0]['title'];
				return $name;
			}catch (Exception $error){
				return false;
			}
		}
		function translateTitle($id, $titleRus){
			try{
					$sql = "UPDATE blocks SET titleRus = '$titleRus' where id='$id'";
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
		function translateDescr($id, $descrRus){
			try{
					$sql = "UPDATE blocks SET descrRus = '$descrRus' where id='$id'";
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