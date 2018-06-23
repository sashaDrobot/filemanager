<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <?php
        require('fm.php');

        isset($_GET['to']) ? $to = $_GET['to'] : $to = getcwd();
        isset($_GET['sort']) ? $sort = $_GET['sort'] : $sort = 'name';
        isset($_GET['order']) ? $order = $_GET['order'] : $order = 'asc';

        $filemanager = Files::getInstance($to);
        $files = $filemanager->files;

        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $files = $filemanager->sort($files, $sort, $order);
        }

        isset($_GET['to']) ? $path = $_GET['to'] : $path = dirname(__FILE__);
    ?>
  <title>My File Manager</title>
</head>
<body>
    <p>
        <?php echo $path."<br/>";
          if ($path !== dirname(__FILE__))
          {
            $back = $_SERVER['PHP_SELF']."?to=".realpath($_GET['to'].'/../');
            echo "<a href=".$back.">Back</a>";
          } ?>
    </p>
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
        <input type="submit" value="Sort">
    </form>

    <table>
        <?php if ($files == null) { ?>
            <p>folder empty...</p>
        <?php }
        else { ?>
            <thead>
                <tr>
                    <td><strong>Name</strong></td>
                    <td><strong>Type</strong></td>
                    <td><strong>Size</strong></td>
                </tr>
            </thead>
          <tbody>
          <?php foreach($files as $file): ?>
              <tr>
                  <td>
                      <?php
                          if ($file['type'] === 'dir')
                          {
                              echo "<a href=".$_SERVER['PHP_SELF'].'?to='.$path.'/'.$file['name'].">".$file['name']."</a>";
                          }
                          else
                          {
                              echo $file['name'];
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
</body>
</html>