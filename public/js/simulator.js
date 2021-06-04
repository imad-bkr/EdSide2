(function () {
    var addGradeForm = document.querySelector("#simulator-add-grade");
    var gradeTable = document.querySelector("#simulator-table");

    function validateForm(e) {
        e.preventDefault();
        try {
            let ue = addGradeForm.ue.value;
            let mod = addGradeForm.module.value;
            let coef = addGradeForm.coef.value;
            let grade = addGradeForm.grade.value;
            if (ue === "") {
                throw new Error("Invalid ue");
            }
            if (mod === "") {
                throw new Error("Invalid module");
            }
            if (coef === "" || Number.isNaN(coef)) {
                throw new Error("Invalid coef");
            }
            if (grade === "" || Number.isNaN(grade)) {
                throw new Error("Invalid grade");
            }
            addGrade(ue, mod, coef, grade);
            gradeTable.classList.remove("hidden");
        } catch (e) {
            console.log(e.message);
        }
    }

    function addGrade(ue, mod, coef, grade) {
        let newRow = document.createElement("tr");
        let newUe = document.createElement("td");
        let newModule = document.createElement("td");
        let newCoef = document.createElement("td");
        let newGrade = document.createElement("td");
        newUe.textContent = ue;
        newModule.textContent = mod;
        newCoef.textContent = coef;
        newGrade.textContent = grade;
        newRow.appendChild(newUe);
        newRow.appendChild(newModule);
        newRow.appendChild(newCoef);
        newRow.appendChild(newGrade);
        gradeTable.appendChild(newRow);
    }

    addGradeForm.addEventListener("submit", validateForm);
})();
