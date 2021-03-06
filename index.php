<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <?php
           require('settings.php');
        ?>
    <title>My File Manager for Opinion Corp</title>
    <style>
        h1 {
            color: #424242;
        }
        .wrapper {
            text-align: center;
            margin: auto;
        }
        select {
            height: 25px;
        }
        .btn {
            background: #424242;
            border: none;
            display: inline-block;
            cursor: pointer;
            padding: 5px 15px 5px 15px;
            border-radius: 5px;
            color: white;
            transition: all .5s linear;
        }
        .btn:hover {
            background: #212121;
        }
        table {
            margin: auto;
            margin-top: 20px;
            border-collapse: collapse;
            border-left: 3px solid #424242;
            border-right: 3px solid #424242;
            border-bottom: 3px solid #424242;
            font-family: "Lucida Grande", sans-serif;
        }
        table thead {
            background: #424242;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.3);
            color: white;
            font-family: "Roboto Slab",serif;
            font-style: normal;
            font-size: 20px;
            text-align: center;
            margin: 0;
        }
        table td, table th {
            padding: 10px;
        }
        table th {
            text-align: center;
            font-size: 18px;
        }
        table tbody tr {
            cursor: pointer;
            transition: all .5s linear;
        }
        table tbody tr:hover {
            background: #E5E5E5;
        }
        table tr:nth-child(2n) {
            background: #f5f5f5;
        }
        table td:last-of-type {
            text-align: center;
        }
        table tr td a {
            text-decoration: none;
            color: #212121;
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
        <h1>File Manager</h1>
        <form method="get" action="">
            <select name="sort" required>
                <option value="name">Name</option>
                <option value="type">Type</option>
                <option value="size">Size</option>
            </select>
            <select name="order" required>
                <option value="asc">ascending</option>
                <option value="desc">descending</option>
            </select>
            <input type="hidden" name="to" value="<?php echo $to ?>">
            <input type="submit" value="Sort" class="btn">
        </form>
        <p>touch to open file or directory</p>
        <table>
            <?php if ($files == null) { ?>
                <p>folder empty...</p>
            <?php }
            else { ?>
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($files as $file): ?>
                <tr>
                    <td>
                        <?php
                        if ($file['type'] === 'dir')
                        {
                            echo "<a href=".$_SERVER['PHP_SELF'].'?to='.$path.'/'.$file['name']." style='font-weight: bolder;'>".$file['name']."</a>";
                        }
                        else
                        {
                            echo "<a href='open.php?to=".$path."&file=".$file['name'].'.'.$file['extension']."'>".$file['name']."</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($file['type'] === 'dir') {
                            echo $file['type'];
                        }
                        else
                        {
                            echo $file['extension'];
                        }
                        ?>
                    </td>
                    <td><?php echo $file['size'].' kB'; ?></td>
                </tr>
            <?php endforeach; }?>
            </tbody>
        </table>
        <p>
            <?php
            if ($path !== dirname(__FILE__))
            {
                $back = $_SERVER['PHP_SELF']."?to=".realpath($_GET['to'].'/../');
                echo "<a href=".$back.">&larr; back</a>";
            } ?>
        </p>
    </div>
</body>
</html>