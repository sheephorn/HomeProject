let login = new Vue({
    el: '#loginbox',
    data: {
        showLogin: true,
        showRegist: false
    },
    methods: {
        toggleLoginAndRegist: function(){
            this.showLogin = !this.showLogin;
            this.showRegist = !this.showRegist;
        }
    }
});

removeOneTimeHiddenClass();
