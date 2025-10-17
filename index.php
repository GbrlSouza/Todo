<?php
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/functions.php';

$tasks = get_all_tasks();

$message = $_GET['message'] ?? '';
$status = $_GET['status'] ?? '';
$alert_class = '';

if ($status === 'success') {
    $alert_class = 'alert-success';
} elseif ($status === 'error') { $alert_class = 'alert-error'; }

?>

        <div class="container mx-auto p-4 max-w-2xl mt-10">
            <h1 class="text-4xl font-bold text-center mb-8 text-primary">
                📝 To-Do Simples (PHP/XML + DaisyUI)
            </h1>

            <?php if ($message): ?>
            <div role="alert" class="alert <?= $alert_class ?> mb-6 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <?php if ($status === 'success'): ?>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    <?php else: ?>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    <?php endif; ?>
                </svg>
                <span><?= htmlspecialchars($message) ?></span>
            </div>
            <?php endif; ?>

            <div class="card bg-base-100 shadow-xl mb-8 p-6">
                <h2 class="card-title text-2xl mb-4">Adicionar Nova Tarefa</h2>
                <form action="processar.php" method="POST" class="flex flex-col md:flex-row gap-4">
                    <input 
                        type="text" 
                        name="title" 
                        placeholder="Ex: Comprar leite e pão..." 
                        class="input input-bordered w-full" 
                        required
                    />
                    <input type="hidden" name="action" value="add_task">
                    <button type="submit" class="btn btn-primary w-full md:w-auto">
                        Adicionar
                    </button>
                </form>
            </div>

            <h2 class="text-3xl font-bold mb-4 text-secondary">Tarefas Pendentes</h2>

            <?php if (empty($tasks)): ?>
                <div class="alert alert-info shadow-lg">
                    <span>🎉 Nenhuma tarefa encontrada! Adicione uma nova.</span>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto bg-base-100 rounded-box shadow-xl">
                    <table class="table w-full">
                        <thead>
                            <tr class="text-lg">
                                <th class="w-1/12">ID</th>
                                <th class="w-7/12">Título</th>
                                <th class="w-4/12 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): 
                                $id = (int) $task['id'];
                                $title = htmlspecialchars((string) $task->title);
                                $is_completed = ((string) $task->completed) === 'true';
                                $row_class = $is_completed ? 'opacity-60 bg-base-200' : '';
                                $text_class = $is_completed ? 'line-through text-gray-500' : 'font-semibold';
                            ?>
                                <tr class="<?= $row_class ?>">
                                    <th><?= $id ?></th>
                                    <td class="<?= $text_class ?>">
                                        <?= $title ?>
                                    </td>
                                    <td class="flex flex-col sm:flex-row gap-2 justify-center">
                                        <a href="processar.php?action=toggle_status&id=<?= $id ?>" 
                                        class="btn btn-sm <?= $is_completed ? 'btn-warning' : 'btn-success' ?>">
                                            <?= $is_completed ? 'Reabrir' : 'Concluir' ?>
                                        </a>

                                        <a href="processar.php?action=delete&id=<?= $id ?>" 
                                        onclick="return confirm('Tem certeza que deseja excluir a tarefa: <?= addslashes($title) ?>?');"
                                        class="btn btn-sm btn-error">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>