<template id="formWizard">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="steps">
                        <ul class="list-inline">
                            <li v-for="(tab, index) in tabs" class="list-inline-item">
                                <a @click="currentTab = index" :class="{active: currentTab === index}">{{tab}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        <div v-show="currentTab === 0" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="applications">Select Application</label>
                                    <select class="form-control" id="applications">
                                        <option :value="index" v-for="(app, index) in applications" :disabled="app.disabled">{{app.label}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ventilation">Type of Ventilation</label>
                                    <select class="form-control" id="ventilation" @change="currentVentilationValue($event)">
                                        <option :value="index" v-for="(ven, index) in ventilation" :disabled="ven.disabled">{{ven.label}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" v-show="currentVentilation === 0">
                                    <label for="indoorIndustry">Industry</label>
                                    <select class="form-control" id="indoorIndustry" @change="currentIndoorIndustryValue($event)">
                                        <option :value="index" v-for="(ind, index) in indoorIndustry">{{ind}}</option>
                                    </select>
                                </div>
                                <div class="form-group" v-show="currentVentilation === 1">
                                    <label for="exhaustIndustry">Industry</label>
                                    <select class="form-control" id="exhaustIndustry" @change="currentExhaustIndustryValue($event)">
                                        <option :value="index" v-for="(exh, index) in exhaustIndustry">{{exh}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" v-show="currentExhaust === 0">
                                    <label for="purposeExhaustCK">Select Purpose</label>
                                    <select class="form-control selectpicker" id="purposeExhaustCK" multiple @change="currentPurposeExhaustCKValue($event)">
                                        <option :value="index" v-for="(purECK, index) in purposeExhaustCK">{{purECK}}</option>
                                    </select>
                                </div>
                                <div class="form-group" v-show="currentExhaust != 0">
                                    <label for="purposeExhaustOther">Select Purpose</label>
                                    <select class="form-control selectpicker" id="purposeExhaustOther" multiple @change="currentPurposeExhaustOtherValue($event)">
                                        <option :value="index" v-for="(purEO, index) in purposeExhaustOther">{{purEO}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" v-if="currentPurposeExhaust === 4">
                                    <label for="purposeExhaustCK">Other Purpose</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group" v-if="currentPurposeExhaust != 4">
                                    <label for="purposeExhaustCK">Other Purpose</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div v-show="currentTab === 1">

                        </div>
                        <div v-show="currentTab === 2">

                        </div>
                    </div>
                    <div class="actions">

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
                tabs: ['Step 1', 'Step 2', 'Step 3'],
                applications : [
                    {
                        label:'Air',
                        disabled: false
                    },
                    {
                        label:'Water',
                        disabled: true
                    },
                    {
                        label:'Waste Water',
                        disabled: true
                    }
                ],
                ventilation: [
                    {
                        label: 'Indoor',
                        disabled: true,
                    },
                    {
                        label: 'Exhaust',
                        disabled: false
                    }
                ],
                currentVentilation: 1,
                indoorIndustry: ['Commercial','Institutional','Residential','Manufacturing Comapny'],
                exhaustIndustry: ['Commercial Kitchen','STP','OWC','Garbage Room','Waste Segregation Room'],
                currentExhaust: 0,
                purposeExhaustCK:['Fire Safety','Oil & Grease','Odor','Toxic Pollutants','Other'],
                purposeExhaustOther:['Odor','Microorganisms','Toxic Pollutants','Other'],
                currentPurposeExhaust:''
            };  
        },
        methods:{
            currentVentilationValue:function(event){
                if(event.target.value == 0){
                    this.currentVentilation = 0
                }else{
                    this.currentVentilation = 1
                }
            },
            currentExhaustIndustryValue:function(event){
                if(event.target.value == 0){
                    this.currentExhaust = 0
                }else{
                    this.currentExhaust = event.target.value
                }
            },
            currentPurposeExhaustCKValue:function(event){
                if(event.target.value == 4){
                    this.currentPurposeExhaust = 4
                }else{
                    this.currentPurposeExhaust = event.target.value
                }
            },
        },
        mounted() {        
        },
        created(){
        }  
    })
</script>