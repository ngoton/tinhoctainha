<?php
Class postsController Extends baseController {
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

             $this->view->data['posts'] = $posts;
             $this->view->data['title'] = $posts->posts_title;

            $this->view->show('posts/index');
    }

    public function lists() {
        $this->view->setLayout('admin');
        if (!isset($_SESSION['userid_logined'])) {
            return $this->view->redirect('users/login');
        }
        $this->view->data['lib'] = $this->lib;
        $this->view->data['title'] = 'Bài viết';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_by = isset($_POST['order_by']) ? $_POST['order_by'] : null;
            $order = isset($_POST['order']) ? $_POST['order'] : null;
            $page = isset($_POST['page']) ? $_POST['page'] : null;
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : null;
            $limit = isset($_POST['limit']) ? $_POST['limit'] : 18446744073709;
            $ngaytao = isset($_POST['ngaytao']) ? $_POST['ngaytao'] : null;
            $ngaytaobatdau = isset($_POST['ngaytaobatdau']) ? $_POST['ngaytaobatdau'] : null;
            $batdau = isset($_POST['batdau']) ? $_POST['batdau'] : null;
            $ketthuc = isset($_POST['ketthuc']) ? $_POST['ketthuc'] : null;
            $trangthai = isset($_POST['trangthai']) ? $_POST['trangthai'] : null;
        }
        else{
            $order_by = $this->registry->router->order_by ? $this->registry->router->order_by : 'posts_id';
            $order = $this->registry->router->order_by ? $this->registry->router->order_by : 'DESC';
            $page = $this->registry->router->page ? (int) $this->registry->router->page : 1;
            $keyword = "";
            $limit = 50;
            $ngaytao = date('m-Y');
            $ngaytaobatdau = date('m-Y');
            $batdau = '01-'.date('m-Y');
            $ketthuc = date('t-m-Y');
            $trangthai = "";
        }

        $cate_model = $this->model->get('categoriesModel');
        $categories = $cate_model->getAllCategories();
        $this->view->data['categories'] = $categories;

        $tag_model = $this->model->get('tagsModel');
        $tags = $tag_model->getAllTags();
        $tag_data = array();
        foreach ($tags as $tag) {
            $tag_data['name'][$tag->tags_id] = $tag->tags_name;
        }
        $this->view->data['tag_data'] = $tag_data;

        $join = array('table'=>'users','where'=>'users.users_id = posts.posts_user');

        $post_model = $this->model->get('postsModel');

        $sonews = $limit;
        $x = ($page-1) * $sonews;
        $pagination_stages = 2;

        $data = array(
            'where' => '1=1',
        );

        
        $tongsodong = count($post_model->getAllPosts($data,$join));
        $tongsotrang = ceil($tongsodong / $sonews);
        

        $this->view->data['page'] = $page;
        $this->view->data['order_by'] = $order_by;
        $this->view->data['order'] = $order;
        $this->view->data['keyword'] = $keyword;
        $this->view->data['pagination_stages'] = $pagination_stages;
        $this->view->data['tongsotrang'] = $tongsotrang;
        $this->view->data['sonews'] = $sonews;
        $this->view->data['limit'] = $limit;
        $this->view->data['ngaytao'] = $ngaytao;
        $this->view->data['ngaytaobatdau'] = $ngaytaobatdau;
        $this->view->data['batdau'] = $batdau;
        $this->view->data['ketthuc'] = $ketthuc;
        $this->view->data['trangthai'] = $trangthai;

        $data = array(
            'order_by'=>$order_by,
            'order'=>$order,
            'limit'=>$x.','.$sonews,
            'where' => '1=1',
            );

        if ($keyword != '') {
            $search = ' AND ( posts_title LIKE "%'.$keyword.'%" 
                OR username LIKE "%'.$keyword.'%"
                )';
            $data['where'] .= $search;
        }
        
        $posts = $post_model->getAllPosts($data,$join);
        
        $this->view->data['posts'] = $posts;


        $this->view->data['lastID'] = isset($post_model->getLastPosts()->posts_id)?$post_model->getLastPosts()->posts_id:0;
        
        $this->view->show('posts/lists');
    }
    public function add(){
        if (!isset($_SESSION['userid_logined'])) {
            return $this->view->redirect('user/login');
        }
        
        if (isset($_POST['yes'])) {
            $tag_model = $this->model->get('tagsModel');

            $posts_tags = "";
            if(trim($_POST['posts_tags']) != ""){
                $support = explode(',', trim($_POST['posts_tags']));

                if ($support) {
                    foreach ($support as $key) {
                        $name = $tag_model->getTagsByWhere(array('tags_name'=>trim($key)));
                        if ($name) {
                            $tag_id .= $name->tags_id;
                        }
                        else{
                            $d = array(
                                'tags_name'=>trim($key),
                                'tags_link'=>$this->lib->stripUnicode(trim($key))
                            );

                            $tag_model->createTags($d);
                            $tag_id = $tag_model->getLastTags()->tags_id;
                        }

                        if ($posts_tags == "")
                            $posts_tags .= $tag_id;
                        else
                            $posts_tags .= ','.$tag_id;
                        
                    }
                }
            }

            $posts = $this->model->get('postsModel');
            $data = array(
                        'posts_date' => strtotime(date('d-m-Y')),
                        'posts_title' => trim($_POST['posts_title']),
                        'posts_desc' => trim($_POST['posts_desc']),
                        'posts_content' => trim($_POST['posts_content']),
                        'posts_link' => trim($_POST['posts_link']),
                        'posts_categories' => trim($_POST['posts_categories']),
                        'posts_tags' => $posts_tags,
                        );
            
            if ($_POST['yes'] != "") {
                

                    $posts->updatePosts($data,array('posts_id' => trim($_POST['yes'])));
                    echo "Cập nhật thành công";

                    date_default_timezone_set("Asia/Ho_Chi_Minh"); 
                        $filename = "action_logs.txt";
                        $text = date('d/m/Y H:i:s')."|".$_SESSION['user_logined']."|"."edit"."|".$_POST['yes']."|posts|".implode("-",$data)."\n"."\r\n";
                        
                        $fh = fopen($filename, "a") or die("Could not open log file.");
                        fwrite($fh, $text) or die("Could not write file!");
                        fclose($fh);
                
                
            }
            else{
                $data['posts_user'] = $_SESSION['userid_logined'];

                    $posts->createPosts($data);

                    echo "Thêm thành công";

                 

                    date_default_timezone_set("Asia/Ho_Chi_Minh"); 
                        $filename = "action_logs.txt";
                        $text = date('d/m/Y H:i:s')."|".$_SESSION['user_logined']."|"."add"."|".$posts->getLastPosts()->posts_id."|posts|".implode("-",$data)."\n"."\r\n";
                        
                        $fh = fopen($filename, "a") or die("Could not open log file.");
                        fwrite($fh, $text) or die("Could not write file!");
                        fclose($fh);
                
                
            }
                    
        }
    }

    public function delete(){
        if (!isset($_SESSION['userid_logined'])) {
            return $this->view->redirect('user/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post_model = $this->model->get('postsModel');
           
            if (isset($_POST['xoa'])) {
                $data = explode(',', $_POST['xoa']);
                foreach ($data as $data) {
                       $post_model->deletePosts($data);
                        echo "Xóa thành công";
                        date_default_timezone_set("Asia/Ho_Chi_Minh"); 
                        $filename = "action_logs.txt";
                        $text = date('d/m/Y H:i:s')."|".$_SESSION['user_logined']."|"."delete"."|".$data."|posts|"."\n"."\r\n";
                        
                        $fh = fopen($filename, "a") or die("Could not open log file.");
                        fwrite($fh, $text) or die("Could not write file!");
                        fclose($fh);
                    
                    
                }
                return true;
            }
            else{
                        $post_model->deletePosts($_POST['data']);
                        echo "Xóa thành công";
                        date_default_timezone_set("Asia/Ho_Chi_Minh"); 
                        $filename = "action_logs.txt";
                        $text = date('d/m/Y H:i:s')."|".$_SESSION['user_logined']."|"."delete"."|".$_POST['data']."|posts|"."\n"."\r\n";
                        
                        $fh = fopen($filename, "a") or die("Could not open log file.");
                        fwrite($fh, $text) or die("Could not write file!");
                        fclose($fh);
                    
            }
            
        }
    }

    public function getTag(){
        header('Content-type: application/json');
        $q = $_GET["search"];

        $tag_model = $this->model->get('tagsModel');
        $data = array(
            'where' => 'tags_name LIKE "%'.$q.'%"',
        );
        $tags = $tag_model->getAllTags($data);
        $arr = array();
        foreach ($tags as $tag) {
            $arr[] = $tag->tag_name;
        }
        
        echo json_encode($arr);
    }

}
?>