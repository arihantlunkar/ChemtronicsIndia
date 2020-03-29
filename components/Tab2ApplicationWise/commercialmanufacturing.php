<template id="commercialmanufacturing">
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="cmRA">Room Area *</label>
                            <input type="number" name="cmRA" class="form-control" id="cmRA" placeholder="5" @input="inputChanged('cmRA')" v-model="cmRA">
                            <template v-if="errorMsgIndividual.cmRA!==''">
                                <div class="error mt-2">{{errorMsgIndividual.cmRA}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cmRAUnit">Unit</label>
                            <select class="form-control selectpicker" id="cmRAUnit" v-model="cmRAUnitVal">
                                <option :value="unit" v-for="unit in cmRAUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="cmRH">Room Height *</label>
                            <input type="number" name="cmRH" class="form-control" id="cmRH" placeholder="0.5" @input="inputChanged('cmRH')" v-model="cmRH">
                            <template v-if="errorMsgIndividual.cmRH!==''">
                                <div class="error mt-2">{{errorMsgIndividual.cmRH}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cmRHUnit">Unit</label>
                            <select class="form-control selectpicker" id="cmRHUnit" v-model="cmRHUnitVal">
                                <option :value="unit" v-for="unit in cmRHUnit" >{{unit}}</option>
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
                            <label for="rAirFlow">Recirculating Air Flow</label>
                            <input type="number" name="rAirFlow" class="form-control" id="rAirFlow" placeholder="5" @input="inputChanged('rAirFlow')" v-model="rAirFlow">
                            <template v-if="errorMsgIndividual.rAirFlow!==''">
                                <div class="error mt-2">{{errorMsgIndividual.rAirFlow}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rAirFlowUnit">Unit</label>
                            <select class="form-control selectpicker" id="rAirFlowUnit" v-model="rAirFlowUnitVal">
                                <option :value="unit" v-for="unit in rAirFlowUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 pr-0">
                        <div class="form-group">
                            <label for="fAirFlow">Fresh Air Flow</label>
                            <input type="number" name="fAirFlow" class="form-control" id="fAirFlow" placeholder="5" @input="inputChanged('fAirFlow')" v-model="fAirFlow">
                            <template v-if="errorMsgIndividual.fAirFlow!==''">
                                <div class="error mt-2">{{errorMsgIndividual.fAirFlow}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fAirFlowUnit">Unit</label>
                            <select class="form-control selectpicker" id="fAirFlowUnit" v-model="fAirFlowUnitVal">
                                <option :value="unit" v-for="unit in fAirFlowUnit" >{{unit}}</option>
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
                            <label for="rTonnage">Refrigeration Tonnage</label>
                            <input type="number" name="rTonnage" class="form-control" id="rTonnage" placeholder="0.5" @input="inputChanged('rTonnage')" v-model="rTonnage">
                            <template v-if="errorMsgIndividual.rTonnage!==''">
                                <div class="error mt-2">{{errorMsgIndividual.rTonnage}}</div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rTonnageUnit">Unit</label>
                            <select class="form-control selectpicker" id="rTonnageUnit" v-model="rTonnageUnitVal">
                                <option :value="unit" v-for="unit in rTonnageUnit" >{{unit}}</option>
                            </select>
                        </div>
                    </div>                                            
                </div>
            </div>                                    
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="airChangeHr">Air Changes Per Hour</label>
                            <input type="number" name="airChangeHr" class="form-control" id="airChangeHr" placeholder="0.5" @input="inputChanged('airChangeHr')" v-model="airChangeHr">
                            <template v-if="errorMsgIndividual.airChangeHr!==''">
                                <div class="error mt-2">{{errorMsgIndividual.airChangeHr}}</div>
                            </template>
                        </div>
                    </div>                                        
                </div>
            </div>            
        </div>
    </div>
</template>
<script>
    var commercialmanufacturing = Vue.component('commercialmanufacturing', {
        template: '#commercialmanufacturing',
        data: function () {
            return {
                cmRA:'',
                cmRAUnit:['m2','ft2'],
                cmRAUnitVal:'m2',
                cmRH:'',
                cmRHUnit:['m','ft'],
                cmRHUnitVal:'m',
                rAirFlow:'',
                rAirFlowUnit:['cfm','cmh'],
                rAirFlowUnitVal:'cfm',
                fAirFlow:'',
                fAirFlowUnit:['cfm','cmh'],
                fAirFlowUnitVal:'cfm',
                rTonnage:'',
                rTonnageUnit:['TR','Ton'],
                rTonnageUnitVal:'TR',
                airChangeHr:'',
                errorMsgIndividual:{
                    cmRA:'',
                    cmRH:'',
                    rAirFlow:'',
                    fAirFlow:'',
                    rTonnage:'',
                    airChangeHr:''
                },
            }
        },
        methods:{
            inputChanged:function(v){
                let $this = this
                this.errorMsg = ''
                if(v=='cmRA'){
                    if ($this.cmRA && $this.validateCmRA($this.cmRA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateCmRA($this.cmRA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='cmRH'){
                    if ($this.cmRH && $this.validateCmRH($this.cmRH)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateCmRH($this.cmRH)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='rAirFlow'){
                    if ($this.rAirFlow && $this.validateRAirFlow($this.rAirFlow)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateRAirFlow($this.rAirFlow)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='fAirFlow'){
                    if ($this.fAirFlow && $this.validateFAirFlow($this.fAirFlow)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateFAirFlow($this.fAirFlow)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='rTonnage'){
                    if ($this.rTonnage && $this.validateRTonnage($this.rTonnage)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateRTonnage($this.rTonnage)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='airChangeHr'){
                    if ($this.airChangeHr && $this.validateAirChangeHr($this.airChangeHr)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateAirChangeHr($this.airChangeHr)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }
            }, 
            validateCmRA:function(cmRA,optional){
                var cmRARegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(cmRA == "" && optional == 1)
				{
					return [" ",0];
				}
				if(cmRA == '')
				{
					return ["Room area cannot be blank",1];
				}
				else if(cmRA.length > 7)
				{
					return ["Room area cannot exceed 7 digits", 1];
				}
				else if(cmRA.length < 1)
				{
					return ["Room area cannot be less than 1 digits",1];
                }
                else if(!cmRARegx.test(cmRA) && cmRA.length > 5)
				{
                    return ["Invalid room area, ",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateCmRH:function(cmRH,optional){
                var cmRHRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(cmRH == "" && optional == 1)
				{
					return [" ",0];
				}
				if(cmRH == '')
				{
					return ["Room height cannot be blank",1];
				}
				else if(cmRH.length > 7)
				{
					return ["Room height cannot exceed 7 digits", 1];
				}
				else if(cmRH.length < 1)
				{
					return ["Room height cannot be less than 1 digits",1];
                }
                else if(!cmRHRegx.test(cmRH) && cmRH.length > 5)
				{
                    return ["Invalid room height, ",1];
				}
				else
				{
					return [" ",0];
                }
            },                        
            validateRAirFlow:function(rAirFlow,optional){
                var rAirFlowRegx = /^[0-9]*$/g;
                var $this = this
				if(rAirFlow == "" && optional == 1)
				{
					return [" ",0];
				}
                if(rAirFlow.length > 5)
				{
					return ["Recirculating Air Flow value cannot exceed 5 digits", 1];
				}
				else if(rAirFlow.length < 1)
				{
					return ["Recirculating Air Flow value cannot be less than 1 digits",1];
                }
                else if(!rAirFlowRegx.test(rAirFlow) || rAirFlow.length > 5)
				{
                    return ["Invalid Recirculating Air Flow value",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateFAirFlow:function(fAirFlow,optional){
                var fAirFlowRegx = /^[0-9]*$/g;
                var $this = this
				if(fAirFlow == "" && optional == 1)
				{
					return [" ",0];
				}
                if(fAirFlow.length > 5)
				{
					return ["Fresh Air Flow value cannot exceed 5 digits", 1];
				}
				else if(fAirFlow.length < 1)
				{
					return ["Fresh Air Flow value cannot be less than 1 digits",1];
                }
                else if(!fAirFlowRegx.test(fAirFlow) || fAirFlow.length > 5)
				{
                    return ["Invalid Fresh Air Flow value",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateRTonnage:function(rTonnage,optional){
                var rTonnageRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(rTonnage == "" && optional == 1)
				{
					return [" ",0];
				}
				else if(rTonnage.length > 7)
				{
					return ["Refrigeration Tonnage value cannot exceed 7 digits", 1];
				}
				else if(rTonnage.length < 1)
				{
					return ["Refrigeration Tonnage cannot be less than 1 digits",1];
                }
                else if(!rTonnageRegx.test(rTonnage))
				{
                    return ["Invalid Refrigeration Tonnage value",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateAirChangeHr:function(airChangeHr,optional){
                var airChangeHrRegx = /^(\d*\.)?\d+$/g;
                var $this = this
				if(airChangeHr == "" && optional == 1)
				{
					return [" ",0];
				}
				else if(airChangeHr.length > 3)
				{
					return ["Air Changes Per Hour value cannot exceed 3 digits", 1];
				}
				else if(airChangeHr.length < 1)
				{
					return ["Air Changes Per Hour cannot be less than 1 digits",1];
                }
                else if(!airChangeHrRegx.test(airChangeHr))
				{
                    return ["Invalid Air Changes Per Hour value",1];
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
                        cmRA: $this.cmRA,
                        cmRAUnitVal: $this.cmRAUnitVal,
                        cmRH: $this.cmRH,
                        cmRHUnitVal: $this.cmRHUnitVal,
                    },
                    nonReq:{
                        rAirFlow: $this.rAirFlow,
                        rAirFlowUnitVal: $this.rAirFlowUnitVal,
                        fAirFlow: $this.fAirFlow,
                        fAirFlowUnitVal: $this.fAirFlowUnitVal,
                        rTonnage: $this.rTonnage,
                        rTonnageUnitVal: $this.rTonnageUnitVal,
                        airChangeHr:$this.airChangeHr,
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