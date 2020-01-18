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
                                <a @click="validateTab(currentTab)" :class="{active: currentTab === index}">{{tab}}</a>
                            </li>
                        </ul>
                        <div class="moving-tab">{{tabs[currentTab]}}</div>
                    </div>
                    <div class="content">
                        <div v-show="currentTab === 0" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="solution">Solution</label>
                                    <select class="form-control" id="solution"  v-model="CS">
                                        <option :value="sol.text" :id="sol.id" v-for="sol in solution" :disabled="sol.disabled">{{sol.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" v-model="CT">
                                        <option :value="t.text" :id="t.id" v-for="t in type" :disabled="t.disabled">{{t.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="application">Application</label>
                                    <select class="form-control" id="application" v-model="CAValue">
                                        <option :value="app.text" :id="app.id" v-for="app in application[CT]">{{app.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" v-show="CAValue == 'Commercial Kitchen'">
                                    <label for="purpose1">Purpose</label>
                                    <select class="form-control selectpicker" id="purpose1" v-model="CPValue" @change="validatingIndividualField" multiple>
                                        <option :value="pur.text" v-for="pur in purpose1">{{pur.text}}</option>
                                    </select>
                                </div>
                                <div class="form-group" v-show="CAValue != 'Commercial Kitchen'">
                                    <label for="purpose2">Purpose</label>
                                    <select class="form-control selectpicker" id="purpose2" v-model="CPValue" multiple>
                                        <option :value="pur.text" v-for="pur in purpose2">{{pur.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" v-if="purpose.value.includes('Other')">
                                    <label for="otherPurpose">Other Purpose</label>
                                    <input type="text" class="form-control" id="otherPurpose" v-model="COPValue" @change="validatingIndividualField">
                                </div>
                            </div>
                        </div>
                        <div v-show="currentTab === 1">

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
                            <input type='button' class='btn btn-secondary' name='previous' value='Previous' v-if="currentTab==1 || currentTab==2"/>
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
                errorMsg:''
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
                return {
                    CS: this.CS,
                    CT: this.CT,
                    CA: this.CA,
                    purpose: this.purpose,
                    otherPurpose: this.otherPurpose
                }
            },
        },
        methods:{
            validateTab:function(i){
                var $this = this
                if(i==0){
                    $this.validateTab0()
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
                $this.submitForm($this.formData)
            },
            validatingIndividualField:function(){
                var $this = this
                if($this.purpose.value!='' || $this.otherPurpose.value!=''){
                    $this.errorMsg = ''
                }
            },
            submitForm:function(formData){
                var $this = this
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