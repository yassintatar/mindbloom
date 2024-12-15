<?php
class TestModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertTest($nom, $description) {
        try {
            $query = "INSERT INTO test (nom, description) VALUES (:nom, :description)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();
            return $this->db->lastInsertId(); // Récupère l'id du test inséré
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du test : " . $e->getMessage();
            return false;
        }
    }

    public function insertQuestion($testId, $question) {
        try {
            $query = "INSERT INTO question (id_test, question) VALUES (:testId, :question)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':testId', $testId, PDO::PARAM_INT);
            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la question : " . $e->getMessage();
            return false;
        }
    }
    public function deleteTestById($testId) {
        try {
            $query = "DELETE FROM test WHERE id_test = :testId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':testId', $testId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du test : " . $e->getMessage();
            return false;
        }
    }

    public function getAllTests() {
        try {
            $query = "SELECT id_test, nom, description FROM test";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des tests : " . $e->getMessage();
            return [];
        }
    }
    public function getTestById($id_test) {
        $query = "SELECT * FROM test WHERE id_test = :id_test";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_test', $id_test, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne le test trouvé
    }

    // Met à jour un test existant
    public function updateTest($id_test, $nom, $description) {
        $query = "UPDATE test SET nom = :nom, description = :description WHERE id_test = :id_test";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_test', $id_test, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        return $stmt->execute(); // Retourne true si la mise à jour a réussi
    }

    // Récupère toutes les questions d'un test donné
    public function getQuestionsByTestId($id_test) {
        $query = "SELECT * FROM question WHERE id_test = :id_test";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_test', $id_test, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les questions
    }

    // Met à jour une question d'un test
    public function updateQuestion($id_question, $question) {
        $query = "UPDATE question SET question = :question WHERE id_question = :id_question";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $stmt->bindParam(':question', $question, PDO::PARAM_STR);
        return $stmt->execute(); // Retourne true si la mise à jour a réussi
    }
    

    
}
?>
    