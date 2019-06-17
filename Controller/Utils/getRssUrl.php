<?php require_once '../../Config/config.php';
if (isset($_GET['type']))
switch ($_GET['type']){
    case 'new' : echo json_encode(NEWEST_PRODUCTS); break;
    case 'promotion' : echo json_encode(SPECIAL_OFFERS); break;
    case 'sold' : echo json_encode(MOST_SOLD_PRODUCTS); break;
}
else
    echo json_encode('unknown');

?>
