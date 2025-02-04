<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Profil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fbff;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 60px);
            padding: 20px;
        }

        .profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.1);
            overflow: hidden;
            width: 400px;
            text-align: center;
            padding: 25px;
            border: 1px solid #e8f0fe;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #e8f0fe;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.2);
            margin: 0 auto 20px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.05);
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a73e8;
            margin: 10px 0 5px;
        }

        .profile-role {
            font-size: 16px;
            color: #2575fc;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .profile-details {
            text-align: left;
            margin: 0 auto;
            max-width: 80%;
            background: #f8fbff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(37, 117, 252, 0.1);
        }

        .profile-details p {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
            line-height: 1.6;
            padding: 8px;
            border-bottom: 1px solid #e8f0fe;
        }

        .profile-details p:last-child {
            border-bottom: none;
        }

        .profile-details p strong {
            color: #1a73e8;
        }

        .profile-footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 2px solid #e8f0fe;
        }

        .profile-footer a {
            text-decoration: none;
            color: #2575fc;
            font-size: 14px;
            transition: all 0.3s ease;
            padding: 8px 20px;
            border-radius: 8px;
            background: #e8f0fe;
            display: inline-block;
        }

        .profile-footer a:hover {
            background: #2575fc;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.2);
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="content-container">
        @yield('content')
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>