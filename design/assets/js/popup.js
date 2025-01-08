// select2
document.addEventListener('DOMContentLoaded', function () {
    if (jQuery && jQuery.fn.select2) {
        $('.selectsearch').each(function() {
            var placeholderText = $(this).data('placeholder') || "Select an option";
            $(this).select2({
                placeholder: placeholderText,
                allowClear: true,
                width: '100%',
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

// uploading file
document.addEventListener('DOMContentLoaded', function(){
    const succesmodal = new bootstrap.Modal(document.getElementById('popupAlertSuccess'));
    const warningmodal = new bootstrap.Modal(document.getElementById('popupAlertWarning'));
    const fileInput = document.getElementById('fileupload');
    const cropContainer = document.getElementById('crop-container');
    const cropImage = document.getElementById('crop-image');
    const saveCropButton = document.getElementById('save-crop');
    let cropper = null;

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file.size > 25 * 1024 * 1024) {
            alert('The file size exceeds the 25MB limit. Please choose a smaller file.');
            fileInput.value = '';
            return;
        }

        // Check if file type is valid
        if (file && (file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg')) {
            const reader = new FileReader();

            reader.onload = (e) => {
                cropImage.src = e.target.result;
                cropContainer.classList.remove('hidden');
                fileInput.style.display = 'none';
                if (cropper) cropper.destroy();
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };

            reader.readAsDataURL(file);
        } else {
            alert('Please upload a valid image file (PNG or JPG).');
            fileInput.value = '';
        }
    });

    // Handle saving the cropped image
    saveCropButton.addEventListener('click', async () => {
        const drcode = document.getElementById('drcode').value;
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 256,
                height: 256,
            });
    
            const croppedImageURL = canvas.toDataURL('image/png');
            const byteString = atob(croppedImageURL.split(',')[1]);
            const arrayBuffer = new ArrayBuffer(byteString.length);
            const uint8Array = new Uint8Array(arrayBuffer);
    
            for (let i = 0; i < byteString.length; i++) {
                uint8Array[i] = byteString.charCodeAt(i);
            }
    
            const blob = new Blob([uint8Array], { type: 'image/png' });
            const formData = new FormData();
            formData.append('drpic', blob, 'profile-picture.png');

            const fetchUrl = `${BASE_URL}uploadProfilePicture/${drcode}`;
    
            try {
                const response = await fetch(fetchUrl, {
                    method: 'POST',
                    body: formData,
                });
    
                if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.status === 'success') {
                        $("#UploadPicture").modal('hide');
                        succesmodal.show();
                        document.getElementById('alertMessage').textContent = responseData.message;
                        document.querySelector('.confSBtn').onclick = function(){
                            location.reload();
                        }
                    } else {
                        warningmodal.show();
                        document.getElementById('alertMessage').textContent = responseData.message;
                        document.querySelector('.confSBtn').onclick = function(){
                            warningmodal.hide();
                        }
                    }
                } else {
                    const errorData = await response.json();
                    alert(`Error: ${errorData.message}`);
                }
            } catch (error) {
                alert(`An unexpected error occurred=====>:: ${error.message}`);
                console.error("Fetch error:", error);
                console.log('Blob:', blob);
            }
        }
    });    

    // Reset cropper on modal close or cancel
    document.querySelector('.btn-close').addEventListener('click', () => {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        cropContainer.classList.add('hidden');
        fileInput.value = '';
    });
});


