let time = 10;

function updateTimer() {
    let timerElement = document.getElementById('timer');

    if (timerElement) {
        timerElement.innerText = time;

        if (time > 0) {
            time--;
        } else {
            // alert('Zeit abgelaufen!');
            clearInterval(timerInterval);

            // Hier das Formular automatisch abschicken
            // submitForm();
        }
    } else {
        console.error('Timer-Element nicht gefunden!');
        clearInterval(timerInterval);
    }
}

function submitForm() {
    // Hier den Code einfügen, um das Formular automatisch abzuschicken
    document.forms[0].submit(); // Anpassen, wenn mehrere Formulare auf der Seite vorhanden sind
}

const timerInterval = setInterval(updateTimer, 1000);
document.addEventListener('DOMContentLoaded', function() {
    const timerInterval = setInterval(updateTimer, 1000);
});

