<?php
require_once '../model/TestModel.php';



class TestPresenter {
    private $testModel;
    
    private $db;

    public function __construct($db) {

        $this->db = $db;
        
        $this->testModel = new TestModel($db);
       
    }

    public function addTestWithQuestions($nom, $description, $questions) {
        // Ajouter le test
        $testId = $this->testModel->insertTest($nom, $description);

        if ($testId) {
            foreach ($questions as $question) {
                if (trim($question) !== '') { // Ignorer les questions vides
                    $this->testModel->insertQuestion($testId, $question);
                }
            }

            // Redirection vers success.php en cas de succès
            header("Location: success.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout du test.";
        }
    }

    public function deleteTest($testId) {
        if ($this->testModel->deleteTestById($testId)) {
            header("Location: deletetest.php"); // Rediriger après suppression
            exit();
        } else {
            echo "Erreur lors de la suppression du test.";
        }
    }

       // Méthode pour obtenir tous les tests
       public function getAllTests() {
        return $this->testModel->getAllTests();
    }

    // Méthode pour obtenir un test par son ID
    public function getTestById($id_test) {
        return $this->testModel->getTestById($id_test);
    }

    // Méthode pour récupérer les questions d'un test
    public function getQuestionsByTestId($id_test) {
        return $this->testModel->getQuestionsByTestId($id_test);
    }

    

    // Méthode pour mettre à jour un test
    public function updateTest($id_test, $nom, $description) {
        $query = $this->db->prepare("UPDATE tests SET nom = :nom, description = :description WHERE id = :id_test");
        $query->bindParam(':id_test', $id_test, PDO::PARAM_INT);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        if ($query->execute()) {
            return true;
        } else {
            $errorInfo = $query->errorInfo();
            error_log("Failed to update test: " . print_r($errorInfo, true));
            return false;
        }
    }

    public function updateQuestion($id_question, $question) {
        $query = $this->db->prepare("UPDATE questions SET question = :question WHERE id = :id_question");
        $query->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $query->bindParam(':question', $question, PDO::PARAM_STR);
        if ($query->execute()) {
            return true;
        } else {
            $errorInfo = $query->errorInfo();
            error_log("Failed to update question: " . print_r($errorInfo, true));
            return false;
        }
    }
}

