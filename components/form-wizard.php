<template id="formWizard">
    <div class="col-md-8">
        <div class="card form-wizard">
            <div class="card-header">
                <h4>Get a Model Number</h4>
                <h5>This information will give you product model number related to your application.</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="steps">
                        <ul class="list-inline">
                            <li v-for="(tab, index) in tabs" class="list-inline-item">
                                <a @click="validateTab(index)" :class="{active: currentTab === index}">{{tab}}</a>
                            </li>
                        </ul>
                        <div class="moving-tab">{{tabs[currentTab]}}</div>
                    </div>
                    <div class="content">
                        <div v-show="currentTab === 0" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="solution">Solution</label>
                                    <select class="form-control selectpicker show-tick" id="solution"  v-model="CS">
                                        <option :value="sol.text" :id="sol.id" v-for="sol in solution" :disabled="sol.disabled">{{sol.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control selectpicker show-tick" id="type" v-model="CT">
                                        <option :value="t.text" :id="t.id" v-for="t in type" :disabled="t.disabled">{{t.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="application">Application</label>
                                    <select class="form-control selectpicker show-tick" id="application" v-model="CAValue" @change="validatingIndividualField('application')">
                                        <option :value="app.text" :id="app.id" v-for="app in application[CT]">{{app.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" v-show="CAValue == 'Commercial Kitchen'">
                                    <label for="purpose1">Purpose</label>
                                    <select class="form-control selectpicker" id="purpose1" v-model="CPValue" @change="validatingIndividualField('purpose')" multiple>
                                        <option :value="pur.text" v-for="pur in purpose1">{{pur.text}}</option>
                                    </select>
                                </div>
                                <div class="form-group" v-show="CAValue != 'Commercial Kitchen'">
                                    <label for="purpose2">Purpose</label>
                                    <select class="form-control selectpicker" id="purpose2" v-model="CPValue" @change="validatingIndividualField('purpose')" multiple>
                                        <option :value="pur.text" v-for="pur in purpose2">{{pur.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" v-if="purpose.value.includes('Other')">
                                    <label for="otherPurpose">Other Purpose</label>
                                    <input type="text" class="form-control" id="otherPurpose" v-model="COPValue">
                                </div>
                            </div>
                        </div>
                        <div v-show="currentTab === 1">
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'Commercial Kitchen'">
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 pr-0">
                                                <div class="form-group">
                                                    <label for="flowEA">Flow of Exhaust Air *</label>
                                                    <input type="number" name="flowEA" class="form-control" id="flowEA" placeholder="0.5" @input="inputChanged('flowEA')" v-model="flowEA">
                                                    <template v-if="errorMsgIndividual.flowEA!==''">
                                                        <div class="error mt-2">{{errorMsgIndividual.flowEA}}</div>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="flowEAUnit">Unit</label>
                                                    <select class="form-control selectpicker" id="flowEAUnit" v-model="flowEAUnitVal">
                                                        <option :value="unit" v-for="unit in flowEAUnit" >{{unit}}</option>
                                                    </select>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numHoods">Number of Hoods</label>
                                            <input type="number" name="numHoods" class="form-control" id="numHoods" placeholder="1" @input="inputChanged('numHoods')" v-model="numHoods">
                                            <template v-if="errorMsgIndividual.numHoods!==''">
                                                <div class="error mt-2">{{errorMsgIndividual.numHoods}}</div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 pr-0">
                                                <div class="form-group">
                                                    <label for="lenExDuct">Length of the Exhaust Duct *</label>
                                                    <input type="number" name="lenExDuct" class="form-control" id="lenExDuct" placeholder="0.5" @input="inputChanged('lenExDuct')" v-model="lenExDuct">
                                                    <template v-if="errorMsgIndividual.lenExDuct!==''">
                                                        <div class="error mt-2">{{errorMsgIndividual.lenExDuct}}</div>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="lenExDuctUnit">Unit</label>
                                                    <select class="form-control selectpicker" id="lenExDuctUnit" v-model="lenExDuctUnitVal">
                                                        <option :value="unit" v-for="unit in lenExDuctUnit" >{{unit}}</option>
                                                    </select>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="esp">ESP *</label>
                                            <select class="form-control selectpicker" id="esp" v-model="espVal">
                                                <option :value="v" v-for="v in esp" >{{v}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-9 pr-0">
                                                <div class="form-group">
                                                    <label for="exVel">Exhaust Velocity *</label>
                                                    <input type="number" name="exVel" class="form-control" id="exVel" placeholder="0.5" @input="inputChanged('exVel')" v-model="exVel">
                                                    <template v-if="errorMsgIndividual.exVel!==''">
                                                        <div class="error mt-2">{{errorMsgIndividual.exVel}}</div>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exVelUnit">Unit</label>
                                                    <select class="form-control selectpicker" id="exVelUnit" v-model="exVelUnitVal">
                                                        <option :value="unit" v-for="unit in exVelUnit" >{{unit}}</option>
                                                    </select>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="typeCooking">Type of Cooking</label>
                                            <select class="form-control selectpicker" id="typeCooking" v-model="typeCookingVal">
                                                <option :value="v" v-for="v in typeCooking" >{{v}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'STP'">
                                
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'OWC'">
                                
                            </div>
                        </div>
                        <div v-show="currentTab === 2">

                        </div>
                    </div>
                    <div class="actions">
                        <div class="pull-right">
                            <span class="error mr-3">{{errorMsg}}</span>
                            <input type='button' class='btn btn-primary' name='next' value='Next' v-if="currentTab==0" @click="validateTab0"/>
                            <input type='button' class='btn btn-primary' name='finish' value='Finish' v-if="currentTab==1" @click="validateTab1"/>
	                    </div>
                        <div class="pull-left">
                            <input type='button' class='btn btn-secondary' name='previous' value='Previous' v-if="currentTab==1 || currentTab==2" @click="validateTab(currentTab-1)"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    var formWizard = Vue.component('formWizard', {
        template: '#formWizard',
        data: function () {
            return {
                currentTab: 0,
                tabs: ['Basic Details', 'Calculations', 'Model Number'],
                solution : [
                    {
                        id:'air',
                        text:'Air',
                        disabled: false
                    },
                    {   
                        id:'water',
                        text:'Water',
                        disabled: true
                    },
                    {
                        id:'wasteWater',
                        text:'Waste Water',
                        disabled: true
                    }
                ],
                CS: "Air",
                type: [
                    {
                        id:'indoor',
                        text: 'Indoor',
                        disabled: true,
                    },
                    {
                        id:'exhaust',
                        text: 'Exhaust',
                        disabled: false
                    }
                ],
                CT: "Exhaust",
                application: {
                    Indoor: [
                        {
                            id:'commercial',
                            text: 'Commercial',
                        },
                        {
                            id:'institutional',
                            text: 'Institutional',
                        },
                        {
                            id:'residential',
                            text: 'Residential',
                        },
                        {
                            id:'manufacturingComapny',
                            text: 'Manufacturing Comapny',
                        }
                    ],
                    Exhaust: [
                        {
                            id:'commercialKitchen',
                            text: 'Commercial Kitchen',
                        },
                        {
                            id:'stp',
                            text: 'STP',
                        },
                        {
                            id:'owc',
                            text: 'OWC',
                        },
                        {
                            id:'garbageRoom',
                            text: 'Garbage Room',
                        },
                        {
                            id:'wasteSegregationRoom',
                            text: 'Waste Segregation Room',
                        }
                    ]
                }, 
                CAValue:'Commercial Kitchen',
                purpose1:[
                    {
                        id:'fireSafety',
                        text:"Fire Safety",
                    },
                    {
                        id:'oilGrease',
                        text:"Oil & Grease",
                    },
                    {
                        id:'odor',
                        text:"Odor",
                    },
                    {
                        id:'toxicPollutants',
                        text:"Toxic Pollutants",
                    },
                    {
                        id:'other',
                        text:"Other",
                    }
                ],
                purpose2:[
                    {
                        id:'odor',
                        text:"Odor",
                    },
                    {
                        id:'microorganisms',
                        text:"Microorganisms",
                    },
                    {
                        id:'toxicPollutants',
                        text:"Toxic Pollutants",
                    },
                    {
                        id:'other',
                        text:"Other",
                    }
                ],
                CPValue:[],
                COPValue:'',
                flowEA:'',
                flowEAUnit:['cfm','cmh'],
                flowEAUnitVal:'cfm',
                numHoods:'',
                lenExDuct:'',
                lenExDuctUnit:['ft','m'],
                lenExDuctUnitVal:'ft',
                esp:['Yes','No'],
                espVal:'No',
                exVel:'',
                exVelUnit:['fpm','fps','mph'],
                exVelUnitVal:'fpm',
                typeCooking:['a','b','c'],
                typeCookingVal:'a',
                errorMsg:'',
                errorMsgIndividual:{
                    flowEA:'',
                    numHoods:'',
                    lenExDuct:''
                }
            };  
        },
        computed: {
            CA() {
                return { 
                    type: this.CT ,
                    value: this.CAValue
                }
            },
            purpose(){
                return { 
                    application: this.CA.value ,
                    value: this.CPValue
                }
            },
            otherPurpose(){
                return { 
                    application: this.CA.value ,
                    value: this.COPValue
                }
            },
            formData(){
                var $this = this
                var tab1Data
                if($this.CA.value == 'Commercial Kitchen'){
                    tab1Data = {
                        req : {
                            flowEA: $this.flowEA,
                            flowEAUnitVal: $this.flowEAUnitVal,
                            lenExDuct: $this.lenExDuct,
                            lenExDuctUnitVal: $this.lenExDuctUnitVal,
                            espVal: $this.espVal,
                            exVel:$this.exVel,
                            exVelUnitVal:$this.exVelUnitVal
                        },
                        nonReq:{
                            numHoods:$this.numHoods,
                            typeCookingVal:$this.typeCookingVal
                        }
                    }
                    
                }else if($this.CA.value == 'STP'){
                    tab1Data = {
                        
                    }
                }else if($this.CA.value == 'OWC'){
                    tab1Data = {
                        
                    }
                }
                return {
                    CS: this.CS,
                    CT: this.CT,
                    CA: this.CA,
                    purpose: this.purpose,
                    otherPurpose: this.otherPurpose,
                    calculationData: tab1Data                  
                }
            },
        },
        methods:{
            validateTab:function(clickedTab){
                var $this = this
                if(clickedTab==0){
                    $this.refreshAnimation()
                    $this.currentTab = 0
                }else if(clickedTab==1){
                    $this.validateTab0()
                }else if(clickedTab==2){
                    $this.validateTab1()
                }
            },
            validateTab0:function(){
                var $this = this                
                if($this.CS != '' && $this.CT != '' && $this.CA.value != '' && $this.purpose.value.length>0){
                    if($this.purpose.value.includes('Other') && $this.otherPurpose.value==''){
                        $this.errorMsg = "Please fill all the details"
                    }else{
                        $this.errorMsg = ''
                        $this.refreshAnimation()
                        $this.currentTab = 1
                    }
                }else{
                    $this.errorMsg = "Please fill all the details"
                }
            },
            validateTab1:function(){
                var $this = this
                reqObj = $this.formData.calculationData.req  
                for(var key in reqObj){
                    if(reqObj[key]==''){
                        $this.errorMsg = "Please fill all the details"
                        break;
                    }else{
                        $this.errorMsg = ''
                        $this.submitForm($this.formData)
                    }
                }           
            },
            validatingIndividualField:function(field){
                var $this = this
                if(field == 'application'){
                    $this.CPValue = []
                    $this.purpose.value = []
                    $this.COPValue = ''
                    $("#purpose1").val('default').selectpicker("refresh");
                    $("#purpose2").val('default').selectpicker("refresh");
                }else if(field == 'purpose' && !$this.purpose.value.includes('Other')){
                    $this.otherPurpose.value = ''
                    $this.COPValue = ''
                }
            },
            inputChanged:function(v){
                let $this = this
                this.errorMsg = ''
                if(v=='flowEA'){
                    if ($this.flowEA && $this.validateFlowEA($this.flowEA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateFlowEA($this.flowEA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='numHoods'){
                    if ($this.numHoods && $this.validateNumHoods($this.numHoods)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateNumHoods($this.numHoods)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='lenExDuct'){
                    if ($this.lenExDuct && $this.validateLenExDuct($this.lenExDuct)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateLenExDuct($this.lenExDuct)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='exVel'){
                    if ($this.exVel && $this.validateExVel($this.exVel)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateExVel($this.exVel)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }
            },
            validateFlowEA:function(flowEA,optional){
                var flowEARegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(flowEA == "" && optional == 1)
				{
					return [" ",0];
				}
				if(flowEA == '')
				{
					return ["Flow value cannot be blank",1];
				}
				else if(flowEA.length > 8)
				{
					return ["Flow value cannot exceed 7 digits", 1];
				}
				else if(flowEA.length < 1)
				{
					return ["Mobile number cannot be less than 1 digits",1];
                }
                else if(!flowEARegx.test(flowEA))
				{
                    return ["Invalid flow value",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateNumHoods:function(numHoods,optional){
                var numHoodsRegx = /^[0-9]*$/g
                var $this = this
				if(numHoods == "" && optional == 1)
				{
					return [" ",0];
				}
                if(numHoods.length > 8)
				{
					return ["Number of hoods cannot exceed 7 digits", 1];
				}
				else if(numHoods.length < 1)
				{
					return ["Number of hoods cannot be less than 1 digits",1];
                }
                else if(!numHoodsRegx.test(numHoods))
				{
                    return ["Invalid number of hoods",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateLenExDuct:function(lenExDuct,optional){
                var lenExDuctRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(lenExDuct == "" && optional == 1)
				{
					return [" ",0];
				}
				if(lenExDuct == '')
				{
					return ["Length value cannot be blank",1];
				}
				else if(lenExDuct.length > 8)
				{
					return ["Length value cannot exceed 7 digits", 1];
				}
				else if(lenExDuct.length < 1)
				{
					return ["Length cannot be less than 1 digits",1];
                }
                else if(!lenExDuctRegx.test(lenExDuct))
				{
                    return ["Invalid Length value",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateExVel:function(exVel,optional){
                var exVelRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(exVel == "" && optional == 1)
				{
					return [" ",0];
				}
				if(exVel == '')
				{
					return ["Exhaust velocity value cannot be blank",1];
				}
				else if(exVel.length > 8)
				{
					return ["Exhaust velocity value cannot exceed 7 digits", 1];
				}
				else if(exVel.length < 1)
				{
					return ["Exhaust velocity cannot be less than 1 digits",1];
                }
                else if(!exVelRegx.test(exVel))
				{
                    return ["Invalid Exhaust velocity value",1];
				}
				else
				{
					return [" ",0];
                }
            },
            submitForm:function(formData){
                var $this = this
                console.log(formData)
                // var requestObj = {
                //     url: 'includes/saveFormData.php',
                //     data: {type:'insertFormData',customerData:formData},
                //     type: 'post',
                //     dataType: 'text',
                // }
                // var ajaxRequest = fetchAjaxData(requestObj);
                // ajaxRequest.success(function(output){
                    
                // })
                // ajaxRequest.error(function(xhr){
                //     logError(xhr.responseText,"Get Customer data updates Data");
                // })                
            },
            movingTabWidth(){
                var $this = this
                var total_steps = $this.tabs.length
                var move_distance = $('.form-wizard').width() / total_steps;
                $('.form-wizard').find('.moving-tab').css('width', move_distance); 
                if($this.currentTab == 1){
                    move_distance = 0;
                }else if($this.currentTab == total_steps){
                    move_distance += 8;
                }
                return move_distance
            },
            refreshAnimation(){
                var $this = this
                var width = $this.movingTabWidth()
                var vertical_level = 0;               
                $('.moving-tab').css({
                    'transform':'translate3d(' + width + 'px, ' + vertical_level +  'px, 0)',
                    'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
                });
            }
        },
        mounted() {     
            this.movingTabWidth()               
        },
        created(){
            
        }  
    })
</script>