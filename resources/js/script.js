const container = document.getElementById('container');

const registerBtn = document.getElementById('register');

const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () =>
{
    container.classList.add("active");
})

loginBtn.addEventListener('click', () =>
{
    container.classList.remove("active");
})

function DropdownActive() {
    var dropdown = document.getElementById("Dropdown");
    var b = document.getElementById("down");
    var c = document.getElementById("up");

    dropdown.classList.toggle("active");

    if (dropdown.classList.contains("active")) {
        b.style.opacity = "0";
        c.style.opacity = "1";
    } else {
        b.style.opacity = "1";
        c.style.opacity = "0";
    }
    }

function OptionsActive() {
    var options = document.getElementById("Options");
    options.classList.toggle("active");
}

function showForm() {
    var floatingForm = document.getElementById("BckgForm");
    floatingForm.style.display = "block";
}

function closeForm() {
    var floatingForm = document.getElementById("BckgForm");
    floatingForm.style.display = "none";
}

function showTopics() {
    var floatingForm = document.getElementById("topics");
    if (floatingForm.style.display === "none") {
        floatingForm.style.display = "block";
    } else {
        floatingForm.style.display = "none";
    }
}
