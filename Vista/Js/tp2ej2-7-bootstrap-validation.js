// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })
})()

document.getElementById('numero2Input').addEventListener('input', function() {
        const input = this.value;
        if (input === '0') {
            this.setCustomValidity('Cero no es un número válido.');
        } else {
            this.setCustomValidity('');
        }
});
