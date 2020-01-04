<template id="welcomeMsg">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="100" height="100" class="rounded-circle block">
                <h4>Welcome To Chemtronics</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">"Prosoft" Software</h5>
                <p class="card-text">Specially made for Architects & MEP Consultants. This can also be used by Professionals, Contractors, Channel Partners, Dealers OEMs & End Users.</p>
                <p class="card-text">This software helps you selecting suitable model for treatment of Air, Water & Waste water for diversified Industries & Applications.</p>
            </div>
            <div class="card-footer text-muted">
                V1.1
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