<template id="usersInfo">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="userInfo" class="table table-striped table-bordered" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var usersInfo = Vue.component('usersInfo', {
        template: '#usersInfo',
        data: function () {
            return {
            };  
        },
        methods:{
            createDatables:function(){
                var $this = this;
                // var dataSet = [
                //     [ "Vivek", "Lunkar", "vivek.lunkar@grandcanals.com", "+91", "8097124907", "Engg" ],
                //     [ "Arihant", "Lunkar", "arihant-cse15@snu.edu.in", "+91", "9560810245", "Architect" ],
                // ];
                $('#userInfo').DataTable({
                    "ajax" : {
                        "url": '',
                        "data": function(json){                                
                            return json;
                        }
                    },                    
                    columns: [
                        { "title":'First Name'},
                        { "title":'Last Name'},
                        { "title":'Email'},
                        { "title":'Country Code'},
                        { "title":'Mobile Number'},
                        { "title":'User Profile'},
                    ]
                })
            }
        },
        mounted(){
            var $this = this
            $this.createDatables()   
        },
        created(){
        }  
    })
</script>