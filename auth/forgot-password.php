<?php
    require_once './components/auth/forgot-password-form.php';
?>
<template id="forgotPassword">
    <div class="container-fluid">
        <div class="row mt-5">
            <forgot-password-form></forgot-password-form>
        </div>
    </div>
</template>
<script>
    var forgotPassword = Vue.component('forgotPassword', {
        template: '#forgotPassword',
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