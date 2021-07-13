<?php
require_once "includer.php";



if($_GET["action"] == 'save') {

    $question = $questionStore->findById($_POST['question']);

    // var_dump($question);
    // die();
    if(!$question['finished']) {

        $result = $answerStore->findOneBy(
            [
                ['user', '=', $_POST['user']] , 'AND',  ['question', '=', $_POST['question']]
    
            ]
            
        );
        // var_dump($result);
        // die();
        if($result) {
            $result['answer'] = $_POST['answer'];
            $answer = $result;
        } else {
            $answer = [
                'user' => $_POST['user'],
                'question' => $_POST['question'],
                'answer' => $_POST['answer']
            ];
        }
        
        echo json_encode($answerStore->updateOrInsert($answer));
    }
}