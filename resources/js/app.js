/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// コンポーネントの登録
Vue.component('parent-steps-component', require('./components/ParentStepsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//vueのインスタンス化
const app = new Vue({
    el: '#app',
});

/*
ブラウザがsafariの時、一部ページがトップから表示されないため、
ページ表示時にトップに来るようにする
*/
$(function () {
    $('html,body').animate({
        scrollTop: $('#js-position-top').offset().top
    }, 0, 'swing');
});


/*
入力フォームの文字数カウンター
js-countをまとめてforでまわすと、入力フォームが12個ないページでエラーが出るため、
分ける
*/

$(function () {

    $('.js-count1').bind('keyup', function () {

        let thisValueLength = $(".js-count1").val().length;
        $(".js-show1").html(thisValueLength);

    });

    $('.js-count2').bind('keyup', function () {

        let thisValueLength = $(".js-count2").val().length;
        $(".js-show2").html(thisValueLength);

    });


    $('.js-count3, .js-count4, .js-count5, .js-count6, .js-count7, .js-count8, .js-count9, .js-count10, .js-count11, .js-count12').bind('keyup', function () {
        for (num = 3; num <= 12; num++) {
            let thisValueLength = $(".js-count" + num).val().length;
            $(".js-show" + num).html(thisValueLength);
        }
    });
});

// ナビメニュー
$(function () {

    // フロートヘッダーメニュー
    var targetHeight = $('.js-float-menu-target').height();
    $(window).on('scroll', function () {
        $('.js-float-menu').toggleClass('is-float-active', $(this).scrollTop() > targetHeight);
    });

    // SPメニュー
    $('.js-toggle-sp-menu').on('click', function () {
        $(this).toggleClass('is-active');
        $('.js-toggle-sp-menu-target').toggleClass('is-active');
    });
});

/*
ナビメニューにfixedを適用したことで、ナビメニューの高さ分下部のコンテンツが上がって
きしまっている。その高さ分をmargin-topで相殺する。
*/
$(function () {
    $(".js-height-hold").css("margin-top", 58);
});

/*
上下中央寄せのクラスを付与
*/
$(window).on('load resize', function () {
    let winWidth = $(window).width();

    let center = $('.js-content-center-target');
    const largeWidth = 920;

    if (largeWidth < winWidth) {
        center.addClass('c-content-center');
    } else {
        center.removeClass('c-content-center');
    }

});