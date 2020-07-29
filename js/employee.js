const form = document.querySelector('#employeeForm')
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
const alertMsg = document.querySelector('#formErrMsg');
const avatar = document.querySelector('#profileImg');
const avatarCont = document.querySelector('#profilePicCont');
const avatarSel = document.querySelector('#profilePicSelect');

document.querySelector('#dashboardTitle').className = 'innactive';
document.querySelector('#employeeTitle').className = 'activated';

avatarCont.addEventListener('click', printProfilePics);

printEmployee(window.location.search);

function printEmployee(param) {
    if (param != '?id=new') {
        axios({
            method: 'GET',
            url: 'library/employeeController.php' + param,
        }).then(response => {
            name.value = response.data.name;
            surname.value = response.data.lastName;
            email.value = response.data.email;
            gender.value = response.data.gender;
            city.value = response.data.city;
            phone.value = response.data.phoneNumber;
            po.value = response.data.postalCode;
            state.value = response.data.state;
            address.value = response.data.streetAddress;
            age.value = response.data.age;

            if (response.data.img) {
                avatar.src = 'response.data.img';
                avatar.classList.remove('d-none')
            }
        });
    } else {
        form.reset();
    }
}

document.querySelector('#returnBtn').addEventListener('click', e => {
    e.preventDefault();
    window.location.href = '/src/dashboard.php';
});
document.querySelector('#submitForm').addEventListener('click', e => {
    e.preventDefault();

    if (checkInputs()) {

        let employee = new FormData(form);
        employee.name = name.value;
        employee.lastName = surname.value;
        employee.email = email.value;
        employee.gender = gender.value;
        employee.city = city.value;
        employee.phoneNumber = phone.value;
        employee.postalCode = po.value;
        employee.state = state.value;
        employee.streetAddress = address.value;
        employee.age = age.value;
        axios({
            method: 'post',
            url: 'library/employeeController.php' + window.location.search,
            data: {
                employee
            }
        }).then(response => {
            console.log(response.data)
            if (response.status === 200) {
                alertMsg.textContent = ((response.data === 'modified') ? 'All changes applied! ' : `New employee created (id ${response.data}). `) + 'Redirecting to main page...';
                alertMsg.classList.remove('alert-danger');
                alertMsg.classList.add('alert-success');
                alertMsg.classList.replace('d-none', 'd-flex');
                setTimeout(() => {
                    window.location.href = '/src/dashboard.php'
                    alertMsg.classList.replace('d-flex', 'd-none');
                    alertMsg.classList.remove('alert-success');
                }, 3000);
            } else {
                alertMsg.textContent = 'Oops, error ' + response.status + '. Please, try again later.'
                alertMsg.classList.add('alert-danger');
                alertMsg.classList.replace('d-none', 'd-flex');
            }
        });
    } else {
        alertMsg.textContent = 'Please, correct the highlighted errors.'
        alertMsg.classList.add('alert-danger');
        alertMsg.classList.replace('d-none', 'd-flex');
    };
});

function checkInputs() {
    let checkName = false;
    let checkSurname = false;
    let checkAge = false;
    let checkCity = false;
    let checkEmail = false;
    // let checkGender = false;
    let checkPhone = false;
    let checkPo = false;
    let checkState = false;
    let checkAddress = false;

    if (name.value.match(/^[ A-zÀ-ÿ-]+$/gm)) {
        checkName = true;
        name.classList.remove('form-error');
    } else {
        name.classList.add('form-error');
    }
    if (surname.value.match(/^[ A-zÀ-ÿ-]+$/gm)) {
        checkSurname = true;
        surname.classList.remove('form-error');
    } else {
        surname.classList.add('form-error');
    }
    if (age.value.match(/^[0-9]+$/gm)) {
        checkAge = true;
        age.classList.remove('form-error');
    } else {
        age.classList.add('form-error');
    }
    if (city.value.match(/^[ A-zÀ-ÿ-]+$/gm)) {
        checkCity = true;
        city.classList.remove('form-error');
    } else {
        city.classList.add('form-error');
    }
    if (email.value.match(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/gm)) {
        checkEmail = true;
        email.classList.remove('form-error');
    } else {
        email.classList.add('form-error');
    }
    if (address.value.match(/^\s*\S+(?:\s+\S+)/gm)) {
        checkAddress = true;
        address.classList.remove('form-error');
    } else {
        address.classList.add('form-error');
    }
    if (phone.value.match(/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/gm)) {
        checkPhone = true;
        phone.classList.remove('form-error');
    } else {
        phone.classList.add('form-error');
    }
    if (po.value.match(/^[0-9]+$/gm)) {
        checkPo = true;
        po.classList.remove('form-error');
    } else {
        po.classList.add('form-error');
    }
    if (state.value.match(/^[ A-zÀ-ÿ-]+$/gm)) {
        checkState = true;
        state.classList.remove('form-error');
    } else {
        state.classList.add('form-error');
    }

    if (checkName && checkAddress && checkSurname && checkAge && checkCity && checkEmail && checkPhone && checkPo && checkState) {
        return true;
    } else {
        return false;
    }
}

async function printProfilePics() {
    /* <div class="profile__img d-flex justify-content-center align-items-center mx-2 mb-2">
        <img src="" alt="profile picture" id="profileImg" class="d-none">
    </div> */
    let limit = (avatar.src === '') ? '4' : '5';
    let genderVal = (gender.value === 'man') ? 'male' : 'female';

    if (gender.value && age.value) {
        var config = {
            method: 'get',
            url: 'https://uifaces.co/api',
            headers: { 
                'X-API-KEY': '4B25747F-51664BE8-97A405EA-4437BFA2'
            },
          };
          
        const request = await axios(config);

        console.log(request, 'request');

        // axios({
        //     method: 'get',
        //     // url: `https://uifaces.co/api?limit=${limit}&gender[]=${genderVal}`,
        //     url: `https://uifaces.co/api`,
        //     headers:{
        //         'X-API-KEY' : '4B25747F-51664BE8-97A405EA-4437BFA2',
        //         'Accept': 'application/json',
        //         'Cache-Control': 'no-cache',
        //     },
        // }).then(response=>{
        //     console.log(response)
        // })
        // fetch('https://uifaces.co/api', {
        //     method: 'GET',
        //     headers: {
        //     'X-API-KEY': '4B25747F-51664BE8-97A405EA-4437BFA2',
        //     // 'Accept': 'application/json',
        //     // 'Cache-Control': 'no-cache'
        //     },
        // }).then(response=>{
        //     console.log(response)
        // })
    } else {
        console.log('Please, define age and gender')
    }
    // avatarCont.classList.replace('d-flex', 'd-none');
    // avatarSel.classList.replace('d-none', 'd-flex');
}