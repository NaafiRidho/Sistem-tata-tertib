<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Si Tertib</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #1a237e;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 24px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: #3949ab;
            padding: 5px;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Si Tertib</h2>
        <a href="#">Dashboard</a>
        <a href="#">Pelaporan</a>
        <a href="#">Logout</a>
    </div>
    <div class="content">
        <div class="header">Pelaporan</div>
        <a href="#" class="button">Cetak Surat</a>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
