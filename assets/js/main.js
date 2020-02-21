var mainPage = new Vue({
    el: '#mainPage',
    data: function () {
        return {           
            currentUrl: '',
            currentPage: '',            
        }
    },
    computed: {
        currentTemplate() {
            return this.currentPage
        },
    },
    watch: {
        currentUrl: function (newUrl, oldUrl) {
            if (oldUrl !== newUrl) {
                this.loadURL(newUrl)
            }
        }
    },
    methods: {
        loadURL: function (url) {
            let $this = this 
            $('#pageLoader').show(); 
            let container = $('#content');
            let fetchMethod = new Fetchmethod()
            let loadPage = fetchMethod.getUrl(url)
            loadPage.then((response) => {
                $this.currentPage = ''
                container.html('')
                $('#pageLoader').hide();
                container.html(response.data)
            })
            .then(r => {
                $this.afterPageLoad(url)
            })
            .catch((err) => {
                
            });
        },
        afterPageLoad: function (url) {
            let $this = this   
            $('#pageLoader').hide();         
            if (url){
                let urlwithparameter = url.split('?')
                let pageName = urlwithparameter[0].replace('ajax/', '').replace('.php', '')
                let obj = $this.getTemplateDetails(pageName)
                $this.loadTemplate(obj)
            }
        },
        getTemplateDetails:function(page){
            let p = page.split('-')
            let newPage = []
            p.forEach((e,i)=>{
                if(i==0){
                    newPage.push(e) 
                }else{
                    let e1 = e.split('')
                    e1[0] = e1[0].toUpperCase()
                    e = e1.join('')
                    newPage.push(e) 
                }
            })
            let obj = {
                template: newPage.join(''),
                templateName: page
            }
            return obj
        },
        loadTemplate:function(e){
            let $this = this
            $this.$options.components[e.templateName] = Vue.options.components[e.template]
            $this.currentPage = e.templateName
        },
    },
    created() {
        this.currentUrl = location.hash.replace(/^#/, ''); 
    },
    mounted() {
        var $this = this
        $(window).on('hashchange', function () {
            $this.currentPage = ''
            $this.currentUrl = location.hash.replace(/^#/, '');
        });
    },
    updated(){
        $('.selectpicker').selectpicker();
    }
})