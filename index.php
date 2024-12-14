<?php
$todos = isset($_POST['todos']) ? json_decode($_POST['todos'], true) : [];
$newTodo = isset($_POST['newTodo']) ? trim($_POST['newTodo']) : '';
if ($newTodo) $todos[] = $newTodo;
if (isset($_POST['delete'])) unset($todos[$_POST['delete']]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amine Todo App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; background: #f3f4f6; }
        h1 { color: #333; }
        form { margin-top: 20px; }
        input[type="text"] { padding: 10px; font-size: 16px; width: 300px; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; font-size: 16px; background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        ul { list-style: none; padding: 0; margin: 20px 0; width: 340px; }
        li { background: #fff; margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
        li button { background: #ff4d4d; border: none; color: #fff; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
        li button:hover { background: #cc0000; }
    </style>
</head>
<body>
    <h1>Amine Todo App</h1>
    <form id="todoForm" method="POST">
        <input type="text" name="newTodo" id="newTodo" placeholder="Add a new task..." required>
        <button type="submit">Add</button>
        <input type="hidden" name="todos" id="todos" value='<?= json_encode($todos) ?>'>
    </form>
    <ul id="todoList">
        <?php foreach ($todos as $index => $todo): ?>
        <li>
            <span><?= htmlspecialchars($todo) ?></span>
            <form method="POST" style="margin: 0;">
                <input type="hidden" name="delete" value="<?= $index ?>">
                <input type="hidden" name="todos" value='<?= json_encode($todos) ?>'>
                <button type="submit">Delete</button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
    <script>
        const form = document.getElementById('todoForm');
        const todoInput = document.getElementById('newTodo');
        const todosInput = document.getElementById('todos');
        form.addEventListener('submit', (e) => {
            if (!todoInput.value.trim()) e.preventDefault();
            todosInput.value = JSON.stringify([...document.querySelectorAll('#todoList li span')].map(span => span.textContent));
        });
    </script>
</body>
</html>
