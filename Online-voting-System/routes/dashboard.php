<?php
    session_start();
    if (!isset($_SESSION['userdata'])) {
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if ($_SESSION['userdata']['status'] == 0) {
        $status = '<b style="color:red"> Not Voted</b>';
    } else {
        $status = '<b style="color:green"> Voted</b>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        #headerSection {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
        }

        .header-buttons a {
            text-decoration: none;
        }

        #backbtn,
        #logoutbtn {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #0056b3;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #backbtn:hover,
        #logoutbtn:hover {
            background-color: #004080;
        }

        h1 {
            font-family: 'Comic Sans MS', cursive;
            font-size: 36px;
            margin: 0;
        }

        img {
            width: 100px;
            height: auto;
            margin-top: 20px;
        }

        #mainPanel {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .profile-section,
        .group-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 48%;
        }

        .profile-section img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        .group-info {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }

        .group-info:last-child {
            border-bottom: none;
        }

        .group-info img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            float: right;
            margin-left: 20px;
        }

        .group-details {
            overflow: hidden;
        }

        .vote-button {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .vote-button[disabled] {
            background-color: #6c757d;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div id="headerSection">
        <div class="header-buttons">
            <a href="../"><button id="backbtn">Back</button></a>
        </div>
        <div>
            <h1>Online Voting System</h1>
            <img src="../Voter.png" alt="Voter Logo">
        </div>
        <div class="header-buttons">
            <a href="logout.php"><button id="logoutbtn">Logout</button></a>
        </div>
    </div>
    <hr>

    <div id="mainPanel">
        <div class="profile-section">
            <div class="section-title">Profile</div>
            <center><img src="../uploads/<?php echo $userdata['photo'] ?>" alt="Profile Photo"></center>
            <div class="info-item"><b>Name:</b> <?php echo $userdata['name'] ?></div>
            <div class="info-item"><b>Mobile:</b> <?php echo $userdata['mobile'] ?></div>
            <div class="info-item"><b>Address:</b> <?php echo $userdata['address'] ?></div>
            <div class="info-item"><b>Status:</b> <?php echo $status ?></div>
        </div>
        <div class="group-section">
            <div class="section-title">Parties</div>
            <?php
            if (!empty($groupsdata)) {
                foreach ($groupsdata as $group) {
            ?>
                    <div class="group-info">
                        <img src="../uploads/<?php echo $group['photo'] ?>" alt="Group Photo">
                        <div class="group-details">
                            <div class="info-item"><b>Party Name:</b> <?php echo $group['name'] ?></div>
                            <div class="info-item"><b>Votes:</b> <?php echo $group['votes'] ?></div>
                        </div>
                        <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $group['votes'] ?>">
                            <input type="hidden" name="gid" value="<?php echo $group['id'] ?>">
                            <?php if ($_SESSION['userdata']['status'] == 0) { ?>
                                <input type="submit" class="vote-button" name="votebtn" value="Vote">
                            <?php } else { ?>
                                <button class="vote-button" disabled>Voted</button>
                            <?php } ?>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo "<div>No groups found.</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
