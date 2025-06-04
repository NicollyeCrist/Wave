<?php

require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../model/dbConnection.php';

class AdminDashboardController extends AdminController {
    
    public function show(): void {
        session_start();
        $this->requireAuth();
        
        try {
            // Buscar estatísticas do sistema
            $conn = DbConnection::getConn();
            
            // Total de usuários
            $stmt = $conn->query("SELECT COUNT(*) as total FROM usuarios");
            $totalUsuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Total de disciplinas
            $stmt = $conn->query("SELECT COUNT(*) as total FROM disciplinas");
            $totalDisciplinas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Total de conteúdos
            $stmt = $conn->query("SELECT COUNT(*) as total FROM conteudos");
            $totalConteudos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Total de questões
            $stmt = $conn->query("SELECT COUNT(*) as total FROM questoes");
            $totalQuestoes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Total de turmas
            $stmt = $conn->query("SELECT COUNT(*) as total FROM turmas");
            $totalTurmas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Total de admins
            $stmt = $conn->query("SELECT COUNT(*) as total FROM admins WHERE ativo = 1");
            $totalAdmins = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $data = [
                'totalUsuarios' => $totalUsuarios,
                'totalDisciplinas' => $totalDisciplinas,
                'totalConteudos' => $totalConteudos,
                'totalQuestoes' => $totalQuestoes,
                'totalTurmas' => $totalTurmas,
                'totalAdmins' => $totalAdmins
            ];
            
            $this->render('adminDashboard', $data);
            
        } catch (Exception $e) {
            error_log("Erro no dashboard admin: " . $e->getMessage());
            $this->setMessage('Erro ao carregar dashboard.', 'error');
            $this->render('adminDashboard', []);
        }
    }
}
?>
