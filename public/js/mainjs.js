$(document).ready(function () {
    function togglePasswordVisibility() {
        let inputType = $('#password').attr('type');
        let newType = inputType === 'password' ? 'text' : 'password';
        let iconClass = inputType === 'password' ? 'fa-eye' : 'fa-eye-slash';

        $('#password').attr('type', newType);
        $('#togglePassword i').removeClass('fa-eye-slash fa-eye').addClass(iconClass);
    }

    $('#togglePassword').on('click', function (e) {
        e.preventDefault();
        togglePasswordVisibility();
    });
});