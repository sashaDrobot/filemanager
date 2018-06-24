<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    require('settings.php');
    ?>
    <title>Open File</title>
    <style>
        h1 {
            color: #424242;
        }
        .wrapper {
            text-align: center;
            margin: auto;
        }
        p a {
            text-decoration: none;
            color: #212121;
            transition: all .5s linear;
            display: inline-block;
            border: #424242 2px solid;
            padding: 5px 15px 5px 15px;
            font-weight: bold;
        }
        p a:hover {
            color: #E5E5E5;
            background: #424242;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Open</h1>
        <p>
            <?php
            if ($path !== dirname(__FILE__))
            {
                chdir(realpath($_GET['to']));
            }
            echo readfile($_GET['file']); ?>
        </p>
        <p>
            <?php $back = "index.php"."?to=".realpath($_GET['to']);
            echo "<a href=".$back.">&larr; back</a>"; ?>
        </p>
    </div>
</body>
</html>
