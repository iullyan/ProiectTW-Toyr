<?php
require ROOT . 'Model/Db.php';
require ROOT . 'Config/config.php';
class Product extends Db
{

    public function getAllProducts()
    {
        $sql = "SELECT name from categories";
        $query = $this->getconnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}