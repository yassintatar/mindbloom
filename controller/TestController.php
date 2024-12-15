<?php
class TestController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getQuestions($testId) {
        $query = $this->db->prepare("SELECT * FROM questions WHERE id_test = :testId");
        $query->bindParam(':testId', $testId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResponses($questionId) {
        $query = $this->db->prepare("SELECT * FROM responses WHERE id_question = :questionId");
        $query->bindParam(':questionId', $questionId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveUserResponse($userId, $testId, $responses) {
        foreach ($responses as $questionId => $responseId) {
            $query = $this->db->prepare("INSERT INTO user_responses (user_id, id_test, id_question, id_reponse) VALUES (:userId, :testId, :questionId, :responseId)");
            $query->bindParam(':userId', $userId, PDO::PARAM_INT);
            $query->bindParam(':testId', $testId, PDO::PARAM_INT);
            $query->bindParam(':questionId', $questionId, PDO::PARAM_INT);
            $query->bindParam(':responseId', $responseId, PDO::PARAM_INT);
            $query->execute();
        }
    }

    public function calculateResult($testId) {
        $query = $this->db->prepare("SELECT COUNT(*) AS score FROM user_responses WHERE id_test = :testId");
        $query->bindParam(':testId', $testId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['score'];
    }
}
?>

