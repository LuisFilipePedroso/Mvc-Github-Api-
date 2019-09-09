<?php 

class UserDTO {

    private $id;
    private $name;
    private $username;
    private $email;
    private $blog;
    private $followers;
    private $following;
    private $location;
    private $company;
    private $bio;
    private $publicRepos;
    private $gitCode;

    public function __construct($id, 
                                $name = "", 
                                $username = "", 
                                $email = "", 
                                $blog = "", 
                                $followers = "", 
                                $following = "", 
                                $location = "", 
                                $company = "", 
                                $bio = "", 
                                $publicRepos = "", 
                                $gitCode = "") {

        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->blog = $blog;
        $this->followers = $followers;
        $this->following = $following;
        $this->location = $location;
        $this->company = $company;
        $this->bio = $bio;
        $this->publicRepos = $publicRepos;
        $this->gitCode = $gitCode;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setUsername($username) {
        $this->name = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setEmail($name) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setBlog($name) {
        $this->blog = $blog;
    }

    public function getBlog() {
        return $this->blog;
    }

    public function setFollowers($followers) {
        $this->followers = $followers;
    }

    public function getFollowers() {
        return $this->followers;
    }

    public function setFollowing($following) {
        $this->following = $following;
    }

    public function getFollowing() {
        return $this->following;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function getCompany() {
        return $this->company;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setPublicRepos($publicRepos) {
        $this->publicRepos = $publicRepos;
    }

    public function getPublicRepos() {
        return $this->publicRepos;
    }

    public function setGitCode($gitcode) {
        $this->gitCode = $gitcode;
    }

    public function getGitCode() {
        return $this->gitCode;
    }
}