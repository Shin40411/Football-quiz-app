<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/question.php');

    $db = new db();

    $connect = $db->connect();

    $question = new Question($connect);

    $read = $question->read();

    $num = $read->rowCount();
    
    if($num > 0) {
        $question_array = [];
        $question_array['quest'] =  [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $question_item = array(
                'id_quiz' => $id_quiz,
                'title' => $title,
                'quest_a' => $quest_a,
                'quest_b' => $quest_b,
                'quest_c' => $quest_c,
                'quest_d' => $quest_d,
                'correct_ans' => $correct_ans
            );
            array_push($question_array['quest'],$question_item);
        }
        echo json_encode($question_array);
    }


?>