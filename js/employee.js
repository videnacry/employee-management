const name = document.querySelector('#nameInp');
const surname = document.querySelector('#surnameInp');
const email = document.querySelector('#emailInp');
const gender = document.querySelector('#genderInp');
const city = document.querySelector('#cityInp');
const address = document.querySelector('#addressInp');
const state = document.querySelector('#stateInp');
const age = document.querySelector('#ageInp');
const po = document.querySelector('#poInp');
const phone = document.querySelector('#phoneInp');

printEmployee(window.location.search);

function printEmployee(param){
    axios({
        method: 'get',
        url: 'library/employeeController.php' + param,
        // responseType: 'stream'
    }).then(response=>{
        console.log(response.data);
        name.value = response.data.name
        surname.value = response.data.lastName
        email.value = response.data.email
        gender.value = response.data.gender
        city.value = response.data.city
        phone.value = response.data.phoneNumber
        po.value = response.data.postalCode
        state.value = response.data.state
        address.value = response.data.streetAddress
        age.value = response.data.age
    });
}

document.querySelector('#submitForm').addEventListener('click', e=>{
    e.preventDefault();
    axios({
        method: 'get',
        url: 'library/employeeController.php' + window.location.search,
        // responseType: 'stream'
    }).then(response=>{
        console.log(response.data)
    });
});