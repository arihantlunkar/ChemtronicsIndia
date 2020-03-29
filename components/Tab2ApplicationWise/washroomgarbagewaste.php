<template id="washroomgarbagewaste">
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="wgwRA">Room Area *</label>
                            <input type="number" name="wgwRA" class="form-control" id="wgwRA" placeholder="5" @input="inputChanged('wgwRA')" v-model="wgwRA">
                            <template v-if="errorMsgIndividual.wgwRA!==''">
                                <div class="error mt-2">{{errorMsgIndividual.wgwRA}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="wgwRAUnit">Unit</label>
                            <select class="form-control selectpicker" id="wgwRAUnit" v-model="wgwRAUnitVal">
                                <option :value="unit" v-for="unit in wgwRAUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="wgwRH">Room Height *</label>
                            <input type="number" name="wgwRH" class="form-control" id="wgwRH" placeholder="0.5" @input="inputChanged('wgwRH')" v-model="wgwRH">
                            <template v-if="errorMsgIndividual.wgwRH!==''">
                                <div class="error mt-2">{{errorMsgIndividual.wgwRH}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="wgwRHUnit">Unit</label>
                            <select class="form-control selectpicker" id="wgwRHUnit" v-model="wgwRHUnitVal">
                                <option :value="unit" v-for="unit in wgwRHUnit" >{{unit}}</option>
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
                    <template v-if="acph && acph<15">
                        <div class="text-warning mt-2"><i class="fa fa-info-circle mr-1"></i>{{acphInfo}}</div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var washroomgarbagewaste = Vue.component('washroomgarbagewaste', {
        template: '#washroomgarbagewaste',
        data: function () {
            return {
                wgwRA:'',
                wgwRAUnit:['m2','ft2'],
                wgwRAUnitVal:'m2',
                wgwRH:'',
                wgwRHUnit:['m','ft'],
                wgwRHUnitVal:'m',
                flowEA:'',
                flowEAUnit:['cfm','cmh'],
                flowEAUnitVal:'cfm',
                acph:'',
                errorMsgIndividual:{
                    wgwRA:'',
                    wgwRH:'',
                    flowEA:'',
                },
                acphInfo:''
            }
        },
        computed: {
            calcACPH:function(){
                var $this = this
                var a,h,f
                if($this.wgwRA && $this.wgwRH && $this.flowEA){
                    if($this.wgwRAUnitVal=="ft2"){
                        a = $this.wgwRA * 0.09290304
                    }else{
                        a = $this.wgwRA
                    }
                    if($this.wgwRHUnitVal=="ft"){
                        h = $this.wgwRH * 0.3048
                    }else{
                        h = $this.wgwRH
                    }
                    if($this.flowEAUnitVal=="cfm"){
                        f = $this.flowEA * 1.699
                    }else{
                        f = $this.flowEA
                    }
                    $this.acph = (f/(a*h)).toFixed(2)
                    if($this.acph<15){
                        $this.acphInfo = "Minimum ACPH value should be greater than or equal to 15 for better result (ACPH >= 15). Increase Flow of Exhaust Air"
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
                if(v=='wgwRA'){
                    if ($this.wgwRA && $this.validateWgwRA($this.wgwRA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateWgwRA($this.wgwRA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='wgwRH'){
                    if ($this.wgwRH && $this.validateWgwRH($this.wgwRH)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateWgwRH($this.wgwRH)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='flowEA'){
                    if ($this.flowEA && $this.validateFlowEA($this.flowEA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateFlowEA($this.flowEA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }
            }, 
            validateWgwRA:function(wgwRA,optional){
                var wgwRARegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(wgwRA == "" && optional == 1)
				{
					return [" ",0];
				}
				if(wgwRA == '')
				{
					return ["Room area cannot be blank",1];
				}
				else if(wgwRA.length > 7)
				{
					return ["Room area cannot exceed 7 digits", 1];
				}
				else if(wgwRA.length < 1)
				{
					return ["Room area cannot be less than 1 digits",1];
                }
                else if(!wgwRARegx.test(wgwRA) && wgwRA.length > 5)
				{
                    return ["Invalid room area, ",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateWgwRH:function(wgwRH,optional){
                var wgwRHRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(wgwRH == "" && optional == 1)
				{
					return [" ",0];
				}
				if(wgwRH == '')
				{
					return ["Room height cannot be blank",1];
				}
				else if(wgwRH.length > 7)
				{
					return ["Room height cannot exceed 7 digits", 1];
				}
				else if(wgwRH.length < 1)
				{
					return ["Room height cannot be less than 1 digits",1];
                }
                else if(!wgwRHRegx.test(wgwRH) && wgwRH.length > 5)
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
            formDataCK:function(){
                var $this = this
                var tab1Data
                tab1Data = {
                    req : {                        
                        flowEA: $this.flowEA,
                        flowEAUnitVal: $this.flowEAUnitVal,
                        wgwRA: $this.wgwRA,
                        wgwRAUnitVal: $this.wgwRAUnitVal,
                        wgwRH: $this.wgwRH,
                        wgwRHUnitVal: $this.wgwRHUnitVal,
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
        mounted() {
            $(".selectpicker").selectpicker("refresh");
        }
    })
</script>