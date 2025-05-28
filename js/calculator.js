
// Dropdown Menu Selection
function changeOptions() {
    var selectBox = document.getElementById("find");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var secondOptionLabel = document.getElementById("second-option-label");
    
    if (selectedValue === "final-exam") {
        secondOptionLabel.textContent = "Desired Grade:";
    } else if (selectedValue === "final-class") {
        secondOptionLabel.textContent = "Final Exam Grade:";
    }
}

// Final Exam Grade Calculation
function calculateFinalExamGrade(currentGrade, desiredGrade, finalExamWeight) {
    finalExamWeight = finalExamWeight / 100; // Convert weight to decimal form
    var finalExamGrade = (desiredGrade - ((1 - finalExamWeight) * currentGrade)) / finalExamWeight;
    return "You need " + finalExamGrade.toFixed(2) + "% on the final exam to get " + desiredGrade.toFixed(2) + "% in the class.";
}

// Final Class Grade calculation
function calculateFinalClassGrade(currentGrade, finalExam, finalExamWeight) {
    finalExamWeight = finalExamWeight / 100; // Convert weight to decimal form
    var finalClassGrade = (finalExam * finalExamWeight) + ((1 - finalExamWeight) * currentGrade);
    return "Your final grade in the class is " + finalClassGrade.toFixed(2) + "%.";
}

// User Input Calculations and Answer Text
function calculateGrade() {
    var find = document.getElementById("find").value;
    var desiredGrade = parseFloat(document.getElementById("second-option").value);
    var currentGrade = parseFloat(document.getElementById("first-option").value);
	var finalExam = parseFloat(document.getElementById("second-option").value);
    var finalExamWeight = parseFloat(document.getElementById("third-option").value);

    var result;
    if (find === "final-exam") {
        result = calculateFinalExamGrade(currentGrade, desiredGrade, finalExamWeight);
    } else if (find === "final-class") {
        var finalExamGrade = parseFloat(document.getElementById("third-option").value);
        result = calculateFinalClassGrade(currentGrade, finalExam, finalExamWeight);
    }

    var answerBox = document.getElementById("answer-box");
    answerBox.placeholder = result;
}

// Clear All Fields
function clearFields() {
    document.getElementById("first-option").value = "";
    document.getElementById("second-option").value = "";
    document.getElementById("third-option").value = "";
    document.getElementById("answer-box").placeholder = "Answer: ";
}

// Event Listeners for Clear and Calculate
document.getElementById("calculate-button").addEventListener("click", calculateGrade);
document.getElementById("clear-button").addEventListener("click", clearFields);
