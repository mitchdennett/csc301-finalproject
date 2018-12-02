<?php 

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Query records that have usernames and passwords that match those in the customers table

    $finalSql = "";
    $params = array();

    $i = 0;
    foreach ($_POST['item'] as $value) {
        // Execute statement:
        // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
        $itemid = str_replace('item=', '', $value);
        $sql = ('update gallery_items set sortvalue = '.$i.' where itemid = '.$itemid.';');
        $statement = $database->prepare($sql);
        $statement->execute();
        $i++;
    }
}

?>