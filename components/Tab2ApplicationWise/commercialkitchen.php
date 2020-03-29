<template id="commercialkitchen">
    <div>
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
                    <label for="numHoods">Number of Hoods</label>
                    <input type="number" name="numHoods" class="form-control" id="numHoods" placeholder="1" @input="inputChanged('numHoods')" v-model="numHoods">
                    <template v-if="errorMsgIndividual.numHoods!==''">
                        <div class="error mt-2">{{errorMsgIndividual.numHoods}}</div>
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
                <div class="form-group">
                    <label for="esp">ESP *</label>
                    <select class="form-control selectpicker" id="esp" v-model="espVal">
                        <option :value="v" v-for="v in esp" >{{v}}</option>
                    </select>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="typeCooking">Type of Cooking</label>
                    <select class="form-control selectpicker" id="typeCooking" v-model="typeCookingVal">
                        <option :value="v" v-for="v in typeCooking" >{{v}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var commercialkitchen = Vue.component('commercialkitchen', {
        template: '#commercialkitchen',
        data: function () {
            return {
                flowEA:'',
                flowEAUnit:['cfm','cmh'],
                flowEAUnitVal:'cfm',
                numHoods:'',
                lenExDuct:'',
                lenExDuctUnit:['ft','m'],
                lenExDuctUnitVal:'ft',
                esp:['Yes','No'],
                espVal:'No',
                exVel:'',
                exVelUnit:['fpm','fps','mph'],
                exVelUnitVal:'fpm',
                typeCooking:['Heavy','Medium','Light'],
                typeCookingVal:'Heavy',
                errorMsgIndividual:{
                    flowEA:'',
                    numHoods:'',
                    lenExDuct:'',
                    exVel:''
                },
            }
        },
        computed: {
            
        },
        methods:{
            inputChanged:function(v){
                let $this = this
                this.errorMsg = ''
                if(v=='flowEA'){
                    if ($this.flowEA && $this.validateFlowEA($this.flowEA)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateFlowEA($this.flowEA)[0]
                    }else{
                        $this.errorMsgIndividual[v] =  ''
                    }
                }else if(v=='numHoods'){
                    if ($this.numHoods && $this.validateNumHoods($this.numHoods)[1] == 1){
                        $this.errorMsgIndividual[v] =  $this.validateNumHoods($this.numHoods)[0]
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
            validateFlowEA:function(flowEA,optional){
                var flowEARegx = /^[0-9]*$/g;
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
                    return ["Invalid flow value ",1];
				}
				else
				{
					return [" ",0];
                }
            },
            validateNumHoods:function(numHoods,optional){
                var numHoodsRegx = /^[0-9]*$/g
                var $this = this
				if(numHoods == "" && optional == 1)
				{
					return [" ",0];
				}
                if(numHoods.length > 8)
				{
					return ["Number of hoods cannot exceed 7 digits", 1];
				}
				else if(numHoods.length < 1)
				{
					return ["Number of hoods cannot be less than 1 digits",1];
                }
                else if(!numHoodsRegx.test(numHoods))
				{
                    return ["Invalid number of hoods",1];
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
                        espVal: $this.espVal,
                        exVel:$this.exVel,
                        exVelUnitVal:$this.exVelUnitVal
                    },
                    nonReq:{
                        numHoods:$this.numHoods,
                        typeCookingVal:$this.typeCookingVal
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