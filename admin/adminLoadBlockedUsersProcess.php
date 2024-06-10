<?php
session_start();

require "../connection.php";

$blocked_rs = Database::search("SELECT * FROM `users` WHERE `ban`='1'");
$blocked_n = $blocked_rs->num_rows;

?>
<div class="card-body bg-dark">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">First Name</th>
                <th scope="col" class="text-center">Last Name</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Mobile</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($blocked_n < 1) {
            ?><tr>
                    <th scope='row' colspan='6' class='text-center'>No Blocked Users</th>
                </tr>
                <?php
            } else {
                for ($i = 0; $i < $blocked_n; $i++) {
                    $user_data = $blocked_rs->fetch_assoc();

                    $id = $user_data["id"];
                    $fname = $user_data["fname"];
                    $lname = $user_data["lname"];
                    $email = $user_data["email"];
                    $mobile = $user_data["mobile"];
                ?>
                    <tr>
                        <th scope='row'><?php echo $id ?></th>
                        <td><?php echo $fname ?></td>
                        <td><?php echo $lname ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $mobile ?></td>
                        <td>
                                <a class='btn btn-sm btn-success' onclick='unblockUser(<?php echo $id ?>)'>Unblock</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>