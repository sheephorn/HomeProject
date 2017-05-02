// divの表示を制御
// 画面内のdivの表示条件をすべてこのオブジェクトで管理
let toggleTarget = {
    group: false,
    place: false
};

let getAddPlaceGroupCallback = function(ele) {
    let callback = function(data) {
        createLog(data);
        if (data !== undefined　&& data.code !== undefined) {
            if (data.code === RESPONSE.OK) {
                group.message = data.message;
            } else if (data.code === RESPONSE.NG) {
                group.message = data.message;
            }
        } else {
            createLog('NG');
        }
    }
    return callback;
};

let getAddPlaceCallback = function(ele) {
    let callback = function(data) {
        createLog(data);
        if (data !== undefined　&& data.code !== undefined) {
            if (data.code === RESPONSE.OK) {
                place.message = data.message;
            } else if (data.code === RESPONSE.NG) {
                place.message = data.message;
            }
        } else {
            createLog('NG');
        }
    }
    return callback;
};

let group = new Vue({
    el: '#group',
    data: {
        toggleTarget: toggleTarget,
        groupName: '',
        message: ''
    },
    computed: {
        show: function() {
            return this.toggleTarget.group;
        },
        formObj: function() {
            return {
                groupName : this.groupName
            };
        }
    },
    methods: {
        regist: function(action) {
            createLoadingGif(event.target);
            execAjax(action, this.formObj, getAddPlaceGroupCallback(), getFailCallback());
        }
    }
});

let place = new Vue({
    el: '#place',
    data: {
        toggleTarget: toggleTarget,
        placeName: '',
        message: ''
    },
    computed: {
        show: function() {
            return this.toggleTarget.place;
        },
        formObj: function() {
            return {
                placeName : this.placeName
            };
        }
    },
    methods: {
        regist: function(action) {
            createLoadingGif(event.target);
            execAjax(action, this.formObj, getAddPlaceCallback(), getFailCallback());
        }
    }
});
