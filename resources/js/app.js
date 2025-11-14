import axios from 'axios';
import './bootstrap';

console.log("hello!");

export function store(event) {
    event.preventDefault()
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}


function success(position) {
    let formData = new FormData();

    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let description = document.getElementById('description').value;
    const field = document.getElementById('checkbox');
    const checkedBoxes = field.querySelectorAll('input[type="radio"]:checked')[0].value;
    const imageInput = document.getElementById('input').files[0];

    formData.append("name", name);
    formData.append("email", email);
    formData.append("description", description);
    formData.append("priority", checkedBoxes);
    formData.append("longitude", position.coords.longitude);
    formData.append("latitude", position.coords.latitude);
    formData.append("photo", imageInput);

    let response = axios.post('/complaint', formData);

    alert(response.data);

}

function error() {
  alert("Sorry, no position available.");
}

function log_in(event) {
    event.preventDefault()

    let formData = new FormData();

    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    formData.append('username', username);
    formData.append('password', password);

    let response = axios.post('/inloggen', formData)
        .then(function (res) {
            if (res && res.data && res.data.ok) {
                window.location.href = '/';
                return;
            }
            alert(JSON.stringify(res.data));
        })
        .catch(function (err) {
            let data = err && err.response ? err.response.data : { message: err.message };
            alert(JSON.stringify(data));
        });
}

window.log_in = log_in;
window.store = store;


