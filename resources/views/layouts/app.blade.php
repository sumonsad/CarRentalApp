<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    .top-section{
    background: #000;
    color: #fff;
    text-align: left;
    padding-top:50px;
    padding-bottom:50px;
    padding-left: 70px;
    clear: both;
}
.top-section h1{
    margin-bottom: 0;
}

.top-section .link{
    text-decoration: none;
    border: 1px solid #ddd;
    padding: 10px 15px;
    border-radius: 5px;
    display:inline-block;
    color:#ccc;
    font-size: 14px;
    margin-top: 20px;
}
    </style>
</head>
<body>
<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
