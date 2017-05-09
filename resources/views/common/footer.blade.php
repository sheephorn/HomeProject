@section('footer')
    @include('common.jsconst')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src=" https://unpkg.com/vue"></script>
    <script src="{{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js' )}}}"></script>
    <script src="{{{ asset('assets/js/moment.js' )}}}"></script>
    <script src="{{{ asset('assets/js/common.js' )}}}"></script>
    <script>
    //
    </script>
    @yield('addJs')
  </body>
</html>
@stop
