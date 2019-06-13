<?php
require_once 'Model.php';

class ProductModel extends Model
{

    public function getProductsByCategory($categoryId)
    {
        $sql = "SELECT p.id, 
       p.name, p.nr_sold, 
       p.description, 
       p.image, p.price,
       p.units_in_stock,
       p.created_at,
       p.updated_at
       
            FROM products p JOIN categories c on p.category_id = c.id AND c.id = :categoryId
                ORDER BY p.nr_sold DESC";

        $query = $this->getconnection()->prepare(sql);
        $parameters = array(':categoryId' => $categoryId);
        $query->execute($parameters);
        if ($query->rowCount())
        {
            $result =  $query->fetch(PDO::FETCH_ASSOC);
            array_push($result, $query->rowCount);
            return $result;
        }
        else
            return false;
    }

    public function getProduct($productId)
    {
        $sql = "SELECT id, 
       name, nr_sold, 
       description, 
       image, price,
       units_in_stock,
       created_at
            FROM products  WHERE id =  :productId";

        $query = $this->getconnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);
    }

    public function addProduct($name, $categoryId, $description, $image, $price, $unitsInStock)
    {

        $sql = "INSERT INTO products (category_id, name, description, image, price, units_in_stock) 
            values(:categoryId, :productName , :productDescription, :image, :price, :unitsInStock)";
        $parameters = array(
            ':categoryId' => $categoryId,
            ':productName' => $name,
            ':productDescription' => $description,
            ':image' => $image,
            ':price' => $price,
            ':unitsInStock' => $unitsInStock);
        $query = $this->getconnection()->prepare($sql);
        $query->execute($parameters);
        return $this->getconnection()->lastInsertedId();
    }


    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE id = :productId";
        $parameters = array(':productId' => $productId);
        $query = $this->getconnection()->prepare($sql);
        $query->execute($parameters);
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


        $query = $this->getconnection()->prepare($sql);
        $parameters = array(
            ':productName' => $newName,
            ':categoryId' => $newCategoryId,
            ':productDescription' => $newDescription,
            ':image' => $newImage,
            ':price' => $newPrice,
            ':unitsInStock' => $newUnitsInStock,
            ':productId' => $productId
        );
        $query->execute($parameters);
    }

    public function getNrOfProducts()
    {

        $sql = "SELECT COUNT(id) AS count FROM products";
        $query = $this->getconnection()->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['count'];
    }

    private function getProductPrice($productId)
    {
        $sql = "SELECT price FROM products WHERE id = :productId";
        $query = $this->getconnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);

    }

    public function addProductDiscount($productId, $discountPercentage, $validFrom, $validUntil)
    {
        $priceWithDiscount = $this->getProductPrice($productId);
        $sql = "INSERT INTO discounts (product_id, discount_percentage, price_with_discount, valid_from, valid_until) 
            values (:productId, :discountPercentage, :priceWithDiscount, :validFrom, :validUntil)";
        $query = $this->getconnection()->prepare($sql);
        $parameters = array(
            ':productId' => $productId,
            ':discountPercentage' => $discountPercentage,
            ':priceWithDiscount' => $priceWithDiscount,
            ':validFrom' => $validFrom,
            ':validUntil' => $validUntil
        );
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();

    }

    public function addPromotion($boughtProductId, $giftedProductId, $productUnitsBought, $giftQuantity, $totalDiscount, $validFrom, $validUntil)
    {
        $sql = "INSERT INTO promotions (product_buyed_id, 
                        gifted_product_id, 
                        product_units_bought, 
                        gifted_product_quantity, 
                        total_discount, 
                        valid_from, 
                        valid_until)
            values (:boughtProductId, 
                    :giftedProductId, 
                    :productUnitsBought, 
                    :giftQuantity,
                    :totalDiscount, 
                    :validFrom, 
                    :validUntil)";

        $query = $this->getconnection()->prepare($sql);
        $parameters = array(
            ':boughtProductId' => $boughtProductId,
            ':giftedProductId' => $giftedProductId,
            ':productUnitsBought' => $productUnitsBought,
            ':giftQuantity' => $giftQuantity,
            ':totalDiscount' => $totalDiscount,
            ':validFrom' => $validFrom,
            ':validUntil' => $validUntil
        );
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();

    }

    public function getProductDiscount($productId)
    {
        $sql = "SELECT * FROM discounts WHERE product_id = :productId";
        $query = $this->getconnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);

    }

    public function getProductPromotion($productId)
    {
        $sql = "SELECT * FROM promotions WHERE product_buyed_id = :productId";
        $query = $this->getconnection()->prepare($sql);
        $parameters = array(':productId' => $productId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);
    }

    public function addSpecialEvent($name, $startingDate, $endintDate)
    {
        $sql = "INSERT INTO special_event (name, starting_date, ending_date) 
                    values (:eventName, :starting_date, :ending_date )";

        $query = $this->getconnection()>prepare($sql);
        $parameters = array(':eventName' => $name,
            ':starting_date' => $startingDate,
            ':ending_date' => $endintDate);
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();
    }

    public function addProductToSpecialEvent($productId, $eventId)
    {
        $sql = "INSERT INTO products_events (product_id, event_id)
                    values (:productId, :eventId)";

        $query = $this->getconnection()>prepare($sql);
        $parameters = array(':productId' => $productId, ':eventId' => $eventId);
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();

    }

    public function getProductsByEvent($specilEventId)
    {
        $sql = "SELECT p.id, 
       p.name, p.nr_sold, 
       p.description, 
       p.image, p.price,
       p.units_in_stock,
       p.created_at,
       p.updated_at,
       d.discount_percentage,
       d.price_with_discount,
       se.name,
       se.starting_date,
       se.ending_date

            FROM products p JOIN products_events pe on p.id = pe.product_id
                            JOIN special_event se on pe.event_id = se.id
                            JOIN discounts d on p.id = d.product_id
            WHERE se.id = :specialEventId";

        $query = $this->getconnection()->prepare(sql);
        $parameters = array(':specialEventId' => $specilEventId);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch(PDO::FETCH_ASSOC) : false);
    }



}