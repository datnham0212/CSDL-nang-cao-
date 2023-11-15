document.addEventListener('DOMContentLoaded', function () {
    var rows = document.querySelectorAll('.patient-row');

    rows.forEach(function (row) {
        var isTextSelected = false;

        row.addEventListener('mousedown', function () {
            isTextSelected = false;

            // Add a class to highlight the row during text selection
            this.classList.add('selecting');
        });

        row.addEventListener('mouseup', function () {
            // Check if text is selected
            var selection = window.getSelection();
            if (selection.type === 'Range' && selection.toString().trim() !== '') {
                isTextSelected = true;
            } else {
                isTextSelected = false;

                // Remove the highlight class if text selection is finished
                this.classList.remove('selecting');
            }
        });

        row.addEventListener('click', function (event) {
            if (!isTextSelected) {
                // If no text is selected, proceed with the redirection
                var patientId = this.getAttribute('data-patient-id');
                window.location.href = 'patient_details.php?patient_id=' + patientId;
            }
        });
    });
});
