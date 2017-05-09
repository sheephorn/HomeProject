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
        // const
        constLimitDate: 'date',
        constLimitDays: 'days',
        constLimitInfinite: 'infinite',
        constLimitDaysUnitDay: 'days',
        constLimitDaysUnitMonth: 'months',
        constLimitDaysUnitYear: 'years',
        maxDays: 3, // 指定日数の最大桁数
        // subject
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
        // attr
        limitDate: '',
        limitDays: '',
        limitDaysUnit: '',
        // flag
        check_limit_days: false,
        limit_target: '', //初期値は無期限でセット
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
                limitDate: this.conbertedLimitDate,
            };
        },
        disabled_limit_days: function() {
            return this.limit_target === this.constLimitDays ? false : true;
        },
        disabled_limit_infinite: function() {
            return this.limit_target === this.constLimitInfinite ? false : true;
        },
        disabled_limit_date: function() {
            return this.limit_target === this.constLimitDate ? false : true;
        },
        conbertedLimitDate: function() {
            let date;
            if (this.limit_target === this.constLimitDays) {
                date = moment().add(this.limitDays, this.limitDaysUnit).format(STANDARD_DATE_FORMAT);
            } else if (this.limit_target === this.constLimitInfinite) {
                date = '';
            } else if (this.limit_target === this.constLimitDate) {
                date = this.limitDate
            }
            return date;
        }
    },
    watch: {
        limitDays: function(val) {
            this.limitDays = removeString(val).slice(0, this.maxDays);
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
    },
    mounted: function() {
        $("#limit-date").datepicker(getDatepikerDefaultSettings()).on(
            "changeDate", () => {this.limitDate = $('#limit-date').val()}
        );
        /**
         * 初期設定
         */
        // 保管期限のデフォルトは無期限
        this.limit_target = this.constLimitInfinite;
        this.limitDaysUnit = this.constLimitDaysUnitYear;
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
