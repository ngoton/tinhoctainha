<?php

Class postsModel Extends baseModel {
	protected $table = "posts";

	public function getAllPosts($data = null,$join = null) 
    {
        return $this->fetchAll($this->table,$data,$join);
    }

    public function createPosts($data) 
    {    
        /*$data = array(
        	'username' => $data['username'],
        	'password' => $data['password'],
        	'create_time' => $data['create_time'],
        	'role' => $data['role'],
        	);*/
        return $this->insert($this->table,$data);
    }
    public function updatePosts($data,$id) 
    {    
        if ($this->getPostsByWhere($id)) {
        	/*$data = array(
	        	'username' => $data['username'],
	        	'password' => $data['password'],
	        	'create_time' => $data['create_time'],
	        	'role' => $data['role'],
	        	);*/
	        return $this->update($this->table,$data,$id);
        }
        
    }
    public function deletePosts($id){
    	if ($this->getPosts($id)) {
    		return $this->delete($this->table,array('posts_id'=>$id));
    	}
    }
    public function getPosts($id){
    	return $this->getByID($this->table,$id);
    }
    public function getPostsByWhere($where){
        return $this->getByWhere($this->table,$where);
    }
    public function getLastPosts(){
        return $this->getLast($this->table);
    }
    public function queryPosts(){
        return $this->query($this->table);
    }
}
?>