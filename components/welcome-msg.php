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
            <div class="card-footer">
                <span class="solution-name mr-1">PROSOFT V1.5,</span> A Solution of <a href="https://www.chemtronicsindia.com/" target="_blank" class="main-website">Chemtronicsindia.com</a>
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