// update doctors password
document.addEventListener('DOMContentLoaded', function () {
    function validateInputOnInput() {
        const currentPassword = document.getElementById('currentPassword');
        const curpassword = document.getElementById('curpassword');
        const newPassword = document.getElementById('newPassword');
        const renewPassword = document.getElementById('renewPassword');

        const alertMsgCurPass = document.getElementById('alertMsgCurPass');
        const alertMsgNewPass = document.getElementById('alertMsgNewPass');
        const alertMsgRenewPass = document.getElementById('alertMsgRenewPass');

        function setValidationState(element, alertMsg, message, isError) {
            if (isError) {
                alertMsg.textContent = message;
                alertMsg.style.color = 'red';
                element.classList.add('error-box');
                element.classList.remove('success-box');
            } else {
                alertMsg.textContent = '';
                element.classList.add('success-box');
                element.classList.remove('error-box');
            }
        }

        // Validate current password on input
        currentPassword.addEventListener('input', function () {
            if (currentPassword.value.trim() === '') {
                setValidationState(currentPassword, alertMsgCurPass, 'Please input current password.', true);
                newPassword.setAttribute('disabled', 'true');
                renewPassword.setAttribute('disabled', 'true');
            } else if (currentPassword.value !== curpassword.value) {
                setValidationState(currentPassword, alertMsgCurPass, 'Wrong password.', true);
                newPassword.setAttribute('disabled', 'true');
                renewPassword.setAttribute('disabled', 'true');
            } else {
                setValidationState(currentPassword, alertMsgCurPass, 'Password matched.', false);
                newPassword.removeAttribute('disabled');
                renewPassword.removeAttribute('disabled');
            }
        });        

        // Validate new password on input
        newPassword.addEventListener('input', function () {
            if (newPassword.value.trim() === '') {
                setValidationState(newPassword, alertMsgNewPass, 'Please input new password.', true);
            } else if (newPassword.value === curpassword.value) {
                setValidationState(newPassword, alertMsgNewPass, 'New password cannot be the same as the current password.', true);
            } else {
                setValidationState(newPassword, alertMsgNewPass, '', false);
            }
        });

        // Validate re-entered password on input
        renewPassword.addEventListener('input', function () {
            if (renewPassword.value.trim() === '') {
                setValidationState(renewPassword, alertMsgRenewPass, 'Please re-enter the password.', true);
            } else if (renewPassword.value !== newPassword.value) {
                setValidationState(renewPassword, alertMsgRenewPass, 'Passwords do not match.', true);
            } else if (renewPassword.value === curpassword.value) {
                setValidationState(newPassword, alertMsgRenewPass, 'New password cannot be the same as the current password.', true);
            } else {
                setValidationState(renewPassword, alertMsgRenewPass, '', false);
            }
        });
    }

    // Submission Logic
    async function handleFormSubmission(e) {
        e.preventDefault();
        const succesmodal = new bootstrap.Modal(document.getElementById('popupAlertSuccess'));
        const warningmodal = new bootstrap.Modal(document.getElementById('popupAlertWarning'));
        const currentPassword = document.getElementById('currentPassword');
        const curpassword = document.getElementById('curpassword');
        const newPassword = document.getElementById('newPassword');
        const renewPassword = document.getElementById('renewPassword');

        const alertMsgCurPass = document.getElementById('alertMsgCurPass');
        const alertMsgNewPass = document.getElementById('alertMsgNewPass');
        const alertMsgRenewPass = document.getElementById('alertMsgRenewPass');

        let isValid = true;

        function setValidationState(element, alertMsg, message, isError) {
            if (isError) {
                alertMsg.textContent = message;
                alertMsg.style.color = 'red';
                element.classList.add('error-box');
                element.classList.remove('success-box');
                isValid = false;
            } else {
                alertMsg.textContent = '';
                element.classList.add('success-box');
                element.classList.remove('error-box');
            }
        }

        // Validate inputs on form submission
        if(currentPassword.value.trim() === ''){
            setValidationState( currentPassword, alertMsgCurPass, 'Please input current password.', true);
        } else if(currentPassword.value.trim() !== curpassword.value){
            setValidationState( currentPassword, alertMsgCurPass, 'Please input correct current password.', true);
        }

        if (newPassword.value.trim() === '') {
            setValidationState(newPassword, alertMsgNewPass, 'Please input new password.', true);
        } else if (newPassword.value === curpassword.value) {
            setValidationState(newPassword, alertMsgNewPass, 'New password cannot be the same as the current password.', true);
        }

        if (renewPassword.value.trim() === '') {
            setValidationState(renewPassword, alertMsgRenewPass, 'Please re-enter the password.', true);
        } else if (renewPassword.value !== newPassword.value) {
            setValidationState(renewPassword, alertMsgRenewPass, 'Passwords do not match.', true);
        }

        if (!isValid) {
            return;
        }

        const formData = new FormData();
        formData.append('drcode', drcode.value.trim());
        formData.append('newPassword', newPassword.value.trim());

        try {
            const fetchUrl = `${BASE_URL}updateDoctorsPassword`;
            const response = await fetch(fetchUrl, {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.status === 'success') {
                        succesmodal.show();
                        document.getElementById('alertMessage').textContent = responseData.message;
                        document.querySelector('.confSBtn').onclick = function(){
                            location.reload();
                        }
                    } else {
                        warningmodal.show();
                        document.getElementById('alertMessage').textContent = responseData.message;
                        document.querySelector('.confSBtn').onclick = function(){
                            warningmodal.hide();
                        }
                    }
                } else {
                    const errorData = await response.json();
                    alert(`Error: ${errorData.message}`);
                }
            } catch (error) {
                alert(`An unexpected error occurred: ${error.message}`);
            }
    }

    // Attach event listeners
    validateInputOnInput();
    document.getElementById('submitUpdate').addEventListener('click', handleFormSubmission);
});
