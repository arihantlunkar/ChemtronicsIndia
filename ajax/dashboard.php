<?php
require_once '../components/welcome-msg.php';
require_once '../components/form-wizard.php';
?>
<template id="dashboard">
    <div class="container-fluid">
        <div class="row mt-5">
            <welcome-msg></welcome-msg>
            <form-wizard></form-wizard>
        </div>
    </div>
</template>
<script>
    var dashboard = Vue.component('dashboard', {
        template: '#dashboard',
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