
<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
require_once '../Utils/ImageUploader.php';


$operationMessage = "";
$imageUploader = new ImageUploader();
if(
    !empty($_POST['name']) &&
    !empty($_POST['price']) &&
    !empty($_POST['description']) &&
    !empty($_POST['categoryId']) &&
    !empty($_FILES['image']) &&
    !empty($_POST['unitsInStock'])
)
{
    $name = htmlentities($_POST['name']);
    $price = htmlentities($_POST['price']);
    $description = htmlentities($_POST['description']);
    $categoryId = htmlentities($_POST['categoryId']);
    $imageName = htmlentities($_FILES['image']['name']);
    $unitsInStock = htmlentities($_POST['unitsInStock']);
    $minimumAge = htmlentities($_POST['minimumAge']);

    if ($message = $imageUploader->upload($_FILES['image'], PRODUCT_IMAGES_UPLOAD) === true) {
        //Build the Json object

        $object =  new stdClass();
        $object->name = $name;
        $object->price = $price;
        $object->description = $description;
        $object->categoryId = $categoryId;
        $object->image = $imageName;
        $object->unitsInStock = $unitsInStock;
        $object->minimumAge = $minimumAge;

        $JSONData = json_encode($object);

        $webService = new CallWebService();
        $url = WEB_CONST_URL_PART . 'Product/addProduct.php';
        $response = $webService->doPost($url, $JSONData);

        $operationMessage = $response->Message;
    }else
        $errMessage = "There is a problem with your uploaded file";
}
else
    $operationMessage = "Unable to create product. Input data is incomplete";
     echo '<p style="text-align:center;font-size: 25px;" class="centered">Mesajul operației: ' . $operationMessage . ' </p>';






