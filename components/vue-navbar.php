<template id="vueNavbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img src="./assets/img/chemtronics-logo.gif" width="175"  class="d-inline-block align-bottom" alt=""> PROSOFT V1.1
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">            
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-5">
                <li class="nav-item pages" :class="getActiveClass(m)" v-for="(m,i) in navbarMenu">                
                    <a class="nav-link" :href="m.link" :id="hasChildren(m)?'navbarDropdown':''" :class="hasChildren(m)?'dropdown-toggle':''" :data-toggle="hasChildren(m)?'dropdown':''"><i class="mr-2" :class="m.icon"></i> {{m.name}}</a>
                    <template v-if="hasChildren(m)">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" v-for="l in m.childrens[0].list" :href="l.link"><i class="fa fa-angle-double-right mr-2" aria-hidden="true"></i> {{l.name}}</a>
                        </div>
                    </template>   
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <span class="d-inline-block font-weight-semibold hidden-xs">Welcome! Vivek Lunkar</span>
                    <a class="nav-link dropdown-toggle d-inline-block pt-0 pb-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle profile-img">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pullDown" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fa fa-sign-out mr-2" aria-hidden="true"></i> Log Out</a>
                    </div>
                </li>   
            </ul>
        </div>        
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
        computed:{
            currentUrl() {
                return this.$root.currentUrl
            },
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
            getActiveClass:function(v){
                var $this = this
                let className = ''
                if(v.link){
                    let urlwithouthash = v.link.replace('#', '');
                    if(urlwithouthash === $this.currentUrl){
                        className += 'active'
                    } 
                }else if(v.childrens && v.childrens.length > 0){
                    className += 'dropdown'
                    v.childrens.forEach(function(list, i) {
                        for(p in list){
                            list[p].forEach(function(l, i) {
                                let urlwithouthash = l.link.replace('#', '');
                                if(urlwithouthash === $this.currentUrl){
                                    className += ' active'
                                } 
                            })
                        }
                    })
                }              
                return className
            }
        },
        mounted() {
        
        },
        created(){
            this.getMenu()
        }  
    })
</script>