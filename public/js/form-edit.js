document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('editarCheckbox');
    const form = document.querySelector('form'); // Ou: document.getElementById('meuForm');
    const inputs = form.querySelectorAll('input, textarea, select');
    const submitBtn = document.getElementById('submitBtn');

    function toggleInputs(checked) {
        inputs.forEach(input => {
            if (
                input.type !== 'hidden' &&
                input.name !== '_token' &&
                input.name !== '_method' &&
                input !== checkbox // evita desabilitar o próprio checkbox
            ) {
                input.disabled = !checked;
            }
        });

        if (submitBtn) {
            submitBtn.disabled = !checked;
        }
    }

    if (checkbox) {
        // Aplica o estado inicial com base no checkbox
        toggleInputs(checkbox.checked);

        // Escuta alterações futuras
        checkbox.addEventListener('change', function () {
            toggleInputs(this.checked);
        });
    }
});
