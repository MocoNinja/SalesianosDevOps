window.addEventListener('load', function () {
  ensureClean();
  addEventListeners();
});

function addEventListeners() {
  // Ayuda
  document.getElementById('ayudaClick').addEventListener('mouseenter', toggleHelpVisible);
  document.getElementById('ayudaClick').addEventListener('mouseleave', toggleHelpVisible);
  // Dias
  [].forEach.call(document.getElementsByClassName('dias'), e => e.addEventListener('click', toggleDayInput));
  // Horas
  [].forEach.call(document.getElementsByClassName('fechas'), e => e.addEventListener('blur', checkValidTime));
}

function ensureClean() {
    // Dias
    [].forEach.call(document.getElementsByClassName('dias'), e => e.checked = false);
    // Horas
    [].forEach.call(document.getElementsByClassName('fechas'), e => e.value = "");
}

function toggleHelpVisible() {
  let elemento = document.getElementById('ayuda');
  let visible = elemento.style.display === "block";
  if (!visible) {
    elemento.style.display = "block";
  } else {
    elemento.style.display = "none";
  }
}

function toggleDayInput(event) {
  [].forEach.call(document.getElementsByClassName('fechas'), function (elemento) {
    if (elemento.id == event.target.id) {
      let visible = elemento.style.display === "inline-block";
      if (!visible) {
        elemento.style.display = "inline-block";
        elemento.value = "";
      } else {
        elemento.style.display = "none";
      }
    }
  });
  allowSubmit();
}

function allowSubmit() {
  let allow = true;
  // Exception rise needed because of lack of breaks in a foreach
  try {
    [].forEach.call(document.getElementsByClassName('dias'), function(dia) {
      if (dia.checked) {
        [].forEach.call(document.getElementsByClassName('fechas'), function(horario) {
          if (dia.id == horario.id) {
            // allow = horario.id != "";
            allow = isInputDateCorrect(horario);
          }
          if (!allow) {
            throw "Incorrect!";
          }
        });
      }
    });
  } catch (err) {
    allow = false;
    console.log("Some input is invalid!");
  }
  document.getElementById('enviar').style.display = (allow) ? "block" : "none";
  console.log("Correct: " + allow);
  return allow;
}

function checkValidTime(event) {
  let valid = isInputDateCorrect(event.target);
  if (valid) {
    event.target.classList.add("valid");
  } else {
    event.target.classList.remove("valid");
  }
  allowSubmit();
}

// Utility functions
function isTimeCoherent(times) {
  let coherent = true;
  try {
    let hour1 = times[0].split(':')[0];
    let minute1 = times[0].split(':')[1];
    let hour2 = times[1].split(':')[0];
    let minute2 = times[1].split(':')[1];
    if ((hour1 > hour2) || (hour1 == hour2 && minute1 >= minute2)) coherent = false;
  } catch (err) {
    console.log("error: " + err);
    coherent = false;
  }
  console.log("Coherent: " + coherent);
  return coherent;
}

function hasValidPattern(date) {
  console.log("Date: " + date);
  let validPattern = /^(([0-1][0-9])|([2][0-3])):([0-5][0-9])-(([0-1][0-9])|([2][0-3])):([0-5][0-9])$/; // HH:MM
  let valid = validPattern.test(date);
  console.log("Pattern valid: " + valid);
  return valid;
}

function isInputDateCorrect(input) {
  let entered = input.value;
  let dates = entered.split(';');
  let correct = true;
  for (let current = 0; current < dates.length; current++) {
    console.log("Checking time #" + (parseInt(current) + 1));
    let correctPattern = hasValidPattern(dates[current]);
    let coherentTime = isTimeCoherent(dates[current].split("-"));
    correct = correctPattern && coherentTime;
    if (!correct) {
      console.log("Time #" + (parseInt(current) + 1) + " has already failed the test!");
    }
  }
  return correct;
}
