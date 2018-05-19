<?php
class dataModel extends BaseModel {
	public function getRows($where,$tbl){		
		global $db; 
		$db->selectall($tbl,$where);
		return $db->fetch_array();
	}	
	public function getRow($where,$tbl){
		global $db;
		$result = $db->select($tbl,$where);
		return $result;
	}

	public function edit($id, $data, $tbl){
		$this->router();
		global $db;
		return $db->update($data, $tbl, "`id`='{$id}'");		
	}
	public function editWhere($where, $data,$tbl){
		$this->router();
		global $db;
		return $db->update($data, $tbl, $where);		
	}
	public function add($data,$tbl){
		$this->router();
		global $db;
		return $db->insert($data, $tbl);		
	}
	public function del($id,$tbl){
		$this->router();
		global $db;
		$db->delete($tbl, "`id`='{$id}'");		
	}
	public function delWhere($where,$tbl){
		$this->router();
		global $db;
		$db->delete($tbl, $where);				
	}
	public function queryRows($sql){		
		global $db;		
		$result = $db->query($sql);
		return $db->fetch_array();
	}
	public function queryRow($sql){		
		global $db;		
		$result = $db->query($sql);
		return $db->fetch_array($result);
	}
	public function query($sql){		
		$this->router();
		global $db;		
		return $result = $db->query($sql);		
	}
}