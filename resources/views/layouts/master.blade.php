<!doctype html>
<html lang="en">
<head>
    <title>File Sharing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    @include("layouts.nav")

    <main role="main" class="container">
        @yield("content")
    </main>

    <script src="{{ asset("js/app.js") }}"></script>
</body>
</html>