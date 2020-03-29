<?php
    require_once 'Tab2ApplicationWise/commercialkitchen.php';
    require_once 'Tab2ApplicationWise/stp.php';
    require_once 'Tab2ApplicationWise/owc.php';
    require_once 'Tab2ApplicationWise/washroomgarbagewaste.php';
    require_once 'Tab2ApplicationWise/commercialmanufacturing.php';
    require_once 'pdf-content.php';
?>
<template id="formWizard">
    <div class="col-md-8">
        <div class="card form-wizard">
            <div class="card-header">
                <h4>Model Selection Guide</h4>
                <h5>The PROSOFT software will give you most appropriates model on the bases of your submitted site data.</h5>
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
                                    <select class="form-control selectpicker show-tick" id="type" v-model="CT" @change="validatingIndividualField('type')">
                                        <option :value="t.text" :id="t.id" v-for="t in type">{{t.text}}</option>
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
                                <div class="form-group">
                                    <label for="purpose">Purpose</label>
                                    <select class="form-control selectpicker show-tick" id="purpose" v-model="CPValue" @change="validatingIndividualField('purpose')" multiple>
                                        <option :value="pur.text" v-for="pur in purposeData.Air.Exhaust.purpose1" v-if="CAValue == 'Commercial Kitchen'">{{pur.text}}</option>
                                        <option :value="pur.text" v-for="pur in purposeData.Air.Exhaust.purpose2" v-if="(CAValue == 'STP' || CAValue == 'OWC' || CAValue == 'Garbage Room' || CAValue == 'Waste Segregation Room' || CAValue == 'Washroom')">{{pur.text}}</option>
                                        <option :value="pur.text" v-for="pur in purposeData.Air.Indoor.purpose1" v-if="CAValue == 'Commercial | Institutional'">{{pur.text}}</option>
                                        <option :value="pur.text" v-for="pur in purposeData.Air.Indoor.purpose2" v-if="(CAValue == 'Residential' || CAValue == 'Manufacturing Company')">{{pur.text}}</option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group checkbox-wrapper" v-if="CAValue == 'Commercial | Institutional'">
                                    <div v-for="ct in commercialType" class="cus-checkbox">
                                        <input type="radio" :id="ct" name="ct" :value="ct" v-model="CACTValue" @change="validatingIndividualField('commercialType')">
                                        <label :for="ct">{{ct}}</label>
                                    </div>
                                    <div v-if="CACTValue=='Other'">
                                        <label for="otherCommercialType">Other Commercial Type</label>
                                        <input type="text" class="form-control" id="otherCommercialType" v-model="CACTOValue">
                                    </div>
                                </div>
                                <div class="form-group checkbox-wrapper" v-if="CAValue == 'Manufacturing Company'">
                                    <div v-for="mt in manufacturingType" class="cus-checkbox">
                                        <input type="radio" :id="mt" name="mt" :value="mt" v-model="CAMTValue" @change="validatingIndividualField('manufacturingType')">
                                        <label :for="mt">{{mt}}</label>
                                    </div>
                                    <div v-if="CAMTValue=='Other'">
                                        <label for="otherManufacturingType">Other Manufacturing Type</label>
                                        <input type="text" class="form-control" id="otherManufacturingType" v-model="CAMTOValue">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" v-if="purpose.value.includes('Other')">
                                    <label for="otherPurpose">Other Purpose</label>
                                    <input type="text" class="form-control" id="otherPurpose" v-model="COPValue">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" v-if="CT=='Indoor'">
                                    <label for="airconditioning">Air Conditioning</label>
                                    <select class="form-control selectpicker show-tick" id="airconditioning" v-model="CACValue" @change="validatingIndividualField('airconditioning')" multiple>
                                        <option :value="ac.text" :id="ac.id" v-for="ac in airconditioning">{{ac.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" v-if="CT=='Indoor'">
                                    <label for="customermovement">Visitor / Customer movement</label>
                                    <select class="form-control selectpicker show-tick" id="customermovement" v-model="CCMValue">
                                        <option :value="cm.text" :id="cm.id" v-for="cm in customermovement">{{cm.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" v-if="CACValue.includes('Other')">
                                    <label for="otherAirConditioning">Other Air Conditioning</label>
                                    <input type="text" class="form-control" id="otherAirConditioning" v-model="COACValue">
                                </div>
                            </div>
                        </div>
                        <div v-show="currentTab === 1">
                            <div class="col-md-12">
                                <h4 class="info-text"> Now fill the technical requirements for your application.</h4>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'Commercial Kitchen'">
                                <commercialkitchen  v-if="resetComp" @calculationdata="techData"></commercialkitchen>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'STP'">
                                <stp  v-if="resetComp" @calculationdata="techData"></stp>
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && formData.CA.value == 'OWC'">
                                <owc  v-if="resetComp" @calculationdata="techData"></owc>                                
                            </div>
                            <div v-if="formData.CA.type == 'Exhaust' && (formData.CA.value == 'Garbage Room' || formData.CA.value == 'Waste Segregation Room' || formData.CA.value == 'Washroom')">
                                <washroomgarbagewaste v-if="resetComp" @calculationdata="techData"></washroomgarbagewaste>
                            </div>
                            <div v-if="formData.CA.type == 'Indoor' && (formData.CA.value == 'Commercial | Institutional' || formData.CA.value == 'Manufacturing Company')">
                                <commercialmanufacturing v-if="resetComp" @calculationdata="techData"></commercialmanufacturing>
                            </div>
                        </div>
                        <div v-show="currentTab === 2" :class="{loadingDiv:loading}" class="loading-cus-ht">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="info-text"> Result as per your requirement.</h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <template v-if="!finalModelNum">
                                            <div class="col-md-12 my-auto">
                                                <div v-if="finalRiskMsg0" class="alert alert-warning">{{finalRiskMsg0}}
                                                    <a href="https://www.slideshare.net/chemtronics/design-criteria-exhaust-air-odour-destruction-228236924" target="_blank" class="text-primary">"Design Criteria"</a> 
                                                {{finalRiskMsg1}} 
                                                    <a href="mailto:solution@chemtronicsindia.com" target="_blank" class="text-primary">solution@chemtronicsindia.com</a>
                                                </div>
                                                <div v-if="finalNoModelMsg" class="alert alert-danger">{{finalNoModelMsg}}</div>
                                            </div> 
                                        </template>  
                                        <template v-if="finalModelNum">                                     
                                            <div class="col-md-8 my-auto">
                                                <div class="col-md-12 mb-4 pl-0">
                                                    <div class="alert alert-success">{{finalModelNum}}</div> 
                                                    <p><i class="fa fa-info-circle mr-1"></i> Our above model number is as per your technical requirement for <span class="text-primary">{{formData.CA.value}}</span> application under <span class="text-primary">{{formData.CS}}</span> solution of <span class="text-primary">{{formData.CA.type}}</span> type.</p>
                                                </div>
                                                <div class="col-md-12 pl-0">
                                                    <h6>Download your technical requirements (Submitted Data)</h6>
                                                    <a href="#" class="btn btn-transparent" @click="downloadTechReq">Download Now</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-4 border-left">
                                                <a href="#" class="btn btn-primary btn-block" @click="downloadBOQ">Download BOQ</a>
                                                <a v-if="formData.CT=='Exhaust'" href="#" class="btn btn-transparent btn-block" @click="downloadTechSpecs">Technical Specs</a>
                                            </div>
                                        </template>
                                    </div>
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
        <div class="pdf-content">
            <pdf-content :formdata="formData" :finalmodelmum="finalModelNum" :purpose="purpose" :currenttab="currentTab"></pdf-content>
        </div>
    </div>
</template>
<script>
    var formWizard = Vue.component('formWizard', {
        template: '#formWizard',
        data: function () {
            return {
                loading:false,
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
                    },
                    {
                        id:'exhaust',
                        text: 'Exhaust',
                    }
                ],
                CT: "",
                application: {
                    Indoor: [
                        {
                            id:'commercialInstitutional',
                            text: 'Commercial | Institutional',
                        },
                        {
                            id:'manufacturingCompany',
                            text: 'Manufacturing Company',
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
                        },
                        {
                            id:'washroom',
                            text: 'Washroom',
                        }
                    ]
                }, 
                CAValue:'',
                purposeData:{
                    Air:{
                        Indoor:{
                            purpose1:[
                                {
                                    id:'disinfection',
                                    text:"Disinfection",
                                },
                                {
                                    id:'bacteriaVirusControl',
                                    text:"Bacteria & Virus Control",
                                },
                                {
                                    id:'enhanceIAQ',
                                    text:"Enhance IAQ",
                                },
                                {
                                    id:'reduceSBS',
                                    text:"Reduce SBS",
                                },
                                {
                                    id:'controlCarbonDiOxide',
                                    text:"Control Carbon Di-oxide",
                                },
                                {
                                    id:'odorControl',
                                    text:"Odor Control",
                                },
                                {
                                    id:'vocControl',
                                    text:"VOC Control",
                                },
                                {
                                    id:'toxicPollutantControl',
                                    text:"Toxic Pollutant Control",
                                },
                                {
                                    id:'suspendedParticulateMatters',
                                    text:"Suspended Particulate Matters [SPM]",
                                },
                                {
                                    id:'other',
                                    text:"Other",
                                },
                            ],
                            purpose2:[
                                {
                                    id:'airSurfaceDisinfection',
                                    text:"Air & Surface Disinfection",
                                },
                                {
                                    id:'bacteriaVirusControl',
                                    text:"Bacteria & Virus Control",
                                },
                                {
                                    id:'enhanceIAQFoodHygiene',
                                    text:"Enhance IAQ, Food Safety & Hygiene",
                                },
                                {
                                    id:'odorControl',
                                    text:"Odor Control",
                                },
                                {
                                    id:'vocControl',
                                    text:"VOC Control",
                                },
                                {
                                    id:'toxicPollutantControl',
                                    text:"Toxic Pollutant Control",
                                },
                                {
                                    id:'controlSpoilageRejection',
                                    text:"Control Spoilage & Rejection",
                                },
                                {
                                    id:'increaseShelflife',
                                    text:"Increase Shelf-life",
                                },
                                {
                                    id:'other',
                                    text:"Other",
                                },
                            ]
                        },
                        Exhaust:{
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
                        }
                    }
                },
                airconditioning:[
                    {
                        id:'centralHVAC',
                        text:"Central HVAC",
                    },
                    {
                        id:'fanCoilUnits',
                        text:"Fan Coil Units [FCU]",
                    },
                    {
                        id:'cassetteAC',
                        text:"Cassette ACs",
                    },
                    {
                        id:'windowSplit',
                        text:"Window / Split",
                    },
                    {
                        id:'columnAC',
                        text:"Column ACs",
                    },
                    {
                        id:'other',
                        text:"Other",
                    },
                ],
                customermovement:[
                    {
                        id:'light',
                        text:"Light",
                    },
                    {
                        id:'medium',
                        text:"Medium",
                    },
                    {
                        id:'heavy',
                        text:"Heavy",
                    },
                ],
                commercialType:['Offices','Banks','Corporate Bldgs','Commercial Places','Hotels','Resort','Auditorium','Conference Hall','Board Room','School','Collages','Library','Day care','Nursery','Creche','Indoor Stadium','Hospital','Healthcare','Gym','Sports Club','Cold Storage','Airport','Mall','Theater','Fire restoration','Fish Market','Slaughter House','Restaurants','Casino','Pub','Smoking Lounge','Butchery','Other'],
                manufacturingType:['Pharmaceutical','API','Food & Beverage','Bakery','Dairy','Confectionary','Chocolate','Toothpaste','Aquaculture','Pet food','Nutritional Food','Change rooms','Washrooms','Ethylene Control','Warehouse','Mortuary','Garbage Rooms','Garbage Shoots','Other'],
                CACTValue:'',
                CACTOValue:'',
                CAMTValue:'',
                CAMTOValue:'',
                CACValue:[], 
                CCMValue:'',
                COACValue:'',               
                CPValue:[],
                COPValue:'',
                errorMsg:'',                
                finalModelNum:'',
                finalRiskMsg0:'',
                finalRiskMsg1:'',
                finalNoModelMsg:'',
                resetComp:false
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
                    CS: $this.CS,
                    CT: $this.CT,
                    CA: $this.CA,
                    purpose: $this.purpose,
                    otherPurpose: $this.otherPurpose,
                    CACTValue: $this.CACTValue,
                    CACTOValue: $this.CACTOValue,
                    CAMTValue: $this.CAMTValue,
                    CAMTOValue: $this.CAMTOValue,
                    CACValue: $this.CACValue,
                    COACValue: $this.COACValue,
                    CCMValue: $this.CCMValue,
                    calculationData: {},
                    finalModelNum : ''            
                }
            },
            updatedCurrentTab(){
                return this.currentTab
            }            
        },
        methods:{
            resetfunc(){
                let $this = this
                $this.resetComp = false
                Vue.nextTick(function(){
                    $this.resetComp = true;
                })
            },
            validateTab:function(clickedTab){
                var $this = this
                if(clickedTab==0){
                    $this.refreshAnimation()
                    $this.currentTab = 0
                    $this.finalModelNum = ""
                    $this.formData.finalModelNum = ""
                    $this.formData.calculationData = ""
                }else if(clickedTab==1){
                    $this.finalModelNum = ""
                    $this.formData.finalModelNum = ""
                    $this.formData.calculationData = ""
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
                    }else if($this.CT == "Indoor"){
                        if(($this.CA.value=="Commercial | Institutional" && $this.CACTValue == "" || ($this.CACTValue == "Other" && $this.CACTOValue=="")) || ($this.CA.value=="Manufacturing Company" && $this.CAMTValue == "" || ($this.CAMTValue == "Other" && $this.CAMTOValue=="") || ($this.CACValue.length>0 && $this.CACValue.includes('Other') && $this.COACValue=='') ||($this.CACValue.length==0) || ($this.CCMValue==''))){
                            $this.errorMsg = "Please fill all the details"
                        }else{
                            $this.errorMsg = ''
                            $this.refreshAnimation()
                            $this.currentTab = 1
                            $this.resetfunc()
                            $(".selectpicker").selectpicker("refresh");
                        }
                    }else{
                        $this.errorMsg = ''
                        $this.refreshAnimation()
                        $this.currentTab = 1
                        $this.resetfunc()
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
                }else if(field == 'type'){
                    $this.CAValue = ""
                    $this.CACValue = []
                    $this.CCMValue = ''
                    $this.COACValue = ""
                    $this.CACTValue = ""
                    $this.CAMTValue = ""
                }else if(field == 'purpose' && !$this.purpose.value.includes('Other')){
                    $this.otherPurpose.value = ''
                    $this.COPValue = ''
                }else if(field == 'airconditioning' && !$this.CACValue.includes('Other')){
                    $this.COACValue = ''
                }else if(field == 'commercialType'){
                    $this.CAMTValue = ""
                    $this.CAMTOValue = ""
                    if($this.CACTValue != "Other"){
                        $this.CACTOValue = ""
                    }
                }else if(field == 'manufacturingType'){
                    $this.CACTValue = ""
                    $this.CACTOValue = ""
                    if($this.CAMTOValue!= "Other"){
                        $this.CAMTOValue = ""
                    }
                }
            },
            techData:function(v){
                var $this = this
                $this.formData.calculationData = v
            },
            submitForm:function(formData){
                var $this = this
                $this.refreshAnimation()
                $this.currentTab = 2
                $this.loading = true				
                var session_url = 'includes/LogicController.php';
                axios.post(session_url, {
                    customerData:formData
                }).then(function(response) {
                    $this.loading = false
                    var str = response.data
                    var riskMsg = str.includes("Treatment time is not sufficient");
                    var noModelMsg = str.includes("No Model Found");
                    var ModelMsg = str.includes("Model number is");
                    if(riskMsg){
                        var x = str.split("“Design Criteria”");
                        var y = x[1].split("solution@chemtronicsindia.com");
                        $this.finalRiskMsg0 = x[0]
                        $this.finalRiskMsg1 = y[0]
                        $this.finalModelNum = ''
                        $this.finalNoModelMsg = ''
                    }
                    if(noModelMsg){
                        $this.finalNoModelMsg = response.data
                        $this.finalModelNum = '';
                        $this.finalRiskMsg0 = '';
                        $this.finalRiskMsg1 = '';
                    }
                    if(ModelMsg){
                        $this.finalModelNum = response.data;
                        var str = response.data
                        var x = str.split("Model number is : ");
                        $this.formData.finalModelNum = x[1];
                        $this.finalNoModelMsg = ''
                        $this.finalRiskMsg0 = '';
                        $this.finalRiskMsg1 = '';
                    }
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
                        move_distance -= 7;
                    }else if(current == total_steps){
                        move_distance += 7;
                    }
                    $('.form-wizard').find('.moving-tab').css('width', step_width); 
                    var vertical_level = 0;               
                    $('.moving-tab').css({
                        'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
                        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
                    });
                }, 100);                
            },
            downloadTechReq:function(e){
                var $this = this
                var ct = this.formData.CT      
                var caVal = this.formData.CA.value
                var ca = caVal.replace(/ +/g, "");          
                var pdfData = $('.pdf-content').html()
                var doc = new jsPDF('p', 'pt', 'a4', true)
                margins = {
                    top: 60,
                    bottom: 60,
                    left: 40,
                    width: 522
                };
                doc.fromHTML(pdfData,margins.left,margins.top,{
                    'width': margins.width
                },function () {
                    doc.save('UserTechReq-'+ct+'-'+ca+'.pdf');
                },margins);
                e.preventDefault();
            },
            downloadBOQ:function(e){
                var $this = this
                var ct = this.formData.CT      
                var caVal = this.formData.CA.value
                var ca = caVal.replace(/ +/g, ""); 
                var session_url = 'includes/DownloadFileController.php';
                axios.post(session_url, {
                    customerData:$this.formData
                }).then(function(response) {
					if(response.data != "")
					{
						var a = document.createElement('a');
						var url = response.data;
						a.href = url;
						a.download = ct+'-'+ca+'-'+$this.formData.finalModelNum + ".pdf";
						document.body.append(a);
						a.click();
						a.remove();
						window.URL.revokeObjectURL(url);
					}                    
                }).catch(function(error) {
                    console.log(error);
                });
                e.preventDefault(); 
            },
            downloadTechSpecs:function(e){
                var $this = this
                var ct = this.formData.CT      
                var caVal = this.formData.CA.value
                var ca = caVal.replace(/ +/g, ""); 
                var session_url = 'includes/DownloadFileController.php';
                axios.post(session_url, {
                    customerData:$this.formData
                }).then(function(response) {
					if(response.data != "")
					{
						var a = document.createElement('a');
						var url = response.data;
						a.href = url;
						a.download = ct+'-'+ca+'-'+$this.formData.finalModelNum + ".pdf";
						document.body.append(a);
						a.click();
						a.remove();
						window.URL.revokeObjectURL(url);
					}                    
                }).catch(function(error) {
                    console.log(error);
                });
                e.preventDefault(); 
            },
        },
        mounted() {     
            this.refreshAnimation()  
        },
        updated(){
            $(".selectpicker").selectpicker("refresh")
        }
    })
</script>