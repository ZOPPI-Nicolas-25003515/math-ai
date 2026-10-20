document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modalForm');
    const trigger = document.getElementById('openDeleteModalBtn');
    const closeButtons = document.querySelectorAll('[data-close-modal="true"]');
    const passwordInput = document.getElementById('deletePassword');

    if (!modal) {
        return;
    }

    const openModal = () => {
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');

        if (passwordInput) {
            passwordInput.focus();
        }
    };

    const closeModal = () => {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    };

    trigger?.addEventListener('click', openModal);

    closeButtons.forEach((button) => {
        button.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal || event.target.classList.contains('modal-backdrop')) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });

    if (modal.classList.contains('is-open')) {
        openModal();
    }
});
