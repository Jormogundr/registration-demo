// on successful document load
document.addEventListener("DOMContentLoaded", () => {
    let choice = confirm("A seat has already been registered for this UMID. Click OK to update registration.");
    // prompt user for overwrite, redirect if they do not want to update record
    if (choice) {
        document.cookie = "formResubmission = true";
    }
    else {
        document.cookie = "formResubmission = false";
    }
    window.location.replace("index.php");
});