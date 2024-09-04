import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Modale conferma elimina
document.addEventListener('DOMContentLoaded', function () {
    const allDeleteButtons = document.querySelectorAll('.modal-delete');
    allDeleteButtons.forEach((deleteButton) => {
        deleteButton.addEventListener('click', function (event) {
            event.preventDefault();

            const deleteModal = document.getElementById('confirmDeleteModal');
            const itemName = this.getAttribute('data-item-name'); // Ottieni il nome dell'elemento dal data attribute
            const itemToDeleteSpan = document.getElementById('itemToDelete');

            // Aggiorna il contenuto della modale con il nome dell'elemento
            itemToDeleteSpan.textContent = itemName;

            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');

            const modalCancelDeletionBtn = document.getElementById('ms-modal-cancel-deletion');
            modalCancelDeletionBtn.addEventListener('click', function () {
                deleteModal.classList.remove('flex');
                deleteModal.classList.add('hidden');
            });

            const modalConfirmDeletionBtn = document.getElementById('ms-modal-confirm-deletion');
            modalConfirmDeletionBtn.addEventListener('click', function () {
                deleteButton.closest('form').submit();
            });
        });
    });
});
