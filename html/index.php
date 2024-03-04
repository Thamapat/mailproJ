<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ff9c9c;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    
        form {
            background-color: #ffb87a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        label {
            display: block;
            margin-bottom: 8px;
        }
    
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
    
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form id="emailForm" method="POST" action="config.php">
        <label for="Name">Name :</label>
        <input type="text" id="name" name="Name" required placeholder><br>

        <label for="Email">Email :</label>
        <input type="Email" id="email" name="Email" required placeholder><br>
        
        <label for="to">To :</label>
        <input type="email" id="to" name="to" required placeholder><br>

        <label for="subject">Subject :</label>
        <input type="text" id="subject" name="subject" required placeholder><br>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required placeholder></textarea><br>

        <input type="submit" value="SendEmail">
    </form>

</body>
</html>
