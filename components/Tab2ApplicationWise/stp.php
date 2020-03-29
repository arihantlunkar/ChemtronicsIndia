<template id="Stp">
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="stpRA">Total STP Room Area *</label>
                            <input type="number" name="stpRA" class="form-control" id="stpRA" placeholder="5" @input="inputChanged('stpRA')" v-model="stpRA">
                            <template v-if="errorMsgIndividual.stpRA!==''">
                                <div class="error mt-2">{{errorMsgIndividual.stpRA}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stpRAUnit">Unit</label>
                            <select class="form-control selectpicker" id="stpRAUnit" v-model="stpRAUnitVal">
                                <option :value="unit" v-for="unit in stpRAUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="stpRH">STP Room Height *</label>
                            <input type="number" name="stpRH" class="form-control" id="stpRH" placeholder="0.5" @input="inputChanged('stpRH')" v-model="stpRH">
                            <template v-if="errorMsgIndividual.stpRH!==''">
                                <div class="error mt-2">{{errorMsgIndividual.stpRH}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stpRHUnit">Unit</label>
                            <select class="form-control selectpicker" id="stpRHUnit" v-model="stpRHUnitVal">
                                <option :value="unit" v-for="unit in stpRHUnit" >{{unit}}</option>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="acph">ACPH</label>
                    <input type="number" name="acph" class="form-control" id="acph" v-bind:value="calcACPH" readonly>
                    <template v-if="acph && acph<30">
                        <div class="text-warning mt-2"><i class="fa fa-info-circle mr-1"></i>{{acphInfo}}</div>
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
    var Stp = Vue.component('Stp', {
        template: '#Stp',
        data: function () {
            return {
                stpRA:'',
                stpRAUnit:['m2','ft2'],
                stpRAUnitVal:'m2',
                stpRH:'',
                stpRHUnit:['m','ft'],
                stpRHUnitVal:'m',
                flowEA:'',
                flowEAUnit:['cfm','cmh'],
                flowEAUnitVal:'cfm',
                acph:'',
                lenExDuct:'',
                lenExDuctUnit:['ft','m'],
                lenExDuctUnitVal:'ft',
                exVel:'',
                exVelUnit:['fpm','fps','mph'],
                exVelUnitVal:'fpm',
                errorMsgIndividual:{
                    stpRA:'',
                    stpRH:'',
                    flowEA:'',
                    lenExDuct:'',
                    exVel:''
                },
                acphInfo:''
            }
        },
        computed: {
            calcACPH:function(){
                var $this = this
                var a,h,f
                if($this.stpRA && $this.stpRH && $this.flowEA){
                    if($this.stpRAUnitVal=="ft2"){
                        a = $this.stpRA * 0.09290304
                    }else{
                        a = $this.stpRA
                    }
                    if($this.stpRHUnitVal=="ft"){
                        h = $this.stpRH * 0.3048
                    }else{
                        h = $this.stpRH
                    }
                    if($this.flowEAUnitVal=="cfm"){
                        f = $this.flowEA * 1.699
                    }else{
                        f = $this.flowEA
                    }
                    $this.acph = (f/(a*h)).toFixed(2)
                    if($this.acph<30){
                        $this.acphInfo = "Minimum ACPH value should be greater than or equal to 30 for better result (ACPH >= 30)"
                    }
                }else{
                    $this.acph = ""
                }                
                return $this.acph
            },
        },
        methods:{
            inputChanged:function(v){
                let $this = this
                this.errorMsg = ''
                if(v=='stpRA'){
                    if ($this.stpRA && $this.validateStpRA($this.stpRA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateStpRA($this.stpRA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='stpRH'){
                    if ($this.stpRH && $this.validateStpRH($this.stpRH)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateStpRH($this.stpRH)[0]
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
            validateStpRA:function(stpRA,optional){
                var stpRARegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(stpRA == "" && optional == 1)
				{
					return [" ",0];
				}
				if(stpRA == '')
				{
					return ["Room area cannot be blank",1];
				}
				else if(stpRA.length > 7)
				{
					return ["Room area cannot exceed 7 digits", 1];
				}
				else if(stpRA.length < 1)
				{
					return ["Room area cannot be less than 1 digits",1];
                }
                else if(!stpRARegx.test(stpRA) && stpRA.length > 5)
				{
                    return ["Invalid room area, ",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateStpRH:function(stpRH,optional){
                var stpRHRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(stpRH == "" && optional == 1)
				{
					return [" ",0];
				}
				if(stpRH == '')
				{
					return ["Room height cannot be blank",1];
				}
				else if(stpRH.length > 7)
				{
					return ["Room height cannot exceed 7 digits", 1];
				}
				else if(stpRH.length < 1)
				{
					return ["Room height cannot be less than 1 digits",1];
                }
                else if(!stpRHRegx.test(stpRH) && stpRH.length > 5)
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
                        flowEA: $this.flowEA,
                        flowEAUnitVal: $this.flowEAUnitVal,
                        lenExDuct: $this.lenExDuct,
                        lenExDuctUnitVal: $this.lenExDuctUnitVal,
                        exVel:$this.exVel,
                        exVelUnitVal:$this.exVelUnitVal,
                        stpRA: $this.stpRA,
                        stpRAUnitVal: $this.stpRAUnitVal,
                        stpRH: $this.stpRH,
                        stpRHUnitVal: $this.stpRHUnitVal,
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
        },
    })
</script>