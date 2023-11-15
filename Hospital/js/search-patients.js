function searchPatients() {
            const input = document.getElementById("patient-search").value.toLowerCase();
            const patientList = document.getElementById("patient-list");
            const rows = patientList.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const patientData = rows[i].textContent.toLowerCase();
                if (patientData.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }