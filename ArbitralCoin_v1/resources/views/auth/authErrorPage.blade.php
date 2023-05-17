<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Authentication error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
    <!-- Icone Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- jQuery e plugin JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container">
    <header class="header-sezione">
        <h1>
                Authentication error
        </h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center border-danger">
                <div class='card-header'>
                    Access denied
                </div>
                <div class='card-body text-danger'>
                    <p>Wrong credentials</p>
                    <p><a class="btn btn-secondary" href="{{ route('home') }}"><i class="bi-box-arrow-left"></i> Back to the Home page</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</htm>