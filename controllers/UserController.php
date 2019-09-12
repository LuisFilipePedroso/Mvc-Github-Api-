<?php

require('../models/mysql/UserDAO.php');
require('../models/UserBO.php');

class UserController {

    private $user;

    function __construct() {
        $this->user = new UserBO(new UserDAO());
    }

    private function makeRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: LuisFilipePedroso',
            'Accept: application/json',
            'Authorization:'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    function search($username) {
        //search the user on database
        $user = $this->user->getByUsername($username);

        //if not exists on database, search on api
        if($user === null) {
            $url = 'https://api.github.com/users/' . $username;
            $output = self::makeRequest($url);

            return $this->user->create(json_decode($output, true));
        } else {
            //return the user on database using get method
            return $user;
        }
    }

    function searchFollowers($username) {
        $url = 'https://api.github.com/users/' . $username . '/followers';
        $output = json_decode(self::makeRequest($url), true);
        $arr = [];

        foreach($output as $user) {
            $url = 'https://api.github.com/users/' . $user['login'];
            $result = json_decode(self::makeRequest($url), true);
            array_push($arr, $result);
        }
        
        return $arr;
    }

    function searchFollowing($username) {
        $url = 'https://api.github.com/users/' . $username . '/following';
        $output = json_decode(self::makeRequest($url), true);
        $arr = [];

        foreach($output as $user) {
            $url = 'https://api.github.com/users/' . $user['login'];
            $result = json_decode(self::makeRequest($url), true);
            array_push($arr, $result);
        }
        
        return $arr;
    }

    function searchRepos($username) {
        $url = 'https://api.github.com/users/' . $username . '/repos';
        $output = self::makeRequest($url);
        
        return json_decode($output, true);
    }

    function get() {
        return $this->user->get();
    }

    function getById($id) {
        return $this->user->getById($id);
    }

    function getByCode($code) {
        return $this->user->getByCode($code);
    }

    function create($user) {
        return $this->user->create($user);  
    }

    function update($user) {
        return $this->user->update($user);
    }

    function destroy($id) {
        return $this->user->destroy($id);
    }

    public function getUser() {
        return $this->user;
    }
}