<?php
    require_once './components/auth/register-form.php';
?>
<template id="register">
    <div class="container-fluid">
        <div class="row mt-5">
            <register-form></register-form>
        </div>
    </div>
</template>
<script>
    var register = Vue.component('register', {
        template: '#register',
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