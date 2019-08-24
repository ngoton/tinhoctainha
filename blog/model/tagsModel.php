<?php

Class tagsModel Extends baseModel {
	protected $table = "tags";

	public function getAllTags($data = null,$join = null) 
    {
        return $this->fetchAll($this->table,$data,$join);
    }

    public function createTags($data) 
    {    
        /*$data = array(
        	'username' => $data['username'],
        	'password' => $data['password'],
        	'create_time' => $data['create_time'],
        	'role' => $data['role'],
        	);*/
        return $this->insert($this->table,$data);
    }
    public function updateTags($data,$id) 
    {    
        if ($this->getTagsByWhere($id)) {
        	/*$data = array(
	        	'username' => $data['username'],
	        	'password' => $data['password'],
	        	'create_time' => $data['create_time'],
	        	'role' => $data['role'],
	        	);*/
	        return $this->update($this->table,$data,$id);
        }
        
    }
    public function deleteTags($id){
    	if ($this->getTags($id)) {
    		return $this->delete($this->table,array('tags_id'=>$id));
    	}
    }
    public function getTags($id){
    	return $this->getByID($this->table,$id);
    }
    public function getTagsByWhere($where){
        return $this->getByWhere($this->table,$where);
    }
    public function getLastTags(){
        return $this->getLast($this->table);
    }
    public function queryTags(){
        return $this->query($this->table);
    }
}
?>