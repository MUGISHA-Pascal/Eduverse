<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logbook Management</title>
    <style>
        body{
            font-family:sans-serif;
        color:white;
        background-color:black;
        }
      ul{
        display:flex;
        flex-direction:row;
        gap:30px;
        list-style:none;
       margin-top:30px;
       justify-content:center;
      }
      a{
        text-decoration:none;
        color:white;
        background-color:rgb(10, 113, 239);
        padding:20px;
        width:300px;
        font-weight:bold;
        border-radius:20px;
      }
      .text{
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        margin-top:150px;
      }
      footer{
        position:fixed;
        bottom:0;
       left:0;
       right:0;
       background:grey;
      }
      .footer{
        display:flex;
        justify-content:center;
        align-items:center;
      }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="add_entry.php">Add Entry</a></li>
                    <li><a href="list_entries.php">View Entries</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
<div class="text">
    <div><h1>Welcome to the Logbook Management System of RCA</h1></div>
    <div><img src="notebook.png" width='200px'></div>    
</div>

<footer>
       <div class="footer"><p>&copy; 2024 Logbook Management</p></div>
    </footer>
</body>
</html>

