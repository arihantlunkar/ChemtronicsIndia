<template id="usersInfo">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="userInfo" class="table table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>First name</th>
									<th>Last name</th>
									<th>Email</th>
									<th>Country Code</th>
									<th>Mobile Number</th>
									<th>User Profile</th>
								</tr>
							</thead>
						</table>
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
                $('#userInfo').DataTable({
                    "processing": true,
					"serverSide": false,
					"ajax": "includes/UsersInfoController.php",                    
                    "columns": [
						{ "data": "firstName" },
						{ "data": "lastName" },
                        { "data": "email" },
						{ "data": "countryCode" },
						{ "data": "mobileNumber" },
						{ "data": "endUser" },
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