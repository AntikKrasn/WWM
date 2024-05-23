<?php
error_reporting(0);
require_once('db.php');
session_start();
?>
    <ul id="listContainer">
        <?php
        if (isset($_SESSION['login'])) {
            $login = $_SESSION['login'];

            $query = "SELECT id_calendar, event, date FROM calendar WHERE login = '$login'";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-row event" data-event-id="' . $row['id_calendar'] . '">' . $row['event'] . '<br><span class="dates">' . $row['date'] . '</span>' . '<span class="delete-event"></span></li>';
                }
            } else {
            }
        } else {
            echo '<li class="list-row">Ошибка: Пользователь не авторизован</li>';
        }
        ?>
    </ul>
<script>
   document.querySelectorAll('.delete-event').forEach(function(span) {
    span.addEventListener('click', function() {
        var eventId = this.parentNode.getAttribute('data-event-id');
        deleteEvent(eventId);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var listContainer = document.getElementById("listContainer");

    listContainer.addEventListener("click", function(e) {
        if (e.target.tagName === "LI") {
            e.target.classList.toggle("checked");
        } else if (e.target.tagName === "SPAN" && !e.target.classList.contains('dates')) {
            e.target.parentElement.remove();

            localStorage.setItem("event", "date", listContainer.innerHTML);
        }
    }, false);
});

    function deleteEvent(eventId) {
    var xhr = new XMLHttpRequest();
    var url = 'delete_event.php';
    var formData = new FormData();
    formData.append('id_calendar', eventId);

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

