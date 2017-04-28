Vue.component('auto-button', {
    template: '<button type="submit" class="btn btn-success" v-bind:class="{disabled : ret}" v-bind="{disabled : ret}">自動ログイン</button>',
    props: ['login'],
    computed: {
        ret : function(){
            return Number(this.login) ? false : true;
        }
    }
});

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
