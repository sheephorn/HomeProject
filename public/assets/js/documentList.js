/**
 * リストデータ設定コールバック取得関数
 */
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

/**
 * 書類追加コールバック取得関数
 */
let getAddDocumentCallbak = function(ele) {
    let callback = function(data) {
        createLog(data);
        if (data !== undefined　&& data.code !== undefined) {
            if (data.code === RESPONSE.OK) {
                //
            } else if (data.code === RESPONSE.NG) {
                //
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
    add: false,
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

let add = new Vue({
    el: '#add',
    data: {
        toggleTarget: toggleTarget,
        message: '',
        dom: $('#add'),
        // model
        folderId: '',
        folderName: '',
        address: '',
        homebudgetId: '',
        title: '',
        important: '',
        description: '',
        tags: '',
        limitDate: '',
        // attr
        //
        // flag
        check_limit_days: false,
        limit_target: '',
    },
    computed: {
        showadd: function() {
            return this.toggleTarget.add;
        },
        formObj : function() {
            return {
                folderId: this.folderId,
                folderName: this.folderName,
                address: this.address,
                homebudgetId: this.homebudgetId,
                title: this.title,
                important: this.important,
                description: this.description,
                tags: this.tags,
                limitDate: this.limitDate,
            };
        },
        disabled_limit_ammount: function() {
            return this.limit_target === 'date' ? false : true;
        }
    },
    methods: {
        add: function(action) {
            createLoadingGif(event.target);
            execAjax(action, this.formObj, getAddDocumentCallbak(), getFailCallback());
        },
        toggleFlag: function(attr) {
            this[attr] = !this[attr];
        }
    }
})

let buttons = new Vue({
    el: '#buttons',
    data: {
        show: 'list',
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
