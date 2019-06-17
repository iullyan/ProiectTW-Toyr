<?php

require_once 'Model.php';

class QueryProductBuilder extends Model
{

    /*
     * Filter can be: discount, nrSold, priceAsc, priceDesc, new, promotion
     */

    public function getProductsOrdedBy($orderBy, $offset, $recordsPerPage)
    {
        $sqlProductData = "SELECT p.id,
         p.name, 
         p.description,
          p.price, 
          p.category_id,
           p.nr_sold, p.image,
            p.units_in_stock, 
            p.created_at, p.updated_at";
        switch ($orderBy) {
            case 'discount' :
               $sql = $sqlProductData . ' ' . "FROM products p JOIN discounts d ON d.product_id = p.id 
                        ORDER BY discount_percentage DESC LIMIT ?, ?";
               $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                break;
            case 'nrSold' :
                $sql = $sqlProductData . ' ' . "FROM products p ORDER BY p.nr_sold DESC LIMIT ?, ?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                break;
            case 'priceAsc' :
                $sql = $sqlProductData . ' ' . "FROM products p ORDER BY price LIMIT ?, ?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                break;
            case 'priceDesc' :
                $sql = $sqlProductData . ' ' . "FROM products p ORDER BY price DESC LIMIT ?, ?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                break;
            case 'new' :
                $sql = $sqlProductData . ' ' . "FROM products p ORDER BY created_at DESC LIMIT ?, ?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);
                break;
            case 'promotion' :
                $sql = "SELECT * from products p where p.id in (SELECT product_bought_id FROM promotions) LIMIT ?, ?";
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(1, $offset, PDO::PARAM_INT);
                $query->bindParam(2, $recordsPerPage, PDO::PARAM_INT);

                break;
            default :
                $databaseField = 'unknown';
                break;
        }
        if (!strcmp($databaseField, 'unknown'))
            return false;
        return $query;
    }


    public function getProductById($productId)
    {
        $sql = "SELECT * FROM products WHERE id = ? LIMIT 1";
        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $productId, PDO::PARAM_STR);

        return $query;

    }

    public function getProductsByCategoryId($categoryId, $offset, $recordsPerPage)
    {

        $sql = "SELECT * FROM products p WHERE p.category_id = ?
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
                ORDER BY p.created_at DESC, p.nr_sold DESC LIMIT ?, ?";

        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $eventId, PDO::PARAM_INT);
        $query->bindParam(2, $offset, PDO::PARAM_INT);
        $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);

        return $query;
    }

    public function getProductsByMinimumAge($ageLowerBound, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM products WHERE age_lower_bound >= ?
                ORDER BY created_at DESC, nr_sold LIMIT ?, ?";

        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $ageLowerBound, PDO::PARAM_INT);
        $query->bindParam(2, $offset, PDO::PARAM_INT);
        $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);

        return $query;
    }

    public function getProductsByPriceInterval($priceLowerBound, $priceUpperBound, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM products WHERE price >= ? AND price <= ?
                ORDER BY created_at DESC, nr_sold LIMIT ?, ?";

        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $priceLowerBound, PDO::PARAM_INT);
        $query->bindParam(2, $priceUpperBound, PDO::PARAM_INT);
        $query->bindParam(3, $offset, PDO::PARAM_INT);
        $query->bindParam(4, $recordsPerPage, PDO::PARAM_INT);

        return $query;
    }


    public function getProductsWithPriceLowerThan($priceUpperBound, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM products WHERE price <= ?
                ORDER BY created_at DESC, nr_sold LIMIT ?, ?";

        $query = $this->getConnection()->prepare($sql);
        $query->bindParam(1, $priceUpperBound, PDO::PARAM_INT);
        $query->bindParam(2, $offset, PDO::PARAM_INT);
        $query->bindParam(3, $recordsPerPage, PDO::PARAM_INT);

        return $query;
    }

}