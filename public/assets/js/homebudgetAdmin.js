let getAddHomeBudgetCallback = function(ele) {
    let callback = function(data) {
        createLog(data);
        if (data !== undefined　&& data.code !== undefined) {
            if (data.code === RESPONSE.OK) {
                add.addMessage = data.message;
            } else if (data.code === RESPONSE.NG) {
                add.addMessage = data.message;
            }
        } else {
            createLog('NG');
        }
    }
    return callback;
}

// divの表示を制御
// 画面内のdivの表示条件をすべてこのオブジェクトで管理
let toggleTarget = {
    add: false,
};

Vue.component('add-button', {
    template: '<button type="button" class="btn btn-success" v-bind:class="{disabled : ret}" v-bind="{disabled : ret}" v-text="text" @click="add"></button>',
    props: ['login', 'text', 'action'],
    computed: {
        ret : function(){
            return false;
        }
    },
    methods: {
        add: function(event) {
            createLoadingGif(event.target);
            execAjax(this.action, add.addFormObj, getAddHomeBudgetCallback(), getFailCallback());
        },
    }
});

let add = new Vue({
    el: '#add',
    data: {
        homebudgetName:'',
        addMessage: '',
        toggleTarget: toggleTarget
    },
    methods: {
        //
    },
    computed: {
        addFormObj : function() {
            return {
                name: this.homebudgetName
            }
        },
        showadd: function() {
            return this.toggleTarget.add;
        }
    }
});

let buttons = new Vue({
    el: '#buttons',
    data: {
        show: '',
    },
    methods: {
        toggleDiv: function(ele) {
            toggleTarget[this.show] = false;
            this.show = ele;
            toggleTarget[ele] = true;
        }
    }
});

removeOneTimeHiddenClass();
