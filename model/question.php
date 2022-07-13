<?php 
class Question {
    private $conn;

    //question properties
    public $id_quiz;
    public $title;
    public $quest_a;
    public $quest_b;
    public $quest_c;
    public $quest_d;
    public $correct_ans;

    //connect db
    public function __construct($db) {
        $this->conn = $db;
    }

    //read data
    public function read() {
        $query = "SELECT * FROM quiz ORDER BY id_quiz ASC";

        $statement = $this->conn->prepare($query);

        $statement->execute();
        
        return $statement;
    }

    //show data
    public function show() {
        $query = "SELECT * FROM quiz WHERE id_quiz=? LIMIT 1";

        $statement = $this->conn->prepare($query);

        $statement->bindParam(1, $this->id_quiz);

        $statement->execute();
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        $this->title       = $row['title'];
        $this->quest_a     = $row['quest_a'];
        $this->quest_b     = $row['quest_b'];
        $this->quest_c     = $row['quest_c'];
        $this->quest_d     = $row['quest_d'];
        $this->correct_ans = $row['correct_ans'];

    }
    //Create data
    public function create() {
        $query = "INSERT INTO quiz SET title=:title, quest_a=:quest_a, quest_b=:quest_b, quest_c=:quest_c, quest_d=:quest_d, correct_ans=:correct_ans";
        $statement = $this->conn->prepare($query);
        
        //clean data
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->quest_a     = htmlspecialchars(strip_tags($this->quest_a));
        $this->quest_b     = htmlspecialchars(strip_tags($this->quest_b));
        $this->quest_c     = htmlspecialchars(strip_tags($this->quest_c));
        $this->quest_d     = htmlspecialchars(strip_tags($this->quest_d));
        $this->correct_ans = htmlspecialchars(strip_tags($this->correct_ans));

        //bind data
        $statement->bindParam(':title',$this->title);
        $statement->bindParam(':quest_a',$this->quest_a);
        $statement->bindParam(':quest_b',$this->quest_b);
        $statement->bindParam(':quest_c',$this->quest_c);
        $statement->bindParam(':quest_d',$this->quest_d);
        $statement->bindParam(':correct_ans',$this->correct_ans);

        if ($statement->execute()){
            return true;
        }
        printf("Error %s.\n", $statement->error);
        return false;
    }

        //Update data
        public function update() {
            $query = "UPDATE quiz SET title=:title, quest_a=:quest_a, quest_b=:quest_b, quest_c=:quest_c, quest_d=:quest_d, correct_ans=:correct_ans WHERE id_quiz=:id_quiz ";
            $statement = $this->conn->prepare($query);
            
            //clean data
            $this->title       = htmlspecialchars(strip_tags($this->title));
            $this->quest_a     = htmlspecialchars(strip_tags($this->quest_a));
            $this->quest_b     = htmlspecialchars(strip_tags($this->quest_b));
            $this->quest_c     = htmlspecialchars(strip_tags($this->quest_c));
            $this->quest_d     = htmlspecialchars(strip_tags($this->quest_d));
            $this->correct_ans = htmlspecialchars(strip_tags($this->correct_ans));
            $this->id_quiz = htmlspecialchars(strip_tags($this->id_quiz));
    
            //bind data
            $statement->bindParam(':title',$this->title);
            $statement->bindParam(':quest_a',$this->quest_a);
            $statement->bindParam(':quest_b',$this->quest_b);
            $statement->bindParam(':quest_c',$this->quest_c);
            $statement->bindParam(':quest_d',$this->quest_d);
            $statement->bindParam(':correct_ans',$this->correct_ans);
            $statement->bindParam(':id_quiz',$this->id_quiz);
    
            if ($statement->execute()){
                return true;
            }
            printf("Error %s.\n", $statement->error);
            return false;
        }


         //Update delete
         public function delete() {
            $query = "DELETE FROM quiz WHERE id_quiz=:id_quiz ";
            $statement = $this->conn->prepare($query);
            
            //clean data
            $this->id_quiz = htmlspecialchars(strip_tags($this->id_quiz));
    
            //bind data
            $statement->bindParam(':id_quiz',$this->id_quiz);
    
            if ($statement->execute()){
                return true;
            }
            printf("Error %s.\n", $statement->error);
            return false;
        }

}
?>