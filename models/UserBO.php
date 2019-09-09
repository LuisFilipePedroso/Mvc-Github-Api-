<?php 

class UserBO {

    private $model;

    public function __construct(iModel $model) {
        $this->model = $model;
    }

    public function get() {
        return $this->model->get();   
    }

    public function getById($id) {
        return $this->model->getById($id);   
    }

    public function getByUsername($username) {
        return $this->model->getByUsername($username);   
    }

    public function create($user) {
        return $this->model->create($user);   
    }

    public function update($user) {
        return $this->model->update($user);   
    }

    public function destroy($id) {
        return $this->model->destroy($id);
    }
}