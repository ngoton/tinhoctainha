<?php

Class categoriesModel Extends baseModel {
	protected $table = "categories";

	public function getAllCategories($data = null,$join = null) 
    {
        return $this->fetchAll($this->table,$data,$join);
    }

    public function createCategories($data) 
    {    
        /*$data = array(
        	'username' => $data['username'],
        	'password' => $data['password'],
        	'create_time' => $data['create_time'],
        	'role' => $data['role'],
        	);*/
        return $this->insert($this->table,$data);
    }
    public function updateCategories($data,$id) 
    {    
        if ($this->getCategoriesByWhere($id)) {
        	/*$data = array(
	        	'username' => $data['username'],
	        	'password' => $data['password'],
	        	'create_time' => $data['create_time'],
	        	'role' => $data['role'],
	        	);*/
	        return $this->update($this->table,$data,$id);
        }
        
    }
    public function deleteCategories($id){
    	if ($this->getCategories($id)) {
    		return $this->delete($this->table,array('categories_id'=>$id));
    	}
    }
    public function getCategories($id){
    	return $this->getByID($this->table,$id);
    }
    public function getCategoriesByWhere($where){
        return $this->getByWhere($this->table,$where);
    }
    public function getLastCategories(){
        return $this->getLast($this->table);
    }
    public function queryCategories(){
        return $this->query($this->table);
    }
}
?>