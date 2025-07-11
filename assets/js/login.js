// Modal Register
const openModal = document.getElementById('openRegisterModal');
const closeModal = document.getElementById('closeRegisterModal');
const modal = document.getElementById('registerModal');
const openStaffRegisterForm = document.getElementById('openStaffRegisterForm');
const staffRegisterForm = document.getElementById('staffRegisterForm');
const registerOptions = document.getElementById('registerOptions');
const backToRegisterOptions = document.getElementById('backToRegisterOptions');

if (openModal && closeModal && modal) {
    openModal.onclick = function(e) {
        e.preventDefault();
        modal.style.display = 'flex';
        // Reset ke pilihan utama
        if (registerOptions && staffRegisterForm) {
            registerOptions.style.display = 'flex';
            staffRegisterForm.style.display = 'none';
        }
    };
    closeModal.onclick = function() {
        modal.style.display = 'none';
    };
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
}
if (openStaffRegisterForm && staffRegisterForm && registerOptions) {
    openStaffRegisterForm.onclick = function(e) {
        e.preventDefault();
        registerOptions.style.display = 'none';
        staffRegisterForm.style.display = 'flex';
    };
}
if (backToRegisterOptions && staffRegisterForm && registerOptions) {
    backToRegisterOptions.onclick = function(e) {
        e.preventDefault();
        staffRegisterForm.style.display = 'none';
        registerOptions.style.display = 'flex';
    };
} 