<?php
require_once 'Model.php';

class Counter extends Model
{
    public function countByCategoryId($categoryId){
        $sql = "SELECT count(id) as count FROM products WHERE category_id = ?";
        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $categoryId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function countAllProducts()
    {
        $sql = "SELECT count(id) FROM products";
        $query = $this->getConnection()->prepare($sql);
        return $query->execute() ? true : false;
    }


    public function getProductsNr($filterVariable, $orderBy, $lastId, $limit, $categoryId)
    {
        $count = $limit;
        if (!empty($categoryId)) {

            $count = $this->countByCategoryId($categoryId);
        }else
            $count = $this->countAllProducts();

        return json_encode(array("Message" => $count));
    }
}

