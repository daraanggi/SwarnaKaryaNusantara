<?php
// session_start(); // Uncomment if session is used
// if (!isset($_SESSION['username'])) {
//     header('Location: login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Swarna Karya Nusantara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
            width: 16rem;
            background-color: #5E4422;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem 0;
            position: fixed;
            height: 100vh;
        }
        .sidebar img {
            width: 100px;
            border-radius: 50%;
        }
        .sidebar .menu {
            margin-top: 2rem;
            width: 100%;
        }
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            cursor: pointer;
        }
        .menu-item.active, .menu-item:hover {
            background-color: #C9C0B0;
            color: black;
        }
        .menu-item i {
            margin-right: 1rem;
        }

        .main-content {
            margin-left: 16rem;
            padding: 2rem;
            width: calc(100% - 16rem);
        }
        .profile-header {
            background-color: #7A5B3E;
            color: white;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
            position: relative;
        }
        .profile-header .edit {
            position: absolute;
            top: 1rem;
            right: 1rem;
            cursor: pointer;
        }
        .profile-section {
            display: flex;
            justify-content: center;
            gap: 3rem;
            background-color: #7A5B3E;
            padding: 1rem;
            color: white;
        }
        .profile-section div {
            text-align: center;
            cursor: pointer;
        }
        .history {
            background-color: #8A6F50;
            padding: 1rem;
            border-radius: 0 0 10px 10px;
            color: white;
        }
        .history-box {
            background-color: #A89074;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            height: 200px;
            overflow-y: auto;
        }
        .logout-btn {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #C9A77C;
            color: black;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .location-icon {
            position: absolute;
            top: 1rem;
            right: 3rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="logo.png" alt="Logo">
        <h4>Swarna Karya Nusantara</h4>
        <div class="menu">
            <div class="menu-item" onclick="navigate('home')">
                <i class="fas fa-home"></i> Home
            </div>
            <div class="menu-item active" onclick="navigate('profile')">
                <i class="fas fa-user"></i> Profile
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="profile-header">
            <h2 id="userName">Stela Natalia</h2>
            <i class="fas fa-edit edit" onclick="editProfile()"></i>
            <i class="fas fa-map-marker-alt location-icon" onclick="editLocation()"></i>
        </div>
        <div class="profile-section">
            <div onclick="openOrders()">
                <i class="fas fa-box"></i>
                <p>Pesanan</p>
            </div>
            <div onclick="openReviews()">
                <i class="fas fa-comment"></i>
                <p>Ulasan</p>
            </div>
        </div>
        <div class="history">
            <h3>Riwayat Pesanan <span style="float: right; font-size: small; cursor: pointer;">Tampilkan semua</span></h3>
            <div class="history-box">
                <p>Tidak ada pesanan saat ini.</p>
            </div>
            <form method="POST" action="logout.php">
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <script>
        function navigate(page) {
            alert('Navigasi ke ' + page);
        }

        function editProfile() {
            const name = prompt('Edit nama Anda:', document.getElementById('userName').innerText);
            if (name) {
                document.getElementById('userName').innerText = name;
            }
        }

        function editLocation() {
            alert('Fitur edit lokasi akan ditambahkan.');
        }

        function openOrders() {
            alert('Menampilkan pesanan Anda.');
        }

        function openReviews() {
            alert('Menampilkan ulasan Anda.');
        }
    </script>
</body>
</html>