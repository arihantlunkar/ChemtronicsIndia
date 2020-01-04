<template id="vueNavbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="./assets/img/chemtronics-logo.gif" width="175"  class="d-inline-block align-bottom" alt=""> PROSOFT V1.1
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">            
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-5">
                <li class="nav-item" :class="hasChildren(m)?'dropdown':''" v-for="(m,i) in navbarMenu">
                    <a class="nav-link" :href="m.link" :id="hasChildren(m)?'navbarDropdown':''" :class="hasChildren(m)?'dropdown-toggle':''" :data-toggle="hasChildren(m)?'dropdown':''">{{m.name}}</a>
                    <template v-if="hasChildren(m)">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div v-for="g in m.childrens">
                                <ul>
                                    <li v-for="l in g.list">
                                        <a class="dropdown-item" :href="l.link">{{l.name}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </template>   
                </li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <span class="d-inline-block">Welcome! Vivek Lunkar</span>
                <a class="nav-link dropdown-toggle d-inline-block" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right pullDown" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Log Out</a>
                </div>
            </li>   
        </ul>
    </nav>
</template>
<script>
    var vueNavbar = Vue.component('vueNavbar', {
        template: '#vueNavbar',
        data: function () {
            return {
                navbarMenu: {}
            };  
        },
        methods:{
            hasChildren:function(m){
                let $this = this
                if(m.childrens && m.childrens.length > 0){
                    return true
                }else{
                    return false
                }
            },
            getMenu:function(){
                let $this = this
                fetch('components/menu.json?v1.1')
                .then((res) => {
                    return res.json();
                }).then((myJson) => {
                    $this.navbarMenu = myJson.mainMenu
                });
            },
        },
        mounted() {
        
        },
        created(){
            this.getMenu()
        }  
    })
</script>