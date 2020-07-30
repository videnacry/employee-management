
    $('#jsGrid').jsGrid(
        {
            width:'100%',
            inserting: true,
            editing: true,
            autoload: true,
            paging:true,
            pagesize: 10,
            pageButtonCount: 5,
            deleteConfirm: 'Sure to erase that?',
            noDataContent: 'Couldn\'t be found the information or just fill the table',
            controller:{
                insertItem : function(data){
                    data.query='addUser'
                    let xhr
                    $.ajax({
                        async:false,
                        url:'library/loginController.php',
                        method:'POST',
                        data:data,
                        success:function(response,statusText,jqXHR){
                            xhr = JSON.parse(response).users
                        }
                    })
                    return xhr
                },
                loadData : function(){
                    let xhr
                    $.ajax({
                        async:false,
                        url:'library/loginController.php',
                        method:'POST',
                        data:{
                            query:'getUsers'
                        },
                        success:function(response,statusText,jqXHR){
                            xhr = JSON.parse(response).users
                        }
                    })
                    return xhr
                },
                deleteItem : function(data){
                    console.log(data)
                    $.post('library/loginController.php',{query:'deleteUser',id:data.userId},function(response){
                        
                    })
                }
            },
            fields:[
                { name:'userId', title:'userId', visible:false, type:'hidden', width:0 },
                { name:'name', title:'name', type:'text', width:100 },
                //{ name:'lastName', title:'lastName', type:'text', width:100 },
                { name:'email', title:'email', type:'text', width:200 },
                { name:'password', title:'password', type:'text', width:300 },
                /*{ name:'gender', title:'gender', type:'text', width:100 },
                { name:'city', title:'city', type:'text', width:100 },
                { name:'streetAddress', title:'streetAddress', type:'text', width:100 },
                { name:'state', title:'state', type:'text', width:100 },
                { name:'age', title:'age', type:'text', width:100 },
                { name:'postalCode', title:'postalCode', type:'text', width:100 },
                { name:'phoneNumber', title:'phoneNumber', type:'text', width:100 },*/
                { type:'control', editButton:true, width:50 }
            ]
        }
    )