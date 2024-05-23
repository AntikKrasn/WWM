function popup() {
    const popupContainer = document.createElement("div");
    popupContainer.innerHTML = <div id="popupContainer"> <h1>Новая заметка</h1><textarea id="note-text" placeholder="Введите вашу заметку..."></textarea><div id="btn-container"><button id="submitBtn" onclick="createNote(); closePopup()">Создать</button><button id="closeBtn" onclick="closePopup()">Закрыть</button></div></div>;
    document.body.appendChild(popupContainer);
}

function closePopup() {
    const popupContainer = document.getElementById("popupContainer");
    if(popupContainer) {
        popupContainer.remove();}}
