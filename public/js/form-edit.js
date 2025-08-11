document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const btnEditar = document.getElementById('btnEditar');
    const inputs = form.querySelectorAll('input, textarea, select');
    const submitBtn = document.getElementById('submitBtn');

    function toggleCampos(habilitar) {
        inputs.forEach(input => {
            if (
                input.type !== 'hidden' &&
                input.name !== '_token' &&
                input.name !== '_method'
            ) {
                input.disabled = !habilitar;
            }
        });

        if (submitBtn) {
            submitBtn.disabled = !habilitar;
        }
    }

    // Se estamos no modo edição (associado já existe), desabilita os campos inicialmente
    if (btnEditar) {
        toggleCampos(false);

        btnEditar.addEventListener('click', function () {
            toggleCampos(true);
        });
    } else {
        toggleCampos(true); // Novo cadastro
    }
});
