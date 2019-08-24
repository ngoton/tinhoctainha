<?php
Class indexController Extends baseController {
    public function index() {
        /*** set a template variable ***/
            //$this->view->data['welcome'] = 'Welcome to CAI MEP TRADING !';
        /*** load the index template ***/
            $this->view->data['title'] = 'Tech Blog | Programming, Network, Office, Hardware, Software, Design, Photography..';

             $posts_model = $this->model->get('postsModel');

             $join = array('table'=>'categories','where'=>'posts_categories=categories_id');
             $data = array(
              'order_by'=>'posts_date',
              'order'=>'DESC',
              'limit'=>'10',
              'where' => '1=1',
              );

             $posts = $posts_model->getAllPosts($data);

             $this->view->data['posts'] = $posts;

            $this->view->show('index');
    }
    public function post($link) {
             $posts_model = $this->model->get('postsModel');
             $data = array('posts_link'=>$link);

             $posts = $posts_model->getPostsByWhere($data);

             if (!$posts) {
               return $this->view->redirect();
             }

             $user_model = $this->model->get('usersModel');
             $user_datas = $user_model->getAllUser();
             $u_data = array();
             foreach ($user_datas as $u) {
                 $u_data[$u->users_id] = $u->username;
             }
             $this->view->data['user_datas'] = $u_data;

             $tag_model = $this->model->get('tagsModel');
             $tag_datas = $tag_model->getAllTags();
             $t_data = array();
             foreach ($tag_datas as $t) {
                 $t_data[$t->tags_id]['name'] = $t->tags_name;
                 $t_data[$t->tags_id]['link'] = $t->tags_link;
             }
             $this->view->data['tag_datas'] = $t_data;

             $categorie_model = $this->model->get('categoriesModel');
             $categorie_datas = $categorie_model->getAllCategories();
             $c_data = array();
             foreach ($categorie_datas as $c) {
                 $c_data[$c->categories_id]['name'] = $c->categories_name;
                 $c_data[$c->categories_id]['link'] = $c->categories_link;
             }
             $this->view->data['categorie_datas'] = $c_data;

             $comment_model = $this->model->get('commentsModel');
             $comments = $comment_model->getAllComments(array('comment_posts'=>$posts->posts_id));
             $total_comments = 0;
             foreach ($comments as $com) {
                 $total_comments ++;
             }
             $this->view->data['total_comments'] = $total_comments;

             $view = $posts->posts_view + 1;
             $posts_model->updatePosts(array('posts_view'=>$view),array('posts_id'=>$posts->posts_id));

             $this->view->data['posts'] = $posts;
             $this->view->data['title'] = $posts->posts_title;

            $this->view->show('posts/index');
    }

    public function view() {
        /*** set a template variable ***/
            $this->view->data['view'] = 'hehe';
        /*** load the index template ***/
            $this->view->show('index/view');
    }

}
?>