function openModal(type) {
    var modal = document.getElementById(type + '-modal');
    modal.style.display = "block";
}

function closeModal(type) {
    var modal = document.getElementById(type + '-modal');
    modal.style.display = "none";
}

// Close modal if clicked outside the modal content
window.onclick = function(event) {
    var studentModal = document.getElementById("student-modal");
    var employeeModal = document.getElementById("employee-modal");
    if (event.target == studentModal || event.target == employeeModal) {
        studentModal.style.display = "none";
        employeeModal.style.display = "none";
    }
}
