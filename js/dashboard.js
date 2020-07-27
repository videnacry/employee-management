// document.getElementById('add-employee').addEventListener('click',addEmployee)
let newRows = []
let updateRows = []
const rowsSection = $('#employees-rows') 
function addEmployee(){
    newRows.push("a")
    const columns = document.getElementById('employees-columns').firstChild.children
    let inputs = "<tr>"
    for(let index = 0; columns.length-1 > index; index++){
        let column = columns[index].dataset.column
        inputs += '<td><input class="form-control" type="text" data-column="' + column  + 
        '" placeholder="' + column + '" /></td>'
    }
    inputs += '<td><button class="btn btn-block text-warning" onclick="cancelNew()"><i class="fas fa-window-close"></i></button></td>'
    inputs += '</tr>'
    rowsSection.prepend(inputs)
}
function cancelNew(){
    newRows.pop()
    event.currentTarget.parentElement.parentElement.remove()
}
// document.getElementById("save").addEventListener("click",selectChanges)
function selectChanges(){
    const rows = rowsSection[0].children
    for(let index in newRows){
        saveEmployee(rowsSection[0].children[index].children, true)
    }
}
function saveEmployee(employeeCells, newEmployee = false){
    let employeeData = {}
    employeeData['new'] = newEmployee
    for(let index = 0; employeeCells.length > index+1; index++){
        let employeeInput = employeeCells[index].children[0]
        employeeData[employeeInput.placeholder] = employeeInput.value
    }
    $.ajax({
        method:'POST',
        url:"library/employeeController.php",
        data:employeeData,
        success:function(response){
            console.log(employeeData)
        }
    })
}