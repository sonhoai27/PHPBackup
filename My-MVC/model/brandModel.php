<?php
class brandModel extends BaseModel{
    public function getBrand($numRows = 0, $sts = 0){
        global $db;
		$data = array();
		if($sts == 0){
			$data['brands'] = $db->query("select * from list_brand_prd order by id_brand desc limit ".$numRows.",16");
		}else if($sts == 1){
			$data['brands'] = $db->query("select * from list_brand_prd order by id_brand ");
		}
		
		$db->query("select * from list_brand_prd order by id_brand");
		$data['numRows'] = $db->num_row();
        return $data;
    }
	public function detail($id){
		global $db;
		return $db->select("list_brand_prd", "id_brand=".$db->sqlQuote($id));
	}
	public function add($data){
		global $db;
		return $db->insert($data, "list_brand_prd");
	}
	public function edit($data, $id){
		global $db;
		$where = "id_brand = ".$db->sqlQuote($id);
		return $db->update($data, 'list_brand_prd', $where);
	}
	public function search($key){
		global $db;
		$db->query("select * from list_brand_prd  where name_brand like '%".$db->sqlQuote($key)."%' order by id_brand");
		return $db->fetch_array();
	}
}