var authApp = new Vue({
    el: '#authApp',
    data: function () {
        return {  
            currentTemplate:'login',
        }
    },
    computed: {
        
    },
    watch: {
        
    },
    methods: {    
    },
    created() {
    },
    mounted() {
        var $this = this        
    },
    updated(){
        $('.selectpicker').selectpicker();
    }
})