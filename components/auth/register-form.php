<template id="registerForm">
    <div class="card mx-auto my-auto extra-width" :class="{loadingDiv:sending}">
        <div class="card-header">
            <a href="https://www.chemtronicsindia.com/" target="_blank"><img src="./assets/img/chemtronics-logo.gif" width="250"/></a>
        </div>
        <div class="card-body">
            <form method="post" id="registerForm" @submit.prevent="validateForm">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="firstname">First Name *</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" @input="inputChanged('firstname')" v-model="formData.firstname">
                            <template v-if="errorMsg.firstname!==''">
                                <div class="error mt-2">{{errorMsg.firstname}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="lastname">Last Name *</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" @input="inputChanged('lastname')" v-model="formData.lastname">
                            <template v-if="errorMsg.lastname!==''">
                                <div class="error mt-2">{{errorMsg.lastname}}</div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="username@domain.com" @input="inputChanged('email')" v-model="formData.email">
                            <template v-if="errorMsg.email!==''">
                                <div class="error mt-2">{{errorMsg.email}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4 pr-0">
                                <div class="form-group">
                                    <label for="countryCode">Code</label>
                                    <select class="form-control selectpicker" id="countryCode" v-model="formData.cc" data-live-search="true">
                                        <option :value="cc" v-for="cc in countryCode" >{{cc}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="mobile">Mobile *</label>
                                    <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Mobile Number" @input="inputChanged('mobile')" v-model="formData.mobile">
                                    <template v-if="errorMsg.mobile!==''">
                                        <div class="error mt-2">{{errorMsg.mobile}}</div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" @input="inputChanged('password')" v-model="formData.password">
                            <template v-if="errorMsg.password!==''">
                                <div class="error mt-2">{{errorMsg.password}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cPassword">Confirm Password *</label>
                            <input type="password" class="form-control" id="cPassword" placeholder="Password" @input="inputChanged('cPassword')" v-model="formData.cPassword">
                            <template v-if="errorMsg.cPassword!==''">
                                <div class="error mt-2">{{errorMsg.cPassword}}</div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="userProfile">User Profile </label>
                            <select class="form-control selectpicker" id="userProfile" v-model="formData.userProfile">
                                <option :value="up.text" v-for="up in userProfile" >{{up.text}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" v-if="formData.userProfile.includes('Other')">
                            <label for="oUserProfile">Other User Profile *</label>
                            <input type="text" class="form-control" id="oUserProfile" placeholder="Other Profile" @input="inputChanged('oUserProfile')" v-model="formData.oUserProfile">
                            <template v-if="errorMsg.oUserProfile!==''">
                                <div class="error mt-2">{{errorMsg.oUserProfile}}</div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4 text-center">
                    <template v-if="error!==''">
                        <div class="error mb-2">{{error}}</div>
                    </template>
                    <button type="submit" class="btn btn-primary" name="submit" @keyup.enter="validateForm" >Register Now</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <div class="font-weight-semibold footer-text" @click="changeTemp('login')">Already a member, <span>Please Login.</span></div>
        </div>
    </div>
</template>
<script>
    var registerForm = Vue.component('registerForm', {
        template: '#registerForm',
        data: function () {
            return {
                sending:false,
                formData:{
                    firstname:'',
                    lastname:'',
                    email:'',
                    mobile:'',
                    cc:'+91',
                    password:'',
                    cPassword:'',
                    userProfile:'End User',
                    oUserProfile:''
                },
                error:'',
                errorMsg:{
                    firstname:'',
                    lastname:'',
                    email:'',
                    mobile:'',
                    Password:'',
                    cPassword:'',
                    oUserProfile:''
                },
                countryCode:['+1','+7','+20','+27','+30','+31','+32','+33','+34','+36','+39','+40','+41','+43','+44','+45','+46','+47','+48','+49','+51','+52','+53','+54','+55','+56','+57','+58','+60','+61','+62','+63','+64','+65','+66','+81','+82','+84','+86','+90','+91','+92','+93','+94','+95','+98','+211','+212','+213','+216','+218','+220','+221','+222','+223','+224','+225','+226','+227','+228','+229','+230','+231','+232','+233','+234','+235','+236','+237','+238','+239','+240','+241','+242','+243','+244','+245','+246','+247','+248','+249','+250','+251','+252','+253','+254','+255','+256','+257','+258','+260','+261','+262','+263','+264','+265','+266','+267','+268','+269','+290','+291','+297','+298','+299','+350','+351','+352','+353','+354','+355','+356','+357','+358','+359','+370','+371','+372','+373','+374','+375','+376','+377','+378','+380','+381','+382','+383','+385','+386','+387','+389','+420','+421','+423','+500','+501','+502','+503','+504','+505','+506','+507','+508','+509','+590','+591','+592','+593','+594','+595','+596','+597','+598','+599','+670','+672','+673','+674','+675','+676','+677','+678','+679','+680','+681','+682','+683','+685','+686','+687','+688','+689','+690','+691','+692','+850','+852','+853','+855','+856','+880','+886','+960','+961','+962','+963','+964','+965','+966','+967','+968','+970','+971','+972','+973','+974','+975','+976','+977','+992','+993','+994','+995','+996','+998'],
                userProfile:[
                    {
                        id:'endUser',
                        text:'End User'
                    },
                    {
                        id:'mepConsultant',
                        text:'M E P Consultant'
                    },
                    {
                        id:'architect',
                        text:'Architect'
                    },
                    {
                        id:'hvacContractor',
                        text:'HVAC Contractor'
                    },
                    {
                        id:'oem',
                        text:'O E M'
                    },
                    {
                        id:'channelPartner',
                        text:'Channel Partner'
                    },
                    {
                        id:'bmsAgency',
                        text:'B M S Agency'
                    },
                    {
                        id:'students',
                        text:'Students'
                    },
                    {
                        id:'other',
                        text:'Other'
                    }
                ]
            }
        },
        computed: {
            
        },
        methods:{
            inputChanged:function(v){
                let $this = this
                this.error = ''
                if(v=='firstname'){
                    if (this.formData.firstname && $this.validateFirstName(this.formData.firstname)[1] == 1){
                        $this.errorMsg[v] =  $this.validateFirstName(this.formData.firstname)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='lastname'){
                    if (this.formData.lastname && $this.validateLastName(this.formData.lastname)[1] == 1){
                        $this.errorMsg[v] =  $this.validateLastName(this.formData.lastname)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='email'){
                    if (this.formData.email && $this.validateEmail(this.formData.email)[1] == 1){
                        $this.errorMsg[v] =  $this.validateEmail(this.formData.email)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='mobile'){
                    if (this.formData.mobile && $this.validateMobile(this.formData.mobile)[1] == 1){
                        $this.errorMsg[v] =  $this.validateMobile(this.formData.mobile)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='password'){
                    if (this.formData.password && $this.validatePassword(this.formData.password)[1] == 1){
                        $this.errorMsg[v] =  $this.validatePassword(this.formData.password)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='cPassword'){
                    if (this.formData.cPassword && $this.validateCPassword(this.formData.cPassword)[1] == 1){
                        $this.errorMsg[v] =  $this.validateCPassword(this.formData.cPassword)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }else if(v=='oUserProfile'){
                    if (this.formData.oUserProfile && $this.validateOUserProfile(this.formData.oUserProfile)[1] == 1){
                        $this.errorMsg[v] =  $this.validateOUserProfile(this.formData.oUserProfile)[0]
                    }else{
                        $this.errorMsg[v] =  ''
                    }
                }
            },
            validateFirstName:function(firstname, optional)
			{
				var firstnameReg =  /^[A-Za-z]+$/;
				if(firstname == "" && optional == 1)
				{
					return [" ",0];
				}
				if(firstname == '')
				{
					return ["First name cannot be blank",1];
				}
				else if(firstname.length > 30)
				{
					return ["First name cannot exceed 30 characters", 1];
				}
				else if(firstname.length < 2)
				{
					return ["First name cannot be less than 2 characters",1];
				}
				else if(!firstnameReg.test(firstname))
				{
					return ["Not a valid first name",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateLastName:function(lastname, optional)
			{
				var lastnameReg =  /^[A-Za-z]+$/;
				if(lastname == "" && optional == 1)
				{
					return [" ",0];
				}
				if(lastname == '')
				{
					return ["Last name cannot be blank",1];
				}
				else if(lastname.length > 30)
				{
					return ["Last name cannot exceed 30 characters", 1];
				}
				else if(lastname.length < 2)
				{
					return ["Last name cannot be less than 2 characters",1];
				}
				else if(!lastnameReg.test(lastname))
				{
					return ["Not a valid last name",1];
				}
				else
				{
					return [" ",0];
                }
			},
            validateEmail:function(email, optional)
			{
                var emailReg =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var avoidFreeEmail =  /^([\w-\.]+@(?!hotmail)(?!gmail)(?!ymail)(?!googlemail)(?!live)(?!gmx)(?!yahoo)(?!outlook)(?!msn)(?!icloud)(?!facebook)(?!aol)(?!zoho)(?!mail)(?!yandex)(?!hushmail)(?!lycox)(?!lycosmail)(?!inbox)(?!myway)(?!aim)(?!fastmail)(?!goowy)(?!juno)(?!shortmail)(?!atmail)(?!protonmail)([\w-]+\.)+[\w-]{2,4})?$/;
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
                else if(!avoidFreeEmail.test(email.toLowerCase()))
				{
					return ["Only company email address allowed",1];
				}
				else
				{
					return [" ",0];
                }
			},
            validateMobile:function(mobile, optional)
			{
                var mobileIndRegx = /^(7|8|9)([0-9]{9})$/g
                var $this = this
				if(mobile == "" && optional == 1)
				{
					return [" ",0];
				}
				if(mobile == '')
				{
					return ["Mobile number cannot be blank",1];
				}
				else if(mobile.length > 12)
				{
					return ["Mobile number cannot exceed 12 digits", 1];
				}
				else if(mobile.length < 5)
				{
					return ["Mobile number cannot be less than 7 digits",1];
                }
                else if($this.formData.cc == '+91')
				{
                    if(!mobileIndRegx.test(mobile)){
                        return ["Invalid mobile number for indian region, 10 digits require",1];
                    }
                    else
                    {
                        return [" ",0];
                    }
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
				else if(password.length > 20)
				{
					return ["Password cannot exceed 20 characters",1];
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
            validateCPassword:function(cPassword, optional){
                var $this = this
                if(cPassword == "" && optional == 1)
				{
					return [" ",0];
				}
				if(cPassword == '')
				{
					return ["Password cannot be blank", 1];
                }
                else if(cPassword.length > 20)
				{
					return ["Password cannot exceed 20 characters",1];
				}
				else if(cPassword.length < 4)
				{
					return ["Password cannot be less than 4 characters",1];
				}
                else{
					return [" ",0];
				}
            },
            validateOUserProfile:function(oUserProfile, optional){
                var oUserProfileReg =  /^[A-Za-z\s]+$/;
				if(oUserProfile == "" && optional == 1)
				{
					return [" ",0];
				}
				if(oUserProfile == '')
				{
					return ["Other user profile field cannot be blank",1];
				}
				else if(oUserProfile.length > 30)
				{
					return ["Other user profile cannot exceed 30 characters", 1];
				}
				else if(oUserProfile.length < 2)
				{
					return ["Other user profile cannot be less than 2 characters",1];
				}
				else if(!oUserProfileReg.test(oUserProfile))
				{
					return ["Not a valid user profile",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateForm:function(){
                let $this = this
                if($this.formData.firstname && $this.formData.lastname && $this.formData.email && $this.formData.mobile && $this.formData.password && $this.formData.cPassword && $this.formData.password === $this.formData.cPassword && $this.formData.userProfile){
                    if($this.formData.userProfile != 'Other'){
                        if($this.errorMsg.firstname === '' && $this.errorMsg.lastname === '' && $this.errorMsg.email === '' && $this.errorMsg.mobile === '' &&  $this.errorMsg.password === '' &&  $this.errorMsg.cPassword === '' && $this.errorMsg.oUserProfile === ''){
                            $this.error = ''
                            $this.formData.oUserProfile = ''
                            $this.submitForm()
                        }else{
                            $this.error = 'Please resolve validation errors.'
                        }
                    }else if($this.formData.userProfile === 'Other' && $this.formData.oUserProfile != ''){
                        if($this.errorMsg.firstname === '' && $this.errorMsg.lastname === '' && $this.errorMsg.email === '' && $this.errorMsg.mobile === '' &&  $this.errorMsg.password === '' &&  $this.errorMsg.cPassword === '' && $this.errorMsg.oUserProfile === ''){
                            $this.error = ''
                            $this.submitForm()
                        }else{
                            $this.error = 'Please resolve validation errors.'
                        }
                    }else{
                        $this.error = 'Other user profile is required.'
                    }                    
                }else if($this.formData.firstname === ''){
                    $this.error = 'First name is required.'
                }else if($this.formData.lastname === ''){
                    $this.error = 'Last name is required.'
                }else if($this.formData.email === ''){
                    $this.error = 'Email is required.'
                }else if($this.formData.mobile === ''){
                    $this.error = 'Mobile number is required.'
                }else if($this.formData.password === ''){
                    $this.error = 'Password is required.'
                }else if($this.formData.cPassword === ''){
                    $this.error = 'Password is required.'
                }else if($this.formData.cPassword !== $this.formData.password){
                    $this.error = 'The passwords do not match.'
                }else{
                    $this.error = 'Please resolve validation errors.'
                }                
            },
            submitForm:function(){
                let $this = this
                $this.sending = true
                var session_url = 'includes/SessionController.php?session=register';
                axios.post(session_url, {
                    firstname: $this.formData.firstname,
					lastname: $this.formData.lastname,
					email: $this.formData.email,
					cc: $this.formData.cc,
					mobile: $this.formData.mobile,
					password: $this.formData.password,
					userProfile: ($this.formData.userProfile === 'Other') ? $this.formData.oUserProfile : $this.formData.userProfile
                }).then(function(response) {
                    $this.sending = false
                    $("#userProfile").val('End User').selectpicker("refresh");
                    $this.formData.firstname = ''
                    $this.formData.lastname = ''
                    $this.formData.email = ''
                    $this.formData.cc = '+91'
                    $this.formData.mobile = ''
                    $this.formData.password = ''
                    $this.formData.cPassword = ''
                    $this.formData.oUserProfile = ''
					$this.error = response.data;
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