<?php
Class tagsController Extends baseController {
    public function index() {
            
            $link = $this->registry->router->action;
            $tag_model = $this->model->get('tagsModel');
            $data = array('tags_link'=>$link);
            $tags = $tag_model->getTagsByWhere($data);
            if (!$tags) {
               return $this->view->redirect();
             }

             $categorie_model = $this->model->get('categoriesModel');
             $categorie_datas = $categorie_model->getAllCategories();
             $c_data = array();
             foreach ($categorie_datas as $c) {
                 $c_data[$c->categories_id]['name'] = $c->categories_name;
                 $c_data[$c->categories_id]['link'] = $c->categories_link;
             }
             $this->view->data['categorie_datas'] = $c_data;

             $posts_model = $this->model->get('postsModel');

             $data = array(
              'order_by'=>'posts_date',
              'order'=>'DESC',
              'limit'=>'10',
              'where' => 'posts_tags LIKE "%,'.$tags->tags_id.',%" OR posts_tags LIKE "'.$tags->tags_id.',%" OR posts_tags LIKE "%,'.$tags->tags_id.'" OR posts_tags = '.$tags->tags_id,
              );

             $posts = $posts_model->getAllPosts($data);

             $this->view->data['posts'] = $posts;

             $this->view->data['name_tag'] = $tags->tags_name;

             $this->view->data['title'] = $tags->tags_name.' Tag | Programming, Network, Office, Hardware, Software, Design, Photography..';

            $this->view->show('tags/index');
    }
    

}
?>