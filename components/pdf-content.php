<template id="pdfContent">
    <div style="font-family:Montserrat,Helvetica,Arial,sans-serif;">
        <h2 style="font-size:20px;">User Technical Requirement For <span style="color:#02b389">{{finalmodelmum}}</span></h2>
        <div>
            <h4>Basic Details</h4>
            <p>Solution: <span>{{formdata.CS}}</span></p>
            <p>Type: <span>{{formdata.CT}}</span></p>
            <p>Application: <span>{{formdata.CA.value}}</span></p>
            <p>Purpose: <span>{{formdata.purpose.value[0]}}</span></p>
            <p v-if="purpose.value.includes('Other')">Other Purpose: <span>{{formdata.otherPurpose.value}}</span></p>
        </div>
        <div>
            <h4>Technical requirements for your {{formdata.CA.value}} application under {{formdata.CS}} solution of {{formdata.CT}} type.</h4>
            <div v-if="formdata.CA.type == 'Exhaust' && formdata.CA.value == 'Commercial Kitchen' && currenttab === 2">
                <p>Flow of Exhaust Air* : <span>{{formdata.calculationData.req.flowEA}} {{formdata.calculationData.req.flowEAUnitVal}}</span></p>
                <p>Number of Hoods : <span>{{formdata.calculationData.nonReq.numHoods}}</span></p>
                <p>Length of the Exhaust Duct* : <span>{{formdata.calculationData.req.lenExDuct}} {{formdata.calculationData.req.lenExDuctUnitVal}}</span></p>
                <p>ESP* : <span>{{formdata.calculationData.req.espVal}}</span></p>
                <p>Exhaust Velocity* : <span>{{formdata.calculationData.req.exVel}}  {{formdata.calculationData.req.exVelUnitVal}}</span></p>
                <p>Type of Cooking : <span>{{formdata.calculationData.nonReq.typeCookingVal}}</span></p>
            </div>
            <div v-if="formdata.CA.type == 'Exhaust' && formdata.CA.value == 'STP' && currenttab === 2">
                <p>Total STP Room Area* : <span>{{formdata.calculationData.req.stpRA}} {{formdata.calculationData.req.stpRAUnitVal}}</span></p>
                <p>STP Room Height* : <span>{{formdata.calculationData.req.stpRH}} {{formdata.calculationData.req.stpRHUnitVal}}</span></p>
                <p>Flow of Exhaust Air* : <span>{{formdata.calculationData.req.flowEA}} {{formdata.calculationData.req.flowEAUnitVal}}</span></p>
                <p>ACPH : <span>{{formdata.calculationData.nonReq.acph}}</span></p>
                <p>Length of the Exhaust Duct* : <span>{{formdata.calculationData.req.lenExDuct}}  {{formdata.calculationData.req.lenExDuctUnitVal}}</span></p>
                <p>Exhaust Velocity* : <span>{{formdata.calculationData.req.exVel}} {{formdata.calculationData.req.exVelUnitVal}}</span></p>
            </div>
            <div v-if="formdata.CA.type == 'Exhaust' && formdata.CA.value == 'OWC' && currenttab === 2">
                <p>Number of OWC* : <span>{{formdata.calculationData.req.numOWC}}</span></p>
                <p>OWC Room Area* : <span>{{formdata.calculationData.req.owcRA}} {{formdata.calculationData.req.owcRAUnitVal}}</span></p>
                <p>OWC Room Height* : <span>{{formdata.calculationData.req.owcRH}} {{formdata.calculationData.req.owcRHUnitVal}}</span></p>
                <p>Flow of Exhaust Air* : <span>{{formdata.calculationData.req.flowEA}} {{formdata.calculationData.req.flowEAUnitVal}}</span></p>
                <p>ACPH : <span>{{formdata.calculationData.nonReq.acph}}</span></p>
                <p>Length of the Exhaust Duct* : <span>{{formdata.calculationData.req.lenExDuct}} {{formdata.calculationData.req.lenExDuctUnitVal}}</span></p>
                <p>Exhaust Velocity* : <span>{{formdata.calculationData.req.exVel}} {{formdata.calculationData.req.exVelUnitVal}}</span></p>                     
            </div>
        </div>
    </div>
</template>
<script>
    var pdfContent = Vue.component('pdfContent', {
        template: '#pdfContent',
        props:['formdata','finalmodelmum','purpose','currenttab'],
        data: function () {
            return {
            };  
        },
        methods:{
            
        },
        mounted() {        
        },
        created(){
        }  
    })
</script>