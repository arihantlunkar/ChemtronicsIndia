<?php
    require_once './components/auth/login-form.php';
?>
<template id="login">
    <div class="container">
        <div class="row mt-5">
            <login-form ></login-form>
        </div>
    </div>
</template>
<script>
    var login = Vue.component('login', {
        template: '#login',
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