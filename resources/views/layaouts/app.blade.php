<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .text-right {
      text-align: right;
    }
    th {
      text-align: center;
    }
    a {
      color: rgb(155, 145, 4);
    }
    .mb20 {
      margin-bottom:20px;
    }
    .mt20 {
      margin-top:20px;
    }
  </style>
  @yield('head')
</head>
<body>

<div class="container">
    @yield('content')
</div>

@yield('footer')

</body>
</html>