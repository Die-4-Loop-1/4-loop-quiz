

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
// document.addEventListener('DOMContentLoaded', function() {
//     const timerInterval = setInterval(updateTimer, 1000);
// });


//Wiki von Andreas
setTimeout(function() {
    // erstelle einen foreach loop über das array
    for (const key in urls){

    // erstelle pro url, einen Anchor Tag
    var link = document.createElement("a");

    // füge diesem anchor tag das href Attribut hinzu
    link.href = urls[key];

    // füge dem Anchor Tag ein Label (Text) hinzu
    link.innerHTML = '<div class="question-icon"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M240-80v-172q-57-52-88.5-121.5T120-520q0-150 105-255t255-105q125 0 221.5 73.5T827-615l52 205q5 19-7 34.5T840-360h-80v120q0 33-23.5 56.5T680-160h-80v80h-80v-160h160v-200h108l-38-155q-23-91-98-148t-172-57q-116 0-198 81t-82 197q0 60 24.5 114t69.5 96l26 24v208h-80Zm254-360Zm-14 120q17 0 28.5-11.5T520-360q0-17-11.5-28.5T480-400q-17 0-28.5 11.5T440-360q0 17 11.5 28.5T480-320Zm-30-128h61q0-25 6.5-40.5T544-526q18-20 35-40.5t17-53.5q0-42-32.5-71T483-720q-40 0-72.5 23T365-637l55 23q7-22 24.5-35.5T483-663q22 0 36.5 12t14.5 31q0 21-12.5 37.5T492-549q-20 21-31 42t-11 59Z"/></svg></div>';
    // Füge den Anchor Tag eine Klasse hinzu, die Du dann im CSS stylen kannst
    link.classList.add("custom-link");

    // Füge target atribut mit dem wert _blank hinzu.
    link.target = "_blank";

    // speichere den gewünschten div Container in einer variabel (getElementById, o.Ä.)
    var idContainer = document.querySelector('input[value="' + key + '"]');

    // wähle das obere div an
    let urlContainer = idContainer.parentElement;

    // füge die erstellen Anchor Tags in den Container ein
    urlContainer.appendChild(link);
}
}, 6500);


