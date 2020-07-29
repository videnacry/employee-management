//------------------------------Contextmenu--------------------------------------//
const contextmenu = document.getElementById('contextmenu')
$(contextmenu).toggle()

document.getElementById('add-employee').addEventListener('click',addEmployee)
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

//--------------------------------save employee------------------------------------------//
document.getElementById("save").addEventListener("click",selectChanges)
function selectChanges(){
    const rows = rowsSection[0].children
    let newEmployees = []
    let employeeData = {}
    for(let index in newRows){
        for(let i = 0; rows[index].children.length > i+1; i++){
            let employeeInput = rows[index].children[i].children[0]
            employeeData[employeeInput.dataset.column] = employeeInput.value
        }
        newEmployees.push(Object.assign({},employeeData))
    }
    saveEmployee(newEmployees,'addEmployees')
}

function saveEmployee(employeesData, query){
    let queryData = {}
    queryData['query'] = query
    queryData['employees'] = employeesData
    $.ajax({
        method:'POST',
        url:"library/employeeController.php",
        data:queryData,
        success:function(response){
            employeesObject = JSON.parse(response)
            reloadTable(Math.ceil(employeesObject.length/10))
        }
    })
}

//-----------------------------------delete employee-------------------------------------//
deleteButtons()
function deleteButtons(){
    $('#employees-rows td .btn-block.btn.text-danger').click(deleteEmployee)
}
function deleteEmployee(id=false){
    id = (id)?id:$(this).attr('data-id')
    $.ajax({
        url:"library/employeeController.php?id="+id,
        method:"delete",
        success:function(response){
            employeesObject = JSON.parse(response)
            reloadTable()
        }
    })
}

//------------------------------------reload table---------------------------------------//
document.getElementById('reload').onclick = reloadTable
function reloadTable(page=0){

    let pageRows = employeesObject.slice(10*(page-1))
    let rowsQuantity = pageRows.length
    if(rowsQuantity > 10){
        rowsQuantity = 10
    }
    let rowsHTML
    rowsSection.html("")
    for(index = 0; rowsQuantity>index; index++){
            rowsHTML += '<tr data-id="'+pageRows[index].id+'">'
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
    if(employeesObject.length>0){
        deleteButtons()
        addRowsEvent()
        printPagination(employeesObject.length/10)
    }
}

//-------------------------------------reload pagination----------------------------------//
let page = 1
function printPagination($quantity){
    
    if(document.getElementById('pagination-items')){
        $(document.getElementById('pagination-items').parentElement).remove()
    }
    if($quantity>1){
        $quantity++;
        pagination = '<nav aria-label="table pages navigation"><ul id="pagination-items" class="pagination shadow"><li class="page-item">'+
            '<a id="previous" class="page-link bg-light" href="#" >Previous</a></li>';
        for($index = 1; $quantity > $index; $index++){
            pagination += '<li class="page-item"><a class="page-link bg-light" href="#" data-number="'+$index+'">' + $index + '</a></li>';
        }
        pagination += '<li id="next" class="page-item"><a class="page-link bg-light" href="#">Next</a></li></ul></nav>';
        $(document.getElementById('reload').parentElement).before(pagination)
        
        //----------------------------------pagination event--------------------------------------//
        if(employeesObject.length > 10){
            $('#pagination-items a[data-number]').click(function(){
                event.preventDefault()
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
    }
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
$('#create-data').click(function(){
    location.href='employee.php?id=new'
})
$('#delete-data').click(function(){
    deleteEmployee(employeeId)
})


