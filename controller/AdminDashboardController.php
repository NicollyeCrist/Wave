<?php

require_once __DIR__ . '/adminController.php';
require_once __DIR__ . '/../model/dbConnection.php';

class AdminDashboardController extends AdminController {
    
    public function show(): void {
        session_start();
        $this->requireAuth();
        
        try {
            $conn = DbConnection::getConn();
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM usuarios");
            $totalUsuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM disciplinas");
            $totalDisciplinas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM conteudos");
            $totalConteudos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM questoes");
            $totalQuestoes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM turmas");
            $totalTurmas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM admins WHERE ativo = 1");
            $totalAdmins = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $data = [
                'totalUsuarios' => $totalUsuarios,
                'totalDisciplinas' => $totalDisciplinas,
                'totalConteudos' => $totalConteudos,
                'totalQuestoes' => $totalQuestoes,
                'totalTurmas' => $totalTurmas,
                'totalAdmins' => $totalAdmins            ];
              $this->render('admin/adminDashboard', $data);
            
        } catch (Exception $e) {
            error_log("Erro no dashboard admin: " . $e->getMessage());
            $this->setMessage('Erro ao carregar dashboard.', 'error');
            $this->render('admin/adminDashboard', []);
        }
    }
}
?>
