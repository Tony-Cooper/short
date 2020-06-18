<?php

    namespace app\controllers;

    class Main extends \app\core\Controller {
        public function index() {
            if($_COOKIE['log'] != '') {
                $links = $this->model('Links');

                $this->view('main/index', $links->getLinks());

            }

            else {
                $data['reg'] = "<p class='hint'><i class=\"fas fa-info-circle\"></i> Для того чтобы воспользоваться сервисом, необходимо зарегистрироваться.</p>";
                $this->view('user/reg', $data);
            }
        }

        public function addLink() {
            $links = $this->model('Links');
            $result = $links->validLink($_POST['short'], $_POST['long']);
            if($result != 'success') {

                $info['error'] = $result;
                $this->view('main/index', $links->getLinks(), $info);
            } else {
                $result = $links->setLink($_POST['long'], $_POST['short']);
                if($result = 'done') {
                    $info['success'] = 'Ссылка успешно добавлена!';
                    $this->view('main/index', $links->getLinks(), $info);
                }
            }
        }

        public function del() {
            $links = $this->model('Links');
            $result = $links->delLink($_POST['link']);

            if($result == true) {
                $info['success'] = 'Ссылка успешно удалена';
                $this->view('main/index', $links->getLinks(), $info);
            }
            else {
                $info['error'] = $result;
                $this->view('main/index', $links->getLinks(), $info);
            }
        }
    }