let getAddHomeBudgetCallback = function(ele) {
    let callback = function(data) {
        if (data !== undefined　&& data.code !== undefined) {
            if (data.code === RESPONSE.OK) {

            } else if (data.code === RESPONSE.NG) {
                alert(data.message);
            }
        }
        createLog('NG');
    }
    return callback;
}

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
            createLog(this.action)
            execAjax(this.action, this.addFormObj, getAddHomeBudgetCallback(), getFailCallback());
        },
    }
});

let add = new Vue({
    el: '#add',
    data: {
        homebudgetName:''
    },
    methods: {
        //
    },
    computed: {
        addFormObj : function() {
            return {
                name: this.homebudgetName
            }
        }
    }
});



removeOneTimeHiddenClass();
