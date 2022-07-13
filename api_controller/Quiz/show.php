<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/question.php');

    $db = new db();

    $connect = $db->connect();

    $question = new Question($connect);

    $question->id_quiz = isset($_GET['id']) ? $_GET['id'] : die();
    
    $question->show();

    $question_item = array(
        'id_quiz' => $question->id_quiz,
        'title'   => $question->title,
        'quest_a' => $question->quest_a,
        'quest_b' => $question->quest_b,
        'quest_c' => $question->quest_c,
        'quest_d' => $question->quest_d,
        'correct_ans' => $question->correct_ans
    );
print_r(json_encode($question_item));
?>