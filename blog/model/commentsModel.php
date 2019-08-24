<?php

Class commentsModel Extends baseModel {
	protected $table = "comments";

	public function getAllComments($data = null,$join = null) 
    {
        return $this->fetchAll($this->table,$data,$join);
    }

    public function createComments($data) 
    {    
        /*$data = array(
        	'Commentname' => $data['Commentname'],
        	'password' => $data['password'],
        	'create_time' => $data['create_time'],
        	'role' => $data['role'],
        	);*/
        return $this->insert($this->table,$data);
    }
    public function updateComments($data,$id) 
    {    
        if ($this->getCommentsByWhere($id)) {
        	/*$data = array(
	        	'Commentname' => $data['Commentname'],
	        	'password' => $data['password'],
	        	'create_time' => $data['create_time'],
	        	'role' => $data['role'],
	        	);*/
	        return $this->update($this->table,$data,$id);
        }
        
    }
    public function deleteComments($id){
    	if ($this->getComments($id)) {
    		return $this->delete($this->table,array('comments_id'=>$id));
    	}
    }
    public function getComments($id){
    	return $this->getByID($this->table,$id);
    }
    public function getCommentsByWhere($where){
        return $this->getByWhere($this->table,$where);
    }
    public function getLastComments(){
        return $this->getLast($this->table);
    }
    public function queryComments(){
        return $this->query($this->table);
    }
}
?>