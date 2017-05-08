let getSetDocumentListCallback = function(ele) {
    let callback = function(data) {
        createLog(data);
        if (data !== undefined　&& data.code !== undefined) {
            if (data.code === RESPONSE.OK) {
                list.list = data.data;
            } else if (data.code === RESPONSE.NG) {
                list.message = data.message;
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
    list: true,
};

let list = new Vue({
    el: '#list',
    data: {
        toggleTarget: toggleTarget,
        lists: {},
        message: '',
        dom: $('#list')
    },
    methods: {
        //
    },
    computed: {
        showlist: function() {
            return this.toggleTarget.list;
        },
        searchCondition: function() {
            return {};
        }
    },
    created: function() {
        execAjax(this.dom.data('action'), this.searchCondition, getSetDocumentListCallback(), getFailCallback());
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
