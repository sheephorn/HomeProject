<script>
    {{-- ログの出力制御　0:出力しない 0:出力する --}}
    const DEBUG = 0;
    {{-- ローディング画像のpath --}}
    const LOADING_IMAGE = '{{ asset('assets/images/ajax-loader.gif') }}';
    {{-- Ajaxリクエストの返答コードの定義 --}}
    const RESPONSE = {
        OK: '{{ app('CodeCreater')->getResponseCode('ok') }}',
        NG: '{{ app('CodeCreater')->getResponseCode('ng') }}'
    };
</script>
