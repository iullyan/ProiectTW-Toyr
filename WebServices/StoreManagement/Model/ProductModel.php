<?php
require_once 'Model.php';
require_once 'Utility.php';
require_once 'QueryProductBuilder.php';


class ProductModel extends Model
{

    public function getProducts($filterVariable, $orderBy, $offset, $limit, $categoryId)
    {
        $queryBuilder = new QueryProductBuilder();
        if (!empty($orderBy)) {
            $query = $queryBuilder->getProductsOrdedBy($orderBy, $offset, $limit, $categoryId);

        } elseif (!empty($filterVariable)) {
            if (is_array($filterVariable)) {
                if (array_key_exists('eventId', $filterVariable))
                    $query = $queryBuilder->getProductsByEventId($filterVariable['eventId'], $offset, $limit);
                elseif (array_key_exists('ageLowerBound', $filterVariable))
                    $query = $queryBuilder->getProductsByMinimumAge($filterVariable['ageLowerBound'], $offset, $limit, $categoryId);
                elseif (array_key_exists('priceLowerThan', $filterVariable))
                    $query = $queryBuilder->getProductsWithPriceLowerThan($filterVariable['priceLowerThan'], $offset, $limit, $categoryId);
                elseif (array_key_exists('priceLowerBound', $filterVariable) && array_key_exists('priceUpperBound', $filterVariable))
                    $query = $queryBuilder->getProductsByPriceInterval($filterVariable['priceLowerBound'], $filterVariable['priceUpperBound'], $offset, $limit, $categoryId);
                elseif (array_key_exists('priceLowerBound', $filterVariable))
                    $query = $queryBuilder->getProductsByPriceInterval($filterVariable['priceLowerBound'], NULL, $offset, $limit, $categoryId);
                elseif (array_key_exists('priceUpperBound', $filterVariable))
                    $query = $queryBuilder->getProductsByPriceInterval(NULL, $filterVariable['priceUpperBound'], $offset, $limit, $categoryId);

            } else
                return false;
        } elseif (!empty($categoryId))
            $query = $queryBuilder->getProductsByCategoryId($offset, $limit, $categoryId);
        else
            return false;
        if (!$query->execute())
            return false;

        if (!$query->rowCount())
            return false;

        $result['records'] = array();


        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $product_item = Utility::processProductRow($row);
            array_push($result['records'], $this->gatherProductDiscountAndPromotions($row['id'], $product_item));


        }
        $result['count'] = $query->rowCount();
        return $result;
    }

    public function getProduct($productId)
    {
        $queryBuilder = new QueryProductBuilder();
        $query = $queryBuilder->getProductById($productId);

        if (!$query->execute())
            return false;
        if (!$query->rowCount())
            return false;

        $productItem = Utility::processProductRow($query->fetch(PDO::FETCH_ASSOC));
        $result['record'] = $this->gatherProductDiscountAndPromotions($productId, $productItem);

        return $result;
    }


    private function gatherProductDiscountAndPromotions($productId, $productInformationArray)
    {

        $result['product'] = array();
        $result['discount'] = array();
        $result['promotions'] = array();

        $result['product'] = $productInformationArray;
        $result['discount'] = $this->getProductDiscount($productId);
        $result['promotions'] = $this->getProductPromotions($productId);

        return $result;


    }

    public function getProductDiscount($productId)
    {
        $sql = "SELECT * FROM discounts WHERE product_id = :productId AND current_timestamp between valid_from and valid_until";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);

    }

    function getProductPromotions($productId)
    {
        $sql = "SELECT * FROM promotions WHERE product_bought_id = :productId AND current_timestamp between valid_from and valid_until";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetchAll(PDO::FETCH_ASSOC) : false);
    }


    public function addProduct($name, $categoryId, $description, $image, $price, $unitsInStock, $minimumAge)
    {

        $sql = "INSERT INTO products (category_id, name, description, image, price, units_in_stock, age_lower_bound) 
            values(:categoryId, :productName , :productDescription, :image, :price, :unitsInStock, :minimumAge)";
        $parameters = array(
            ':categoryId' => $categoryId,
            ':productName' => $name,
            ':productDescription' => $description,
            ':image' => $image,
            ':price' => $price,
            ':unitsInStock' => $unitsInStock,
            ':minimumAge' => $minimumAge);
        $query = $this->getConnection()->prepare($sql);
        return ($query->execute($parameters) ? true : false);


    }


    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE id = :productId";
        $parameters = array(':productId' => $productId);
        $query = $this->getConnection()->prepare($sql);
        if (!$query->execute($parameters))
            return false;
        return true;
    }

    public function updateProduct($productId, $newName, $newCategoryId, $newDescription, $newImage, $newPrice, $newUnitsInStock)
    {
        $sql = "UPDATE products 
            SET name = :productName,
                category_id = :categoryID, 
                description = :productDescription,
                image = :image,
                price = :price,
                units_in_stock = :unitsInStock,
                updated_at = now()
            WHERE id = :productId";


        $query = $this->getConnection()->prepare($sql);
        $parameters = array(
            ':productName' => $newName,
            ':categoryId' => $newCategoryId,
            ':productDescription' => $newDescription,
            ':image' => $newImage,
            ':price' => $newPrice,
            ':unitsInStock' => $newUnitsInStock,
            ':productId' => $productId
        );
        if (!$query->execute($parameters))
            return false;
        return false;
    }

    public function getNrOfProducts()
    {

        $sql = "SELECT COUNT(id) AS count FROM products";
        $query = $this->getConnection()->prepare($sql);
        if (!$query->execute())
            return false;
        return $query->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function getProductPrice($productId)
    {
        $sql = "SELECT price FROM products WHERE id = :productId";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC)['price'] : false);

    }


}