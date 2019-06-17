<?php
require_once ('../../Config/config.php');
class ProductsXML
{

    const XML_VERSION = "1.0";
    const XML_ENCODING = "UTF-8";
    const RSS_VERSION = "2.0";
    const LINK = "";
    const TITLE = "Newest toys";
    const DESCRIPTION = "Get the latest toys";
    const LANGUAGE = "ro";

    public function getXml($jsonProductList){
        return  $this->createXml($jsonProductList);
    }

    public function createLink($productId){
        return PRODUCT_PAGE . '?productId=' . $productId;
    }

    public function createXml($jsonProductList)
    {
        $xml = new DomDocument(self::XML_VERSION, self::XML_ENCODING);
        $xml->formatOutput = true;
        $rss = $xml->createElement("rss");
        $xml->appendChild($rss);
        $link = $xml->createElement("link", self::LINK);
        $rss->appendChild($link);

        $title = $xml->createElement("title", self::TITLE);
        $rss->appendChild($title);

        $description = $xml->createElement("description", self::DESCRIPTION);
        $rss->appendChild($description);

        $language = $xml->createElement("language", self::LANGUAGE);
        $rss->appendChild($language);


        if (! isset($jsonProductList->Message)) {
            $records = $jsonProductList->records;
            foreach ($records as $product) {
                $discountData = $product->discount;
                $promotionsList = $product->promotions;

                $item = $xml->createElement("item");
                $id = $xml->createElement("id", $product->product->id);
                $item->appendChild($id);

                $name = $xml->createElement("name");
                $nameCDATA = $xml->createCDATASection($product->product->name);
                $name->appendChild($nameCDATA);
                $item->appendChild($name);

                $description = $xml->createElement("description");
                $descriptionCDATA = $xml->createCDATASection($product->product->description);
                $description->appendChild($descriptionCDATA);
                $item->appendChild($description);


                $price = $xml->createElement("price", $product->product->price);
                $item->appendChild($price);


                $categoryId = $xml->createElement("categoryId", $product->product->category_id);
                $item->appendChild($categoryId);

                $nrSold = $xml->createElement("nrSold", $product->product->nr_sold);
                $item->appendChild($nrSold);

                $image = $xml->createElement("image");
                $imageCDATA = $xml->createCDATASection($product->product->image);
                $image->appendChild($imageCDATA);
                $item->appendChild($image);


                $unitsInStock = $xml->createElement("unitsInStock", $product->product->units_in_stock);
                $item->appendChild($unitsInStock);


                $link = $xml->createElement("link");
                $linkCDATA = $xml->createCDATASection($this->createLink($product->product->id));
                $link->appendChild($linkCDATA);
                $item->appendChild($link);

                $createdAt = $xml->createElement("created_at");
                $createdAtCDATA = $xml->createCDATASection($product->product->created_at);
                $createdAt->appendChild($createdAtCDATA);
                $item->appendChild($createdAt);


                if ($discountData) {

                    $discount = $xml->createElement("discount");
                    $discountPercentage = $xml->createElement("discountPercentage");
                    $discountPercentageCDATA = $xml->createCDATASection($discountData->discount_percentage);
                    $discountPercentage->appendChild($discountPercentageCDATA);
                    $discount->appendChild($discountPercentage);

                    $priceWithDiscount = $xml->createElement("priceWithDiscount");
                    $priceWithDiscountCDATA = $xml->createCDATASection($discountData->price_with_discount);
                    $priceWithDiscount->appendChild($priceWithDiscountCDATA);
                    $discount->appendChild($priceWithDiscount);
                    $item->appendChild($discount);
                } else {
                    $discount = $xml->createElement("discount", "false");
                    $item->appendChild($discount);

                }

                if ($promotionsList) {
                    $promotions = $xml->createElement("promotions");
                    foreach ($promotionsList as $promotionData) {
                        $promotion = $xml->createElement("promotion");
                        $giftedProductId = $xml->createElement("giftedProductid", $promotionData->gifted_product_id);
                        $promotion->appendChild($giftedProductId);

                        $productUnitsBought = $xml->createElement("productUnitsBought", $promotionData->gifted_product_quantity);
                        $promotion->appendChild($productUnitsBought);

                        $giftedProductQuantity = $xml->createElement("giftedProductQuantity", $promotionData->gifted_product_quantity);
                        $promotion->appendChild($giftedProductQuantity);

                        $validFrom = $xml->createElement("validFrom", $promotionData->valid_from);
                        $promotion->appendChild($validFrom);

                        $validUntil = $xml->createElement("validUntil", $promotionData->valid_until);
                        $promotion->appendChild($validUntil);


                        $promotions->appendChild($promotion);
                    }
                    $item->appendChild($promotions);
                } else {
                    $promotions = $xml->createElement("promotions", "false");
                    $item->appendChild($promotions);
                }

                $rss->appendChild($item);


            }
        }
            return $xml;

    }



}

