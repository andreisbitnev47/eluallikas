<?
	class DB{
		const DB_NAME = "/home/estcomme/public_html/eluallikas.ee/sammud.db";
		protected $_db;

		function __construct(){
			try{	
				if (is_file(self::DB_NAME)){
					$res = $this->_db = new SQLite3(self::DB_NAME);
				
				if (!$res)
					throw new Exception ($this->_db->lastErrorMsg());
				return true;
					
				}else{
					$this->_db = new SQLite3(self::DB_NAME);
					$sql = "create table slides(id INTEGER PRIMARY KEY AUTOINCREMENT,
										title TEXT,
										datetime INTEGER)";
					$res = $this->_db->exec($sql);
					
					$sql = "CREATE table navigation (id INTEGER PRIMARY KEY, title TEXT, title TEXT)";
					$res = $this->_db->exec($sql);
					
					$sql = "CREATE table blocks (id TEXT PRIMARY KEY, 
												title TEXT,
												img TEXT,
												descr TEXT)";
					$res = $this->_db->exec($sql);
					
					$sql = "CREATE table albums (id TEXT PRIMARY KEY, 
												title TEXT";
					$res = $this->_db->exec($sql);
					
					$sql = "CREATE fotos albums (id TEXT PRIMARY KEY, 
												title TEXT";
					$res = $this->_db->exec($sql);
				if (!res)
					throw new Exception ($this->_db->lastErrorMsg);
				return true;
				}
			}	
			catch (Exception $error){
				return false; 
			}
		}
	
		function __destruct(){
			unset($this->_db);
		}
		
		function clearStr($data){
			$data = trim(strip_tags($data));
			return $this->_db->escapeString($data);
		}
		function escapeStr($data){
			$data = trim($data);
			return $this->_db->escapeString($data);
		}
		function clearInt($data){
			return abs((int)$data);
		}
		function db2Arr($data){
			$arr = array();
			while($row = $data->fetchArray(SQLITE3_ASSOC))
				$arr[] = $row;
			return $arr;
		}
		function clearBlanks($data){
			return str_replace(' ','_',$data);
		}
		function addblanks($data){
			return str_replace('_',' ',$data);
		}
		
	}
?>