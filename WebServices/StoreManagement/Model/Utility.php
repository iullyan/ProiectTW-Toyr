<?php


class Utility
{
    public static function processProductRow ($row) {


        $product_item = array(
            "id" => $row['id'],
            "name" => html_entity_decode($row['name']),
            "description" => html_entity_decode($row['description']),
            "price" => $row['price'],
            "category_d" => $row['category_id'],
            "nr_sold" => $row['nr_sold'],
            "image" => $row['image'],
            "units_in_tock" => $row['units_in_stock'],
            "created_at" => $row['created_at'],
            "updated_at" => $row['updated_at']
        );
        return $product_item;

    }

}