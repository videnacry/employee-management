
    $('#jsGrid').jsGrid(
        {
            width:'100%',
            filtering: true,
            inserting: true,
            editing: true,
            autoload: true,
            paging:true,
            pagesize: 10,
            pageButtonCount: 5,
            deleteConfirm: 'Sure to erase that?',
            controller:{
                insertItem : function(data){
                    return 
                },
                loadData : function(){
                    return 
                },
                deleteItem : function(data){
                    return 
                }
            },
            fields:[
                { name:'userId', title:'userId', visible:false, type:'hidden', width:0 },
                { name:'name', title:'name', type:'text', width:100 },
                //{ name:'lastName', title:'lastName', type:'text', width:100 },
                { name:'email', title:'email', type:'text', width:200 },
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