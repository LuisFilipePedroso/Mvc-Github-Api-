<?php 

interface iModel {
    
    public function get();
    public function getById($id);
    public function create($data);
    public function update($data);
    public function destroy($data);
}