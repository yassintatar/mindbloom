<?php
class Test {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTests() {
        $stmt = $this->db->query("SELECT * FROM tests");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuestions($testId) {
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE test_id = ?");
        $stmt->execute([$testId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getResponses($questionId) {
        $stmt = $this->db->prepare("SELECT * FROM responses WHERE question_id = ?");
        $stmt->execute([$questionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveUserResponse($userId, $testId, $responses) {
        foreach ($responses as $questionId => $responseId) {
            $stmt = $this->db->prepare("INSERT INTO user_responses (user_id, test_id, question_id, response_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, $testId, $questionId, $responseId]);
        }
    }

    public function calculateResult($resultId) {
        // Calculate score based on responses
    }

    public function updateResult($resultId, $score) {
        $stmt = $this->db->prepare("UPDATE results SET score = ? WHERE id = ?");
        $stmt->execute([$score, $resultId]);
    }
}
?>
