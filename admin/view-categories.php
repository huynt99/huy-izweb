<?php
session_start();
include_once('../db/connect.php');
include('header-admin.php');
include('sidebar-a.php');
?>
<div id="content">
    <h2>Manage Categories</h2>
    <table>
        <thread>
            <?php
                if(isset($_GET['sort'])){
                    switch ($_GET['sort']) {
                        case 'cat':
                            $order_by = "cate_name";
                            break;
                        
                        case 'pos':
                            $order_by = "position";
                            break;
                    
                        case 'by':
                            $order_by = "name";
                            break;
                                    
                        default:
                            $order_by = "position";
                            break;
                    }
                } else {
                    $order_by = "position";
                }
            ?>
            <tr>
                <th><a href="view-categories.php?sort=cat">Categories</a></th>
                <th><a href="view-categories.php?sort=pos">Position</a></th>
                <th><a href="view-categories.php?sort=by">Posted by</a></th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thread>
        <tbody>
            <?php
            $sql = "SELECT c.cat_id, c.cate_name, c.position, c.user_id, CONCAT_WS(' ', u.first_name, u.last_name) AS name";
            $sql .= " FROM categories AS c";
            $sql .= " JOIN users AS u";
            $sql .= " USING(user_id)";
            $sql .= " ORDER BY {$order_by}";
            $que = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($que)) :
            ?>
                <tr>
                    <td><?php echo $row['cate_name'] ?></td>
                    <td><?php echo $row['position'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><a class="edit" href="edit-categories.php?cid=<?php echo $row['position'];?>">Edit</a></td>
                    <td><a class="delete" href="delete-categories.php?cid=<?php echo $row['position'];?>">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php
include('sidebar-b.php');
include('footer-admin.php');
?>