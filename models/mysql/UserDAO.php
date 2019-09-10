<?php
require realpath(dirname(__DIR__)) . '/iModel.php';
require realpath(dirname(__DIR__)) . '/mysql/UserDTO.php';
require realpath(dirname(__DIR__)) . '/mysql/connection.php';

class UserDAO implements iModel{

    private $conn;

    public function __construct() {
        $this->conn = connect();
    }

    public function createObj($user) {
        return new UserDto($user['id'], 
                            $user['name'], 
                            $user['username'], 
                            $user['email'], 
                            $user['blog'],
                            $user['followers'], 
                            $user['following'], 
                            $user['location'], 
                            $user['company'],
                            $user['bio'], 
                            $user['publicRepos'], 
                            $user['gitCode'],
                            $user['avatarurl']);
    }
    
    public function get() {
        try {
            $sql = 'SELECT * FROM users';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $userList = [];

            foreach($result as $user) {
                $userDTO = new UserDto($user['id'], 
                                        $user['name'], 
                                        $user['username'], 
                                        $user['email'], 
                                        $user['blog'],
                                        $user['followers'], 
                                        $user['following'], 
                                        $user['location'], 
                                        $user['company'],
                                        $user['bio'], 
                                        $user['publicRepos'], 
                                        $user['gitCode'],
                                        $user['avatarurl']);
                array_push($userList, $userDTO);
            }

            return $userList;
        } catch (PDOException $e) {
            return $e;
        }
    }  
    
    public function getById($id) {
        try {
            $sql = 'SELECT * FROM users WHERE id = ' . $id;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch();

            $userDTO = new UserDto($user['id'], 
                                    $user['name'], 
                                    $user['username'], 
                                    $user['email'], 
                                    $user['blog'],
                                    $user['followers'], 
                                    $user['following'], 
                                    $user['location'], 
                                    $user['company'],
                                    $user['bio'], 
                                    $user['publicRepos'], 
                                    $user['gitCode'],
                                    $user['avatarurl']);
            return $userDTO;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getByUsername($username) {
        try {
            $sql = "SELECT * FROM users WHERE username LIKE  '%" . $username . "%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch();

            if($user && $user !== false) {
                $userDTO = new UserDto($user['id'], 
                                        $user['name'], 
                                        $user['username'], 
                                        $user['email'], 
                                        $user['blog'],
                                        $user['followers'], 
                                        $user['following'], 
                                        $user['location'], 
                                        $user['company'],
                                        $user['bio'], 
                                        $user['public_repos'], 
                                        $user['gitcode'],
                                    $user['avatarurl']);
                return $userDTO;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    public function create($user) {
        try {
            $sql = 'INSERT INTO users (name, username, email, blog, followers, following, location, company, bio, public_repos, gitcode, avatarurl) VALUES (:name, :username, :email, :blog, :followers, :following, :location, :company, :bio, :public_repos, :gitcode, :avatarurl)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':username', $user['login']);
            $stmt->bindParam(':email', $user['email']);
            $stmt->bindParam(':blog', $user['blog']);
            $stmt->bindParam(':followers', $user['followers']);
            $stmt->bindParam(':following', $user['following']);
            $stmt->bindParam(':location', $user['location']);
            $stmt->bindParam(':company', $user['company']);
            $stmt->bindParam(':bio', $user['bio']);
            $stmt->bindParam(':public_repos', $user['public_repos']);
            $stmt->bindParam(':gitcode', $user['id']);
            $stmt->bindParam(':avatarurl', $user['avatar_url']);
            $stmt->execute();

            $userDTO = new UserDto(99,
                                    $user['name'], 
                                    $user['login'], 
                                    $user['email'], 
                                    $user['blog'],
                                    $user['followers'], 
                                    $user['following'], 
                                    $user['location'], 
                                    $user['company'],
                                    $user['bio'], 
                                    $user['public_repos'], 
                                    $user['id'],
                                    $user['avatar_url']);

            return $userDTO;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }  
    
    public function update($user) {
        try {
            $sql = 'UPDATE users SET name = :name, username = :username, email = :email, blog = :blog, followers = :followers, following = :following, location = :location, company = :company, bio = :bio, public_repos = :public_repos, gitcode = :gitcode, avatarurl = :avatarurl WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':username', $user['username']);
            $stmt->bindParam(':email', $user['email']);
            $stmt->bindParam(':blog', $user['blog']);
            $stmt->bindParam(':followers', $user['followers']);
            $stmt->bindParam(':following', $user['following']);
            $stmt->bindParam(':location', $user['location']);
            $stmt->bindParam(':company', $user['company']);
            $stmt->bindParam(':bio', $user['bio']);
            $stmt->bindParam(':public_repos', $user['public_repos']);
            $stmt->bindParam(':gitcode', $user['gitcode']);
            $stmt->bindParam(':avatarurl', $user['avatarurl']);
            $stmt->bindParam(':id', $user['id']);
            $stmt->execute();

            return 'SUCCESS';

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id) {
        try {
            $sql = 'DELETE FROM users WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return 'SUCCESS';

        } catch (PDOExpcetion $e) {
            return 'ERROR';
        }
    }
}