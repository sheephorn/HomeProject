@section('header')
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>{{{ $data['title'] or 'Page' }}}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{{ asset('assets/css/common.css') }}}">
    <link rel="stylesheet" type="text/css" href="{{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}}">
    @yield('addCss')
  </head>
@stop
