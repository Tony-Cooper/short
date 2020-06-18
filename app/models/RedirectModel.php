<?php

    namespace App\models;

    require 'DB.php';

    class RedirectModel {

        private $_db = null;

        public function changeUrl($path) {
            $this->_db = DB::getInstance();
            $short = 'http://176.37.246.42/s/' . $path;
            $link = $this->_db->query("SELECT LongLink FROM links WHERE ShortLink = '$short'");
            $result = $link->fetch(\PDO::FETCH_ASSOC);
            if($result['LongLink'] != '') {
                $target = 'location: ' . $result['LongLink'];
                header($target);
            }
            else
                return 'error';
        }
    }