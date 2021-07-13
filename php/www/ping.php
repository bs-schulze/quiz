<?php

require_once "includer.php";
$user = ['name' => 'Robin'];

$answer = [
    'user' => 1,
    'question' => 1,
    'answer' => 'a'
];

// $answerStore->insert($answer);

// $userStore->insert($user);




//  $results = $questionStore->insert($question);

$questions = $questionStore->findAll(
    ["_id" => "desc"],
    1
);
$round = $questions[0]['_id'];
// var_dump($questions);
// die();
$users = $userStore->findAll(["name" => "asc"]);
$data  = '<table class="table table-striped">';
$thead ='<thead><tr><th>User </th><th>Score</th><th>Anz. Runden</th><th>Runde '.$round.' <br>Antwort: '. $questions[0]['correctAnswer'].'</th>';

$thead .='</tr></thead>';

foreach ($users as $user) {
    // echo $user['_id'];
    
    $result = $answerStore->findOneBy(
        [
            ['user', '=', strval($user['_id'])] , 'AND',  ['question', '=', strval($round)]

        ]
        
    );
    if($questions[0]['correctAnswer'] != 'x' && $result['answer']){
        $chosen = $result['answer'];
    } else if ($questions[0]['correctAnswer'] == 'x' && $result['answer']){
        $chosen = 'x';

    } else{
        $chosen = '';
    }
    if($questions[0]['correctAnswer'] != 'x') {

        if($questions[0]['correctAnswer'] == $result['answer']){
            $correct='table-success';
        } elseif(!$result['answer']){
            $correct='table-warning';
        } else {
            $correct='table-danger';
        }
    }
    // var_dump($result);
    // die();
    $tbody .='<tr class="'.$correct.'"><td>' . $user['name'] . '</td><td>'.$user['score'].'</td> <td>'.$user['count'].'  </td>';
    $tbody .='<td>'.$chosen. '</td>';
    $tbody .='</tr>';
}
$data .= $thead;
$data .= $tbody;
$data .='</table>';

// echo $data;

$arrData = [
    'html' => $data,
    'round' => $round
];

echo json_encode ($arrData);

// var_dump($users);
