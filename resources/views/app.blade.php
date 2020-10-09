<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ asset('dist/index.html') }}">
    <link rel="shortcut icon" type=image/x-icon href=/static/logo.png>
  <link rel=manifest href=manifest.json>
  <script src=https://code.jquery.com/jquery-3.3.1.min.js integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin=anonymous></script>
  <script src=https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js></script>
  <link href=https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css rel=stylesheet>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js></script>
  <link rel=stylesheet href=https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css>
  <link href=https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css rel=stylesheet>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js></script>
  <link rel=stylesheet href=https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css integrity=sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh crossorigin=anonymous>
  <script src=https://code.jquery.com/jquery-3.4.1.slim.min.js integrity=sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n crossorigin=anonymous></script>
  <script src=https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js integrity=sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo crossorigin=anonymous></script>
  <script src=https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js integrity=sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6 crossorigin=anonymous></script>
  <script async defer=defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_VoNXdL03NgSGkyvvigId9fSIIikcZII&language=ja&region=JP"></script>
  <script src=//cdn.ckeditor.com/4.11.4/full-all/ckeditor.js></script>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js></script>
  <link rel=stylesheet href=https://use.fontawesome.com/releases/v5.8.1/css/all.css integrity=sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf crossorigin=anonymous>
  <link rel=stylesheet href=/static/Justselect-master/Justselect-master/dist/selectbox.min.css>
  <script src=/static/Justselect-master/Justselect-master/dist/selectbox.min.js></script>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js integrity=sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 crossorigin=anonymous></script>
  <link href="https://fonts.googleapis.com/css?family=Kosugi+Maru&display=swap" rel=stylesheet>
  <link rel=stylesheet href=vue-camera/dist/vue-camera.css>
  <script src=vue-camera/dist/vue-camera.js></script>
  <link rel=stylesheet href=https://unpkg.com/vue-camera/dist/vue-camera.css>
  <link href=/static/css/app.349c3134002f0a968feb4591a13cc762.css rel=stylesheet>
  <script src=https://unpkg.com/vue-camera></script>
</head>

<body>
    <div id="app"></div>
    <!-- <script src="{{ asset('dist/index.html') }}"></script> -->
</body>

</html>
