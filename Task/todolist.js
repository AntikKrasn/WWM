const listContainer = document.getElementById('list-row');

function addTask() {
    const inputValue = document.getElementById('input-box').value;

    if (inputValue === '') {
        alert('Вы не ввели текст!');
    } else {
        const listItem = document.createElement('li');
        listItem.innerText = inputValue;
        listContainer.appendChild(listItem);

        let span = document.createElement("span");
        span.innerText = "";
  
        listItem.appendChild(span);
  
        document.getElementById('input-box').value = '';

        // Save tasks to localStorage
        localStorage.setItem("tasks", listContainer.innerHTML);
    }
}

listContainer.addEventListener("click", function(e) {
    if (e.target.tagName === "LI") {
        e.target.classList.toggle("checked");
    } else if (e.target.tagName === "SPAN") {
        e.target.parentElement.remove();

        // Update localStorage after removing a task
        localStorage.setItem("tasks", listContainer.innerHTML);
    }
}, false);

// Load tasks from localStorage
function showTask() {
    listContainer.innerHTML = localStorage.getItem("tasks") || '';
}
showTask();