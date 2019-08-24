<?php
Class categoriesController Extends baseController {
    public function index() {
            
            $link = $this->registry->router->action;
            $categorie_model = $this->model->get('categoriesModel');
            $data = array('categories_link'=>$link);
            $categories = $categorie_model->getCategoriesByWhere($data);
            if (!$categories) {
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
              'where' => 'posts_categories LIKE "%,'.$categories->categories_id.',%" OR posts_categories LIKE "'.$categories->categories_id.',%" OR posts_categories LIKE "%,'.$categories->categories_id.'" OR posts_categories = '.$categories->categories_id,
              );

             $posts = $posts_model->getAllPosts($data);

             $this->view->data['posts'] = $posts;

             $this->view->data['name_categorie'] = $categories->categories_name;

             $this->view->data['title'] = $categories->categories_name.' Category | Programming, Network, Office, Hardware, Software, Design, Photography..';

            $this->view->show('categories/index');
    }
    

}
?>