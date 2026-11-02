<?php

namespace App\Controller;
use Core\View;
use App\Model\UserRepository;
class ViewclassController
{
    public function __construct(private readonly UserRepository $repository) {}

    public function downloadAction(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            die("ID de cours invalide.");
        }
        $class = $this->repository->findClassById($id);

        if (!$class || empty($class['path_name'])) {
            http_response_code(404);
            die("Cours ou fichier introuvable en base de données.");
        }

        $filePath = __DIR__ . '/../../resources/Class/' . $class['path_name'];

        if (!file_exists($filePath)) {
            http_response_code(404);
            die("Le fichier PDF physique est introuvable sur le serveur.");
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        if (ob_get_level()) {
            ob_end_clean();
        }

        // 6. Lire et afficher le fichier binaire
        readfile($filePath);
        exit;
    }

    public function viewAction(): void
    {
        $classId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($classId <= 0) {
            die("Cours introuvable.");
        }

        $classData = $this->repository->findClassById($classId);

        if (!$classData) {
            die("Ce cours n'existe pas.");
        }

        echo View::show('Viewclass', [
            'class' => $classData
        ]);
    }

}