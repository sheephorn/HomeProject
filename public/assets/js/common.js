/**
 * Logの出力
 * 定数DEBUGによって出力を制御する
 */
let createLog = function(ele){
    if (DEBUG) {
        console.log(ele);
    }
}

/**
 * ajax通信
 **/
var execAjax = function(url, formObj, funcCallack, funcFaiiCallack) {
    var self = this;

    createLog(url);
    createLog(formObj);
    formObj['_token'] = $('meta[name="csrf-token"]').attr('content');

    var process = $.ajax({
      url : url,
      data : JSON.stringify(formObj),
      dataType : "json",
      type : "POST",
      timeout : 10000,
      cache : false,
      contentType : 'application/json; charset=utf-8',
      mimeType: 'application/json',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    // 通信完了コールバック
    process.done(function(data) {
      funcCallack(data);
    });

    // fail
    process.fail(function(data) {
      createLog("failed");
      if (funcFaiiCallack) {
        funcFaiiCallack(data);
      }
    });
    // 通信後(finally)コールバック
    process.always(function(data) {
        removeLoadingGif();
    });
};

let getFailCallback = function(){
    var callback = function(data){
        alert(data.message);
    };
    return callback;
};

/**
 * 定数管理
 */

// 一時的に非表示にしていたDOMの解除
let removeOneTimeHiddenClass = function() {
    $(".one-time-hidden").each(function(idx, ele){
        $(ele).removeClass("one-time-hidden");
    });
};

/**
  * XSS対策　データのエスケープ処理
  **/

 let escapeHTML = function(str) {
    str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, "'");
    return str;
 }

 /**
 * 与えられたエレメントの隣にローディング画像を表示させる
 * 同時に通信が完了するまでボタンを一時的に使用不可とする
 */
 let createLoadingGif = function(e) {
    $("button").not("[disabled]").each(function(idx, target){
        $(target).addClass("limited-disabled disabled").prop("disabled", true);
    });
    var image = $("<img>").attr("src", LOADING_IMAGE).attr('id', "loading-img")
        .css("position", "absolute").css("z-index", 100);
    $(e).after(image);
};

/**
 * ローディング画像を削除する
 * 同時に一時的に使用不可となっていたボタンを有効に変更する
 */
let removeLoadingGif = function()
{
    $("#loading-img, .loading-img").remove();
    $("button.limited-disabled").each(function(idx, target){
        $(target).prop("disabled", false).removeClass("limited-disabled disabled");
    });
}

/**
 * Datepickerのデフォルト設定を取得する
 */
let getDatepikerDefaultSettings = function() {
    return {
        format: STANDARD_DATE_FORMAT.toLowerCase(),
        startView: 1,
        maxViewMode: 2,
        todayBtn: true,
        language: "ja"
    }
};

/**
* 数値以外の文字列を取り除き返す
* @return String 
 */
let removeString = val => {
    return String(val).replace(/[^0-9]/g, '');
}
