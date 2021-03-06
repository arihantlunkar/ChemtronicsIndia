<template id="loginForm">
    <div class="card mx-auto my-auto" :class="{loadingDiv:sending}">
        <div class="card-header">
            <a href="https://www.chemtronicsindia.com/" target="_blank"><img src="./assets/img/chemtronics-logo.gif" width="250"/></a>
        </div>
        <div class="card-body">
            <form method="post" id="loginForm" @submit.prevent="validateForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="email" class="form-control" id="username" placeholder="username@domain.com" @input="inputChanged('Username')" v-model="formData.username">
                    <template v-if="errorMsg.Username!==''">
                        <div class="error mt-2">{{errorMsg.Username}}</div>
                    </template>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" @input="inputChanged('Password')" v-model="formData.password">
                    <template v-if="errorMsg.Password!==''">
                        <div class="error mt-2">{{errorMsg.Password}}</div>
                    </template>
                </div>
                <div class="form-group mt-4 text-center">
                    <template v-if="error!==''">
                        <div class="error mb-2">{{error}}</div>
                    </template>
                    <button type="submit" class="btn btn-primary btn-block" name="submit" @keyup.enter="validateForm" >Sign In</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="font-weight-semibold footer-text" @click="changeTemp('register')">If you are not a member, <span>Please Register.</span></div>
        </div>
    </div>
</template>
<script>
    var loginForm = Vue.component('loginForm', {
        template: '#loginForm',
        data: function () {
            return {
                sending:false,
                formData:{
                    username:'',
                    password:''
                },
                error:'',
                errorMsg:{
                    Username:'',
                    Password:'',
                }
            }
        },
        computed: {
            
        },
        methods:{
            inputChanged:function(v){
                let $this = this
                this.error = ''
                if(v=='Username'){
                    if (this.formData.username && $this.validateEmail(this.formData.username)[1] == 1){
                        $this.errorMsg[v] =  $this.validateEmail(this.formData.username)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='Password'){
                    if (this.formData.password && $this.validatePassword(this.formData.password)[1] == 1){
                        $this.errorMsg[v] =  $this.validatePassword(this.formData.password)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }
            },
            validateEmail:function(email, optional)
			{
				var emailReg =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(email == "" && optional == 1)
				{
					return [" ",0];
				}
				if(email == '')
				{
					return ["Email cannot be blank",1];
				}
				else if(email.length > 40)
				{
					return ["Email cannot exceed 40 characters",1];
				}
				else if(email.length < 6)
				{
					return ["Email cannot be less than 6 characters",1];
				}
				else if(!emailReg.test(email))
				{
					return ["Not a valid email address",1];
				}
				else
				{
					return [" ",0];
                }
			},
			validatePassword:function(password, optional)
			{
				if(password == "" && optional == 1)
				{
					return [" ",0];
				}
				if(password == '')
				{
					return ["Password cannot be blank",1];
				}
				else if(password.length > 40)
				{
					return ["Password cannot exceed 40 characters",1];
				}
				else if(password.length < 4)
				{
					return ["Password cannot be less than 4 characters",1];
				}
				else
				{
					return [" ",0];
				}
			},
            validateForm:function(){
                let $this = this
                if(this.formData.username && this.formData.password){
                    if(this.errorMsg.Username === '' &&  this.errorMsg.Password === ''){
                        this.error = ''
                        this.submitForm()
                    }else{
                        this.error = 'Please resolve validation errors.'
                    }
                }else if(this.formData.username === ''){
                    this.error = 'Username is required.'
                }else if(this.formData.password === ''){
                    this.error = 'Password is required.'
                }else{
                    this.error = 'Please resolve validation errors.'
                }                
            },
            submitForm:function(){
                let $this = this
                $this.sending = true
                var session_url = 'includes/SessionController.php?session=login';
                axios.post(session_url, {
					username: $this.formData.username,
					password: $this.formData.password
                }).then(function(response) {
                    $this.sending = false
                    $this.error = response.data;
					if($this.error === "")
					{
						window.location.href = 'home.php#ajax/dashboard.php';
					}
                }).catch(function(error) {
                    console.log(error);
                });	
            },
            changeTemp:function(v){
                this.$root.currentTemplate = v
            }
        },
        mounted() {     
        },
        created(){
            
        }  
    })
</script>