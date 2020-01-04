<template id="usersInfo">
    <div class="">{{text}}</div>
</template>
<script>
    var usersInfo = Vue.component('usersInfo', {
        template: '#usersInfo',
        data: function () {
            return {
                text:'Users Info Datatable'
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