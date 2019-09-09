<?php

$option = $_POST['option'];
$payload = $_POST['payload'] !== null ? $_POST['payload'] : null;

require('../controllers/UserController.php');

$userController = new UserController();

switch($option) {
    case 'SEARCH_USER':
        $user = $userController->search($payload['user']);
        $arr = [
            'name' => $user->getName(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'blog' => $user->getBlog(),
            'followers' => $user->getFollowers(),
            'following' => $user->getFollowing(),
            'location' => $user->getLocation(),
            'company' => $user->getCompany(),
            'bio' => $user->getBio(),
            'publicRepos' => $user->getPublicRepos(),
            'gitCode' => $user->getGitCode()
        ];

        echo json_encode($arr);
        break;
    case 'GET':
        $users = $userController->get();
        $arr = [];
        foreach($users as $user) {
            array_push($arr, [
                'id' => $user->getId(),
                'name' => $user->getName(), 
                'email' => $user->getEmail(), 
                'age' => $user->getAge()
                ]
            );
        }
        echo json_encode($arr);
        break;
    case 'GET_BY_ID':
        $user = $userController->getById($payload['id']);
        $arr = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'age' => $user->getAge()
        ];

        echo json_encode($arr);
        break;
    case 'POST':
        $user = $userController->create($payload['user']);
        echo json_encode($user);
        break;
    case 'PUT':
        $user = $userController->update($payload['user']);
        echo json_encode($user);
        break;
    case 'DELETE':
        echo json_encode($userController->destroy($payload['id']));
    default:
        return; 
}