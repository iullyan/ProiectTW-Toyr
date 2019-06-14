<?php


class SpecialOffers
{
    public function addPromotion($boughtProductId, $giftedProductId, $productUnitsBought, $giftQuantity, $validFrom, $validUntil)
    {
        $sql = "INSERT INTO promotions (product_bought_id, 
                        gifted_product_id, 
                        product_units_bought, 
                        gifted_product_quantity, 
                        valid_from, 
                        valid_until)
            values (:boughtProductId, 
                    :giftedProductId, 
                    :productUnitsBought, 
                    :giftQuantity,
                    :validFrom, 
                    :validUntil)";

        $query = $this->getconnection()->prepare($sql);
        $parameters = array(
            ':boughtProductId' => $boughtProductId,
            ':giftedProductId' => $giftedProductId,
            ':productUnitsBought' => $productUnitsBought,
            ':giftQuantity' => $giftQuantity,
            ':validFrom' => $validFrom,
            ':validUntil' => $validUntil
        );
        $query->execute($parameters);
        return $this->getconnection()->lastInsertId();

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
}