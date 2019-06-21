<?php

require_once 'Model.php';

class QueryProductBuilder extends Model
{

    /*
     * Filter can be: discount, nrSold, priceAsc, priceDesc, new, promotion
     */

    public function getProductsOrdedBy($orderBy, $offset, $recordsPerPage, $categoryId )
    {
        $sqlProductData = "SELECT DISTINCT p.id,
         p.name, 
         p.description,
          p.price, 
          p.category_id,
           p.nr_sold, p.image,
            p.units_in_stock, 
            p.created_at, p.updated_at, p.age_lower_bound ";
        switch ($orderBy) {

            case 'discount' :
                if (isset($categoryId)) {
                    $sql = $sqlProductData . ' ' . "FROM products p LEFT OUTER JOIN discounts d  on d.product_id = p.id  where p.category_id = ?
                        ORDER BY discount_percentage DESC LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $offset, PDO::PARAM_INT);
                    $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
                }
                else{
                    $sql = $sqlProductData . ' ' . "FROM products p JOIN discounts d ON d.product_id = p.id 
                        ORDER BY discount_percentage DESC LIMIT ?, ?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $offset, PDO::PARAM_INT);
                    $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                }
                break;
            case 'nrSold' :
                if (isset($categoryId)) {
                    $sql = $sqlProductData . ' ' . " FROM products p WHERE p.category_id = ? ORDER BY p.nr_sold DESC LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $offset, PDO::PARAM_INT);
                    $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
                }else{
                    $sql = $sqlProductData . ' ' . " FROM products p  ORDER BY p.nr_sold DESC LIMIT ?, ?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $offset, PDO::PARAM_INT);
                    $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                }
                break;
            case 'priceAsc' :
                if (isset($categoryId)) {
                    $sql = $sqlProductData . ' ' . "FROM products p WHERE  p.category_id = ? ORDER BY price LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $offset, PDO::PARAM_INT);
                    $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
                }else{
                    $sql = $sqlProductData . ' ' . "FROM products p WHERE p.id > ? ORDER BY price LIMIT ?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $offset, PDO::PARAM_INT);
                    $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);

                }
                break;
            case 'priceDesc' :
                if (isset($categoryId)) {
                    $sql = $sqlProductData . ' ' . "FROM products p WHERE  p.category_id = ? ORDER BY price DESC LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $offset, PDO::PARAM_INT);
                    $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
                }else{
                    $sql = $sqlProductData . ' ' . "FROM products p WHERE  ORDER BY price DESC LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $offset, PDO::PARAM_INT);
                    $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                }
                break;
            case 'new' :
                if (isset($categoryId)) {
                    $sql = $sqlProductData . ' ' . " FROM products p  WHERE p.category_id = ? ORDER BY created_at DESC LIMIT ?, ?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $offset, PDO::PARAM_INT);
                    $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
                }
                else{
                    $sql = $sqlProductData . ' ' . "FROM products p ORDER BY created_at DESC LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $offset, PDO::PARAM_INT);
                    $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                }
                break;
            case 'promotion' :
                if (isset($categoryId)) {
                    $sql = $sqlProductData . " from products p JOIN  promotions p2 on p.id = p2.product_bought_id where p.category_id = ? LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $offset, PDO::PARAM_INT);
                    $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
                }else{
                    $sql = "SELECT * from products p where  p.id  in (SELECT product_bought_id FROM promotions) LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $offset, PDO::PARAM_INT);
                    $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                }

                break;
            default :
                return false;

        }
        
        return $query;
    }


    public function getProductById($productId)
    {
        $sql = "SELECT * FROM products WHERE id = ? LIMIT 1";
        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $productId, PDO::PARAM_STR);

        return $query;

    }



    public function getProductsByCategoryId($offset, $recordsPerPage, $categoryId)
    {
        $sql = "SELECT   p.name, p.id,
         p.description,
          p.price, 
          p.category_id,
           p.nr_sold, p.image,
            p.units_in_stock, 
            p.created_at, p.updated_at, p.age_lower_bound 
             FROM products p WHERE  p.category_id = ?
                ORDER BY p.created_at DESC, p.nr_sold DESC LIMIT ?, ?";
        $query = $this->getConnection()->prepare($sql);

        $query->bindParam(1, $categoryId, PDO::PARAM_INT);
        $query->bindParam(2, $offset, PDO::PARAM_INT);
        $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
        return $query;
    }



    public function getProductsByEventId($eventId, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM products p JOIN products_events pe on p.id = pe.product_id AND pe.event_id = ? 
                ORDER BY p.created_at DESC, p.nr_sold DESC LIMIT ?,?";

        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $eventId, PDO::PARAM_INT);
        $query->bindParam(2, $offset, PDO::PARAM_INT);
        $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);

        return $query;
    }

    public function getProductsByMinimumAge($ageLowerBound, $offset, $recordsPerPage, $categoryId)
    {

        $sql = "SELECT * FROM products WHERE ? >= age_lower_bound";
        if (isset($categoryId)){
            $sql .= " and category_id = ? ORDER BY created_at DESC, nr_sold LIMIT ?,?";
            $query = $this->getConnection()->prepare($sql);

            $query->bindParam(1, $ageLowerBound, PDO::PARAM_INT);
            $query->bindParam(2, $categoryId, PDO::PARAM_INT);
            $query->bindParam(3, $offset, PDO::PARAM_INT);
            $query->bindParam(4, $recordsPerPage, PDO::PARAM_INT);
        }
            else {
                $sql = $sql . " ORDER BY created_at DESC, nr_sold LIMIT ?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $ageLowerBound, PDO::PARAM_INT);
                $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
            }

        return $query;
    }

    public function getProductsByPriceInterval($priceLowerBound, $priceUpperBound, $offset, $recordsPerPage, $categoryId)
    {

        $sql = "SELECT * FROM products WHERE";


        if (isset($categoryId)) {
            if (isset($priceUpperBound) && isset($priceLowerBound)) {
                $sql .= " category_id = ? and price >= ? AND price <= ?  ORDER BY created_at DESC, nr_sold LIMIT ?,?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                $query->bindParam(2, $priceLowerBound, PDO::PARAM_INT);
                $query->bindParam(3, $priceUpperBound, PDO::PARAM_INT);
                $query->bindParam(4, $offset, PDO::PARAM_INT);
                $query->bindParam(5, $recordsPerPage, PDO::PARAM_INT);
            }
            elseif(isset($priceUpperBound)){
                    $sql .= " category_id = ? and price <= ?  ORDER BY created_at DESC, nr_sold LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $priceUpperBound, PDO::PARAM_INT);
                    $query->bindParam(3, $offset, PDO::PARAM_INT);
                    $query->bindParam(4, $recordsPerPage, PDO::PARAM_INT);
                }
                elseif (isset($priceLowerBound)){
                    $sql .= " category_id = ? and price >= ?  ORDER BY created_at DESC, nr_sold LIMIT ?,?";
                    $query = $this->getConnection()->prepare($sql);
                    $query->bindParam(1, $categoryId, PDO::PARAM_INT);
                    $query->bindParam(2, $priceLowerBound, PDO::PARAM_INT);
                    $query->bindParam(3, $offset, PDO::PARAM_INT);
                    $query->bindParam(4, $recordsPerPage, PDO::PARAM_INT);
                }
        }
        else
        {
            $sql .= "  price >= ? AND price <= ?  ORDER BY created_at DESC, nr_sold LIMIT ?,?";
            $query = $this->getConnection()->prepare($sql);

            $query->bindParam(1, $priceLowerBound, PDO::PARAM_INT);
            $query->bindParam(2, $priceUpperBound, PDO::PARAM_INT);
            $query->bindParam(3, $offset, PDO::PARAM_INT);
            $query->bindParam(4, $recordsPerPage, PDO::PARAM_INT);
        }

        return $query;
    }


    public function getProductsWithPriceLowerThan($priceUpperBound, $offset, $recordsPerPage, $categoryId)
    {

        $sql = "SELECT * FROM products WHERE ";
        if (isset($categoryId)){
            $sql .= " category_id = ? and  price <= ? ORDER BY created_at DESC, nr_sold LIMIT ?,?";
            $query = $this->getConnection()->prepare($sql);

            $query->bindParam(1, $categoryId, PDO::PARAM_INT);
            $query->bindParam(2, $priceUpperBound, PDO::PARAM_INT);
            $query->bindParam(3, $offset, PDO::PARAM_INT);
            $query->bindParam(4, $recordsPerPage, PDO::PARAM_INT);

    }else{
            $sql .= " price <= ? ORDER BY created_at DESC, nr_sold LIMIT ?,?";
            $query = $this->getConnection()->prepare($sql);

            $query->bindParam(1, $priceUpperBound, PDO::PARAM_INT);
            $query->bindParam(2, $offset, PDO::PARAM_INT);
            $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);
        }

        return $query;
    }



}