<template id="welcomeMsg">
    <div class="col-md-4">
        <div class="card text-center welcome-msg">
            <div class="card-header">
                <h4>Welcome To Chemtronics</h4>
                <h5>"Prosoft" Software</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Specially made for Architects & MEP Consultants. This can also be used by Professionals, Contractors, Channel Partners, Dealers OEMs & End Users.</p>
                <p class="card-text">This software helps you selecting suitable model for treatment of Air, Water & Waste water for diversified Industries & Applications.</p>
            </div>
            <div class="card-footer text-muted">
                V1.2
            </div>
        </div>
    </div>
</template>
<script>
    var welcomeMsg = Vue.component('welcomeMsg', {
        template: '#welcomeMsg',
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