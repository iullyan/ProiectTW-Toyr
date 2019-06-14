<?php

require_once 'Model.php';
class CategoryModel extends MODEL
{
    public function getCategories() {
        $sql = "SELECT * FROM categories";
        $query = $this->getConnection()->prepare($sql);
        if (! $query->execute())
            return false;
        return $query->rowCount() ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function addCategory($name) {

        $sql = "INSERT INTO categories (name) values (?)";
        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $name, PDO::PARAM_STR);
        if(! $query->execute())
            return false;
        return $this->getconnection()->lastInsertId();

    }

}