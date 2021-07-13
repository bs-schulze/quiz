<?php
require_once "includer.php";

// echo $_GET["action"];

if($_GET["action"] == 'new') {

    // $_POST["name"];
    $user = $userStore->findOneBy(
        [
            ['name', '=', strval($_POST["name"])]

        ]
        
    );
    if(!$user) {
        $user = [
            'name' => $_POST["name"],
            'score' => 0,
            'count' =>0
        ];
    }
    $result = $userStore->updateOrInsert($user);
    // var_dump($result);
    echo json_encode($result);
}