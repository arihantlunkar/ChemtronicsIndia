<?php
    if (session_status() == PHP_SESSION_NONE) 
    {
        session_start();
    }
?>
<template id="registeredUser">
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
    var registeredUser = Vue.component('registeredUser', {
        template: '#registeredUser',
        data: function () {
            return {
                isAdmin:''
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
            var $this = this
            $this.isAdmin = "<?php echo $_SESSION['isAdmin']; ?>";
            if($this.isAdmin === "0")
            {
                window.location.href = 'home.php#ajax/dashboard.php';
            }             
        }  
    })
</script>