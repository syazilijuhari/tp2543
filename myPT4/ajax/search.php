<?php
header("Content-Type: application/json;Charset=UTF-8");
require '../database.php';

$Json = array();

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $data = explode(" ", $search);
    $field = ['fld_product_name', 'fld_product_region' , 'fld_product_era'];

    $name = (isset($data[0]) ? $data[0] : '');
    $region = (isset($data[1]) ? $data[1] : '');
    $era = (isset($data[2]) ? $data[2] : '');

    try {
        //search each 3 keywords or search 3 keyword at once
        if(count($data)==1){
            $stmt = $db->prepare("SELECT * FROM `tbl_products_a173630_pt2` WHERE {$field[0]} LIKE ? OR {$field[1]} LIKE ? OR {$field[2]} LIKE ?");
            $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
        }

       elseif(count($data)==3){
            $stmt = $db->prepare("SELECT * FROM `tbl_products_a173630_pt2` WHERE {$field[0]} LIKE ? AND {$field[1]} LIKE ? AND {$field[2]} LIKE ?");
            $stmt->execute(["%{$name}%","%{$region}%", "%{$era}%"]);
        }

        //search any keywords from 3 attributes
        // $queries = array();
        // foreach($data as $dat){
        //     $queries[] = "SELECT * FROM `tbl_products_a173630_pt2` WHERE {$field[0]} LIKE '%{$dat}%' OR {$field[1]} LIKE '%{$dat}%' OR {$field[2]} LIKE '%{$dat}%'";
        // }
        // $sql = implode(' UNION ',$queries);
        // $stmt = $db->prepare($sql);
        
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Json = array('status' => 200, 'data' => $res);

    } catch (PDOException $e) {
        $Json = array('status' => 400, 'data' => $e->getMessage());
    }

}

if (isset($Json))
    echo json_encode($Json);