// select2
document.addEventListener('DOMContentLoaded', function () {
    // Ensure Select2 library is loaded
    if (jQuery && jQuery.fn.select2) {
        // Initialize Select2 for all elements with the class 'form-select'
        $('.selectsearch').each(function() {
            var placeholderText = $(this).data('placeholder') || "Select an option";  // Get the placeholder from data attribute
            $(this).select2({
                placeholder: placeholderText, // Dynamically set the placeholder
                allowClear: true,  // Optional: adds a clear button to remove the selection
                width: '100%', // Ensure the width is set to 100%
                dropdownParent: "#addDoctorForm"
            });
        });
    } else {
        console.error('Select2 library is not loaded.');
    }
});

//Popups Modal 
function popupAlertSaveSuccess(gencode) {
    const addDocModal = new bootstrap.Modal(document.getElementById('addDoctorModal'));
    addDocModal.hide();
    const alertSuccess = new bootstrap.Modal(document.getElementById('popupAlertSuccess'));
    alertSuccess.show();
    const msgs = document.getElementById('alertMessage');
    msgs.textContent = 'New doctor added successfully.';
    document.querySelector('.confSBtn').addEventListener('click', function () {
        window.location.href = `doctor_profile/${gencode}`;
    });
}

function popupAlertSaveFailed(){
    const alertFailed = new bootstrap.Modal(document.getElementById('popupAlertFailed'));
    alertFailed.show();
    document.querySelector('.confEBtn').addEventListener('click', function () {
        window.location.href = "manage_doctor";
    });
}

function popupAlertUpdateSuccess(code){
    const alertSuccess = new bootstrap.Modal(document.getElementById('popupAlertSuccess'));
    const msgs = document.getElementById('alertMessage');
    msgs.textContent = 'New doctor information updated successfully.';
    alertSuccess.show();
    document.querySelector('.confSBtn').addEventListener('click', function () {
        window.location.href = `doctor_profile/${code}`;
    });
}

function popupAlertUpdateFailed(code){
    const alertFailed = new bootstrap.Modal(document.getElementById('popupAlertFailed'));
    alertFailed.show();
    document.querySelector('.confEBtn').addEventListener('click', function () {
        window.location.href = `doctor_profile/${code}`;
    });
}