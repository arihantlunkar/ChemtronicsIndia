<?php
    require_once 'Tab2ApplicationWise/commercial-kitchen.php';
    require_once 'Tab2ApplicationWise/stp.php';
    require_once 'Tab2ApplicationWise/owc.php';
?>
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
                            <div class="col-md-12">
                                <h4 class="info-text"> Let's start with the basic details.</h4>
                            </div>
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
                            <div class="col-md-12">
                                <h4 class="info-text"> Now fill the technical requirements for your application.</h4>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'Commercial Kitchen'">
                                <commercial-kitchen  @calculationdata="ckData"></commercial-kitchen>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'STP'">
                                <stp  @calculationdata="stpData"></stp>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'OWC'">
                                <owc  @calculationdata="owcData"></owc>                                
                            </div>
                        </div>
                        <div v-show="currentTab === 2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="info-text"> Result as per your requirement.</h4>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="result-text"> {{finalModelNum}}</h5>
                                </div>
                            </div>
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
                        }
                        // {
                        //     id:'garbageRoom',
                        //     text: 'Garbage Room',
                        // },
                        // {
                        //     id:'wasteSegregationRoom',
                        //     text: 'Waste Segregation Room',
                        // }
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
                errorMsg:'',                
                finalModelNum:''
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
                return {
                    CS: this.CS,
                    CT: this.CT,
                    CA: this.CA,
                    purpose: this.purpose,
                    otherPurpose: this.otherPurpose,
                    calculationData: {}                  
                }
            },
            updatedCurrentTab(){
                return this.currentTab
            }            
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
                        $(".selectpicker").selectpicker("refresh");
                    }
                }else{
                    $this.errorMsg = "Please fill all the details"
                }
            },
            validateTab1:function(){
                var $this = this                
                if(Object.entries($this.formData.calculationData).length === 0){
                    $this.errorMsg = "Please fill all the details"
                }else{  
                    var array = Object.values($this.formData.calculationData.req)
                    var boolean = array.some((x) => x == '')
                    if(boolean){
                        $this.errorMsg = "Please fill all the details"
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
            ckData:function(v){
                var $this = this
                $this.formData.calculationData = v
            },
            stpData:function(v){
                var $this = this
                $this.formData.calculationData = v
            },
            owcData:function(v){
                var $this = this
                $this.formData.calculationData = v
            },
            submitForm:function(formData){
                var $this = this
                $this.refreshAnimation()
                $this.currentTab = 2				
                var session_url = 'includes/LogicController.php';
                axios.post(session_url, {
                    customerData:formData
                }).then(function(response) {
                    $this.finalModelNum = response.data;
                }).catch(function(error) {
                    console.log(error);
                });    
            },
            refreshAnimation(){
                var $this = this
                setTimeout(() => {
                    var total_steps = $this.tabs.length
                    var move_distance = $('.form-wizard').width() / total_steps;
                    var indexTemp = $this.currentTab
                    var step_width = move_distance;
                    move_distance = move_distance * indexTemp;
                    var current = $this.currentTab + 1;
                    if(current == 1){
                        move_distance -= 8;
                    }else if(current == total_steps){
                        move_distance += 8;
                    }
                    $('.form-wizard').find('.moving-tab').css('width', step_width); 
                    var vertical_level = 0;               
                    $('.moving-tab').css({
                        'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
                        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
                    });
                }, 100);                
            }
        },
        mounted() {     
            this.refreshAnimation()  
        }
    })
</script>