/**
 * テキストをSHA256変換する
 */
let getSha256 = function(text) {
    var ret = '';
    if (text !== '' && text !== undefined) {
        var shaObj = new jsSHA("SHA-256", 'TEXT');
        shaObj.update(text);
        ret = shaObj.getHash("B64");
    }
    return ret;
}

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
        showRegist: false,
        registPassword: '',
        loginPassword: ''
    },
    methods: {
        toggleLoginAndRegist: function(){
            this.showLogin = !this.showLogin;
            this.showRegist = !this.showRegist;
        }
    },
    computed: {
        convertRegistPassword: function() {
            return getSha256(this.registPassword);
        },
        convertLoginPassword: function() {
            return getSha256(this.loginPassword);
        }
    }
});



removeOneTimeHiddenClass();
