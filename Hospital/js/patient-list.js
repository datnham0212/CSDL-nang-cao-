document.addEventListener('DOMContentLoaded', function () {
    var rows = document.querySelectorAll('.doctor-row');

    rows.forEach(function (row) {
        row.addEventListener('click', function () {
            var doctorId = this.getAttribute('data-doctor-id');
            window.location.href = 'patient-list.php?doctor_id=' + doctorId;
        });
    });
});
