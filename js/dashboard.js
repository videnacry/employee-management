document.getElementById('add-employee').addEventListener('click',addEmployee)
function addEmployee(){
    const columns = document.getElementById('employees-columns').firstChild.children
    const rows = $('#employees-rows') 
    let inputs = "<tr>"
    for(let index = 0; columns.length-1 > index; index++){
        inputs += '<td><input class="form-control" type="text" data-column="' + columns[index].dataset.column  + 
        '" placeholder="' + columns[index].textContent + '" /></td>'
    }
    inputs += '<td><button class="btn btn-block text-warning"><i class="fas fa-window-close"></i></button></td>'
    inputs += '</tr>'
    console.log(inputs)
    rows.prepend(inputs)
}