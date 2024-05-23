<?php
    error_reporting(0);
    require_once('db.php');
    session_start();
    ?> 
    <ul id="listContainer2">
        <?php
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $query = "SELECT id_note, note FROM notes WHERE login = '$login'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li class="list-row note" data-note-id="' . $row['id_note'] . '" data-note-text="' . $row['note'] . '">';
            echo '<span>' . $row['note'] . '</span>';
            echo '<div id="noteBtns-container">';
            echo '<button id="editBtn" onclick="editNote(' . $row['id_note'] . ')"><span class="fa-solid-fa-pen"></span></button>';
            echo '<span class="trash" onclick="deleteNote(' . $row['id_note'] . ')"></span>';
            echo '</div>';
            echo '</li>';
        }
    } else {
    }
} else {
    echo '<li>Ошибка: Пользователь не авторизован</li>';
}
?>
</ul>
 
<script>

function createNote() {
    var noteText = document.getElementById('note-text').value;

    if (noteText === '') {
        alert('Вы не ввели текст!');
    } else {
        var xhr = new XMLHttpRequest();
        var params = 'noteText=' + encodeURIComponent(noteText);

        var newListElement = document.createElement('li');
                newListElement.setAttribute('data-note-id', xhr.responseText);
                newListElement.innerHTML = '<span>' + noteText + '</span>' +
                                           '<div id="noteBtns-container">' +
                                           '<button id="editBtn" onclick="editNote(' + xhr.responseText + ')"><span class="fa-solid-fa-pen"></span></button>' +
                                           '<span class="trash"></span>' +
                                           '</div>';
                document.getElementById('listContainer2').appendChild(newListElement);

        xhr.open('POST', 'save_notes.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                
                location.reload();
            } else {
                alert('Ошибка при отправке данных на сервер');
            }
        };
        xhr.send(params);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    listContainer2.addEventListener("click", function(e) {
        if (e.target.tagName === "LI") {
            e.target.classList.toggle("checked");
        } else if ((e.target.tagName === "SPAN") && !e.target.classList.contains('note') && !e.target.classList.contains('fa-solid-fa-pen')) {
            var listItem = e.target.closest("li");
            listItem.remove();
        }
    }, false);
});

<span class="trash"></span>
document.querySelectorAll('.trash').forEach(function(span) {
    span.addEventListener('click', function() {
        var noteId = this.parentNode.getAttribute('data-note-id');
        deleteNote(noteId);
    });
});

function deleteNote(noteId) {
    var xhr = new XMLHttpRequest();
    var url = 'delete_note.php';
    var formData = new FormData();
    formData.append('id_note', noteId);

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

function editNote(noteId) {
    const noteElement = document.querySelector('#listContainer2 .note[data-note-id="' + noteId + '"]');
    if (noteElement) {
        const noteText = noteElement.getAttribute('data-note-text');
        const editingPopup = document.createElement("div");

        editingPopup.innerHTML = `
            <div id="editing-container" data-note-id="${noteId}">
                <h1>Редактировать заметку</h1>
                <textarea id="note-text">${noteText}</textarea>
                <div id="btn-container">
                    <button id="submitBtn" onclick="updateNote('${noteId}'); closeEditPopup() ">Готово!</button>
                    <button id="closeBtn" onclick="closeEditPopup()">Отмена</button>
                </div>
            </div>`;

        document.body.appendChild(editingPopup);
    }
}

function updateNote(noteId) {
    const editingPopup = document.getElementById('editing-container');
    const noteText = editingPopup.querySelector('textarea').value.trim();

    if (noteText !== '') {
        fetch('update_note.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded' 
            },
            body: "note_id=" + encodeURIComponent(noteId) + "&notes=" + encodeURIComponent(noteText)
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                throw new Error('Ошибка при обновлении заметки');
            }
        })
        .catch(error => console.error(error));
    } else {
        alert("Текст заметки не может быть пустым.");
    }
}
function closeEditPopup() {
    const editingPopup = document.getElementById("editing-container");
    if (editingPopup) {
        editingPopup.remove();
    }
}
</script>
