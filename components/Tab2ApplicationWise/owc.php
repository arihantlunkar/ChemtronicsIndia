<template id="Owc">
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="numOWC">Number of OWC *</label>
                    <input type="number" name="numOWC" class="form-control" id="numOWC" placeholder="1" @input="inputChanged('numOWC')" v-model="numOWC">
                    <template v-if="errorMsgIndividual.numOWC!==''">
                        <div class="error mt-2">{{errorMsgIndividual.numOWC}}</div>
                    </template>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="owcRA">OWC Room Area *</label>
                            <input type="number" name="owcRA" class="form-control" id="owcRA" placeholder="5" @input="inputChanged('owcRA')" v-model="owcRA">
                            <template v-if="errorMsgIndividual.owcRA!==''">
                                <div class="error mt-2">{{errorMsgIndividual.owcRA}}</div>
                            </template>
                            <template v-if="owcRAInfo!=''">
                                <div class="text-warning mt-2"><i class="fa fa-info-circle mr-1"></i>{{owcRAInfo}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="owcRAUnit">Unit</label>
                            <select class="form-control selectpicker" id="owcRAUnit" v-model="owcRAUnitVal">
                                <option :value="unit" v-for="unit in owcRAUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>                       
        </div>
        <div class="row"> 
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="owcRH">OWC Room Height *</label>
                            <input type="number" name="owcRH" class="form-control" id="owcRH" placeholder="0.5" @input="inputChanged('owcRH')" v-model="owcRH">
                            <template v-if="errorMsgIndividual.owcRH!==''">
                                <div class="error mt-2">{{errorMsgIndividual.owcRH}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="owcRHUnit">Unit</label>
                            <select class="form-control selectpicker" id="owcRHUnit" v-model="owcRHUnitVal">
                                <option :value="unit" v-for="unit in owcRHUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>                                               
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="flowEA">Flow of Exhaust Air *</label>
                            <input type="number" name="flowEA" class="form-control" id="flowEA" placeholder="5" @input="inputChanged('flowEA')" v-model="flowEA">
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
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="acph">ACPH</label>
                    <input type="number" name="acph" class="form-control" id="acph" v-bind:value="calcACPH" readonly>
                    <template v-if="acph && acph<50">
                        <div class="text-warning mt-2"><i class="fa fa-info-circle mr-1"></i>{{acphInfo}}</div>
                    </template>
                </div>
            </div>
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
        </div>
    </div>
</template>
<script>
    var Owc = Vue.component('Owc', {
        template: '#Owc',
        data: function () {
            return {
                numOWC:'',
                owcRA:'',
                owcRAUnit:['m2','ft2'],
                owcRAUnitVal:'m2',
                owcRH:'',
                owcRHUnit:['m','ft'],
                owcRHUnitVal:'m',
                flowEA:'',
                flowEAUnit:['cfm','cmh'],
                flowEAUnitVal:'cfm',
                acph:'',
                lenExDuct:'',
                lenExDuctUnit:['ft','m'],
                lenExDuctUnitVal:'ft',
                exVel:'',
                exVelUnit:['fpm','fps','mps'],
                exVelUnitVal:'fpm',
                errorMsgIndividual:{
                    numOWC:'',
                    owcRA:'',
                    owcRH:'',
                    flowEA:'',
                    lenExDuct:'',
                    exVel:''
                },
                acphInfo:'',
                owcRAInfo:''
            }
        },
        computed: {
            calcACPH:function(){
                var $this = this
                var a,h,f
                if($this.owcRA && $this.owcRH && $this.flowEA){
                    if($this.owcRAUnitVal=="ft2"){
                        a = $this.owcRA * 0.09290304
                    }else{
                        a = $this.owcRA
                    }
                    if($this.owcRHUnitVal=="ft"){
                        h = $this.owcRH * 0.3048
                    }else{
                        h = $this.owcRH
                    }
                    if($this.flowEAUnitVal=="cfm"){
                        f = $this.flowEA * 1.699
                    }else{
                        f = $this.flowEA
                    }
                    $this.acph = (f/(a*h)).toFixed(2)
                    if($this.acph<50){
                        $this.acphInfo = "Minimum ACPH value should be greater than or equal to 50 for better result (ACPH >= 50)"
                    }
                }else{
                    $this.acph = ""
                }                
                return $this.acph
            },
            calcAreaPerOWC:function(){
                var $this = this
                var a,x
                if($this.owcRA && $this.numOWC){
                    if($this.owcRAUnitVal=="ft2"){
                        a = $this.owcRA * 0.09290304
                    }else{
                        a = $this.owcRA
                    }
                    x = $this.numOWC * 50
                    if(a<x){
                        $this.owcRAInfo = "Area for per OWC is not sufficient"
                    }else if(a>=x){
                        $this.owcRAInfo = ''
                    }
                }              
                return $this.owcRAInfo
            },
        },
        methods:{
            inputChanged:function(v){
                let $this = this
                this.errorMsg = ''
                if(v=='numOWC'){
                    if ($this.numOWC && $this.validateNumOWC($this.numOWC)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateNumOWC($this.numOWC)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='owcRA'){
                    if ($this.owcRA && $this.validateOwcRA($this.owcRA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateOwcRA($this.owcRA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='owcRH'){
                    if ($this.owcRH && $this.validateOwcRH($this.owcRH)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateOwcRH($this.owcRH)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='flowEA'){
                    if ($this.flowEA && $this.validateFlowEA($this.flowEA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateFlowEA($this.flowEA)[0]
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
            validateNumOWC:function(numOWC,optional){
                var numOWCRegx = /^[0-9]*$/g
                var $this = this
				if(numOWC == "" && optional == 1)
				{
					return [" ",0];
				}
                if(numOWC.length > 8)
				{
					return ["Number of OWC cannot exceed 7 digits", 1];
				}
				else if(numOWC.length < 1)
				{
					return ["Number of OWC cannot be less than 1 digits",1];
                }
                else if(!numOWCRegx.test(numOWC))
				{
                    return ["Invalid number of OWC",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateOwcRA:function(owcRA,optional){
                var owcRARegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(owcRA == "" && optional == 1)
				{
					return [" ",0];
				}
				if(owcRA == '')
				{
					return ["Room area cannot be blank",1];
				}
				else if(owcRA.length > 7)
				{
					return ["Room area cannot exceed 7 digits", 1];
				}
				else if(owcRA.length < 1)
				{
					return ["Room area cannot be less than 1 digits",1];
                }
                else if(!owcRARegx.test(owcRA) && owcRA.length > 5)
				{
                    return ["Invalid room area, ",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateOwcRH:function(owcRH,optional){
                var owcRHRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(owcRH == "" && optional == 1)
				{
					return [" ",0];
				}
				if(owcRH == '')
				{
					return ["Room height cannot be blank",1];
				}
				else if(owcRH.length > 7)
				{
					return ["Room height cannot exceed 7 digits", 1];
				}
				else if(owcRH.length < 1)
				{
					return ["Room height cannot be less than 1 digits",1];
                }
                else if(!owcRHRegx.test(owcRH) && owcRH.length > 5)
				{
                    return ["Invalid room height, ",1];
				}
				else
				{
					return [" ",0];
                }
            },                        
            validateFlowEA:function(flowEA,optional){
                var flowEARegx = /^[0-9]*$/gm;
                var $this = this
				if(flowEA == "" && optional == 1)
				{
					return [" ",0];
				}
				if(flowEA == '')
				{
					return ["Flow value cannot be blank",1];
				}
				else if(flowEA.length > 5)
				{
					return ["Flow value cannot exceed 5 digits", 1];
				}
				else if(flowEA.length < 1)
				{
					return ["Flow value cannot be less than 1 digits",1];
                }
                else if(!flowEARegx.test(flowEA) || flowEA.length > 5)
				{
                    return ["Invalid flow value, ",1];
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
            formDataCK:function(){
                var $this = this
                var tab1Data
                tab1Data = {
                    req : {  
                        numOWC:$this.numOWC,
                        flowEA: $this.flowEA,
                        flowEAUnitVal: $this.flowEAUnitVal,
                        lenExDuct: $this.lenExDuct,
                        lenExDuctUnitVal: $this.lenExDuctUnitVal,
                        exVel:$this.exVel,
                        exVelUnitVal:$this.exVelUnitVal,
                        owcRA: $this.owcRA,
                        owcRAUnitVal: $this.owcRAUnitVal,
                        owcRH: $this.owcRH,
                        owcRHUnitVal: $this.owcRHUnitVal,
                    },
                    nonReq:{
                        acph:$this.acph
                    }
                }  
                var array = Object.values($this.errorMsgIndividual)
                var boolean = array.some(function(e){
                    if(e!=''){
                        return e
                    }
                })
                if(boolean){
                    $this.$emit('calculationdata', {})
                }else{
                    $this.$emit('calculationdata', tab1Data)
                }
            }
        },
        updated: function() {
            this.formDataCK()
            this.calcAreaPerOWC
        },
    })
</script>