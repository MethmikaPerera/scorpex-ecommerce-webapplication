<?php
session_start();

require "../connection.php";

$active_rs = Database::search("SELECT * FROM `users` WHERE `ban`='0'");
$active_n = $active_rs->num_rows;

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
            for ($i = 0; $i < $active_n; $i++) {
                $user_data = $active_rs->fetch_assoc();

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
                        <a class='btn btn-sm btn-danger' onclick='blockUser(<?php echo $id ?>)'>Block</a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>