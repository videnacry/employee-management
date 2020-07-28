//------------------------------Contextmenu--------------------------------------//
const contextmenu = document.getElementById('contextmenu')
$(contextmenu).toggle()

document.getElementById('add-employee').addEventListener('click',addEmployee)
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
        saveEmployee(rowsSection[0].children[index].children, 'addEmployee')
    }
}
function saveEmployee(employeeCells, query){
    let employeeData = {}
    employeeData['query'] = query
    for(let index = 0; employeeCells.length > index+1; index++){
        let employeeInput = employeeCells[index].children[0]
        employeeData[employeeInput.dataset.column] = employeeInput.value
    }
    $.ajax({
        method:'POST',
        url:"library/employeeController.php",
        data:employeeData,
        success:function(response){
            employeesObject = JSON.parse(response)
        }
    })
}

//------------------------------------reload table---------------------------------------//
function reloadTable(page=0){

    let pageRows = employeesObject.slice(10*(page-1))
    let rowsQuantity = pageRows.length
    if(rowsQuantity > 10){
        rowsQuantity = 10
    }
    let rowsHTML
    rowsSection.html("")
            console.log(pageRows)
    for(index = 0; rowsQuantity>index; index++){
            rowsHTML += '<tr data-id="'+pageRows[index]+'">'
        let row = 0
        for(let i in pageRows[index]){
            if(row === 0){
                row++
                continue
            }
            rowsHTML += '<td class="user-select-all">'+pageRows[index][i]+'</td>'
        }
        rowsHTML += '<td><button data-id=' + pageRows[index].id + ' class="btn-block btn text-danger"><i class="fas fa-trash-alt"></i></button></td></tr>'
    }
    rowsHTML += '</tbody></table>'
    rowsSection.append(rowsHTML)
    addRowsEvent()
}

//----------------------------------pagination event--------------------------------------//
let page = 1
if(employeesObject.length > 10){
    $('#pagination-items a[data-number]').click(function(){
        event.preventDefault()
        console.log("a")
        reloadTable($(this).attr('data-number'))
    })
    $('#previous').click(function(){
        event.preventDefault()
        if(page > 1){
            page--
            reloadTable(page)
        }
    })
    $('#next').click(function(){
        event.preventDefault()
        if(page < employeesObject.length / 10){
            page++
            reloadTable(page)
        }
    })
}

//------------------------------------contextmenu----------------------------------------//
let employeeId
addRowsEvent()
function addRowsEvent(){
    $('table tr[data-id]').contextmenu(function(){
        event.preventDefault()
        employeeId = event.currentTarget.dataset.id
        $(contextmenu).css({
            display:'none',
            top:event.clientY + 'px',
            left:event.clientX + 'px'
        })
        $(contextmenu).fadeIn(200)
    })
}
$('body').click(function(){
    contextmenu.style.display = 'none'
})
$('#update-data').click(function(){
    location.href='employee.php?id=' + employeeId
})


