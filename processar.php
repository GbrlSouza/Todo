<?php
require_once __DIR__ . '/includes/functions.php';

$message = '';
$status = 'error';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_task') {
    $title = trim($_POST['title'] ?? '');

    if (!empty($title)) {
        if (add_task($title)) {
            $message = 'Tarefa adicionada com sucesso!';
            $status = 'success';
        } else { $message = 'Erro ao adicionar a tarefa.'; }
    } else { $message = 'O título da tarefa não pode estar vazio.'; }
} 

elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = (int) $_GET['id'];
    $success = false;
    
    if ($action === 'toggle_status') {
        if (toggle_task_status($id)) {
            $message = 'Status da tarefa alterado com sucesso!';
            $status = 'success';
            $success = true;
        }
    } elseif ($action === 'delete') {
        if (delete_task($id)) {
            $message = 'Tarefa excluída com sucesso!';
            $status = 'success';
            $success = true;
        }
    }
    
    if (!$success && $status !== 'success') { $message = 'Erro ao processar a ação ou ID inválido.'; }
} else { $message = 'Ação ou método de requisição inválido.'; }

header("Location: index.php?message=" . urlencode($message) . "&status=" . urlencode($status));

exit;
