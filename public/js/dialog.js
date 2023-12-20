var modal = document.getElementById("myModal");
var modalText = document.getElementById("modalText");

function openModal(note) {
    modalText.innerHTML = note;
    modal.style.display = "block";
    window.addEventListener("keydown", closeModalOnEsc);
}

function closeModal() {
    modal.style.display = "none";
    window.removeEventListener("keydown", closeModalOnEsc);
}

function closeModalOnEsc(event) {
    if (event.key === "Escape") {
        closeModal();
    }
}

document.addEventListener("click", function (event) {
    var target = event.target;
    if (target.classList.contains("open-modal-btn")) {
        var note = target.nextElementSibling.textContent;
        openModal(note);
    } else if (target === modal) {
        closeModal();
    }
});