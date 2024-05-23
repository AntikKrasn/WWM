<?php
error_reporting(0);
require_once('db.php');
session_start();
?>

<div class="containerleft2">
    <ul id="listContainer">
        <?php
        if (isset($_SESSION['login'])) {
            $login = $_SESSION['login'];

            $query = "SELECT id_task, task FROM task WHERE login = '$login'";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-row task" data-task-id="' . $row['id_task'] . '">' . $row['task'] . '<span class="delete-task"></span></li>';
                }
            } else {
            }
        } else {
            echo '<li class="list-row">Ошибка: Пользователь не авторизован</li>';
        }
        ?>
    </ul>
</div>

<script>
    document.querySelectorAll('.delete-task').forEach(function(span) {
        span.addEventListener('click', function() {
            var taskId = this.parentNode.getAttribute('data-task-id');
            deleteTask(taskId);
        });
    });

    function deleteTask(taskId) {
    var xhr = new XMLHttpRequest();
    var url = 'delete_task.php';
    var formData = new FormData();
    formData.append('id_task', taskId);

    xhr.open('POST', url, true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.send(formData);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response.trim() === 'true') {
                    location.reload();
                } else {
                    console.error('Ошибка при удалении задачи:', response);
                }
            } else {
                console.error('Ошибка при выполнении запроса:', xhr.status);
            }
        }
    };
}
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var listContainer = document.getElementById("listContainer");
    
    listContainer.addEventListener("click", function(e) {
        if (e.target.tagName === "LI") {
            e.target.classList.toggle("checked");
        } else if (e.target.tagName === "SPAN") {
            e.target.parentElement.remove();

            // Update localStorage after removing a task
            localStorage.setItem("tasks", listContainer.innerHTML);
        }
    }, false);

    window.addEventListener('beforeunload', function(event) {
        var tasksToDelete = document.querySelectorAll('.checked');

        tasksToDelete.forEach(function(task) {
            var taskId = task.dataset.taskId;
            var taskText = task.innerText.trim();

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_task.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); 
                }
            };
            xhr.send("id_task=" + taskId + "&task_text=" + encodeURIComponent(taskText));
        });
    });
});
</script>
