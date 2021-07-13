<?php
require_once "includer.php";
$question = [
    'correctAnswer' => 'x',
    'finished' => false
];



if($_GET["action"] == 'new') {
    $questionStore->insert($question);
} else if($_GET["action"] == 'finish') {
    $last = $questionStore->findAll(
        ["_id" => "desc"],
        1
    )[0];
    if($last['finished'] != true) {

        $last['finished'] = true;
        $last['correctAnswer'] = $_GET['correctAnswer'];
        $questionStore->updateOrInsert($last);
    
    
        $answers = $answerStore->findBy(
            [
                ['question', '=', strval($last['_id'])]
    
            ]
            
        );
    
        // var_dump($last);
        // var_dump($answers);
        foreach( $answers as $answer) {
            // var_dump($answer);
            $user = $userStore->findById($answer['user']);
            $user['count']++;
            if($answer['answer'] == $last['correctAnswer']) {
                $user['score']++;
            }
            $userStore->updateOrInsert($user);
        }
    }
}

