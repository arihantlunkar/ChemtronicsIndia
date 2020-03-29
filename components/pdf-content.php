<template id="pdfContent">
    <div style="font-family:Montserrat,Helvetica,Arial,sans-serif;">
        <h2 style="font-size:20px;">User Technical Requirement For <span style="color:#02b389">{{finalNum.value}}</span></h2>
        <div>
            <h4>Basic Details</h4>
            <p>Solution: <span>{{formdata.CS}}</span></p>
            <p>Type: <span>{{formdata.CT}}</span></p>
            <p>Application: <span>{{formdata.CA.value}}</span><span v-if="formdata.CA.value == 'Commercial | Institutional'"> - {{formdata.CACTValue}}</span><span v-if="formdata.CACTValue=='Other'"> - {{formdata.CACTOValue}}</span><span v-if="formdata.CA.value == 'Manufacturing Company'"> - {{formdata.CAMTValue}}</span><span v-if="formdata.CAMTValue=='Other'"> - {{formdata.CAMTOValue}}</span></p>
            <p>Purpose: <span>{{formdata.purpose.value[0]}}</span></p>
            <p v-if="purpose.value.includes('Other')">Other Purpose: <span>{{formdata.otherPurpose.value}}</span></p>
            <p v-if="formdata.CT=='Indoor'">Air Conditioning: <span v-if="formdata.CACValue.length>0">{{formdata.CACValue[0]}}</span></p>
            <p v-if="formdata.CACValue.includes('Other')">Other Air Conditioning: <span>{{formdata.COACValue}}</span></p>
            <p v-if="formdata.CT=='Indoor'">Visitor / Customer movement: <span>{{formdata.COACValue}}</span></p>
        </div>
        <div>
            <h4>Technical requirements</h4>
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
            <div v-if="formdata.CA.type == 'Exhaust' && (formdata.CA.value == 'Garbage Room' || formdata.CA.value == 'Waste Segregation Room' || formdata.CA.value == 'Washroom') && currenttab === 2">
                <p>Room Area* : <span>{{formdata.calculationData.req.wgwRA}} {{formdata.calculationData.req.wgwRAUnitVal}}</span></p>
                <p>Room Height* : <span>{{formdata.calculationData.req.wgwRH}} {{formdata.calculationData.req.wgwRHUnitVal}}</span></p>
                <p>Flow of Exhaust Air* : <span>{{formdata.calculationData.req.flowEA}} {{formdata.calculationData.req.flowEAUnitVal}}</span></p>
                <p>ACPH : <span>{{formdata.calculationData.nonReq.acph}}</span></p>
            </div>
            <div v-if="formdata.CA.type == 'Indoor' && (formdata.CA.value == 'Commercial | Institutional' || formdata.CA.value == 'Manufacturing Company') && currenttab === 2">
                <p>Room Area* : <span>{{formdata.calculationData.req.cmRA}} {{formdata.calculationData.req.cmRAUnitVal}}</span></p>
                <p>Room Height* : <span>{{formdata.calculationData.req.cmRH}} {{formdata.calculationData.req.cmRHUnitVal}}</span></p>
                <p>Recirculating Air Flow : <span>{{formdata.calculationData.nonReq.rAirFlow}} {{formdata.calculationData.nonReq.rAirFlowUnitVal}}</span></p>
                <p>Fresh Air Flow : <span>{{formdata.calculationData.nonReq.fAirFlow}} {{formdata.calculationData.nonReq.fAirFlowUnitVal}}</span></p>
                <p>Refrigeration Tonnage : <span>{{formdata.calculationData.nonReq.rTonnage}} {{formdata.calculationData.nonReq.rTonnageUnitVal}}</span></p>
                <p>Air Changes Per Hour : <span>{{formdata.calculationData.nonReq.airChangeHr}}</span></p>
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
        computed:{
            finalNum(){
                var str = this.finalmodelmum
                var x = str.split("Model number is : ");
                return{
                    value:x[1]
                }
            }
        },
        methods:{
            
        },
        mounted() {        
        },
        created(){
        }  
    })
</script>