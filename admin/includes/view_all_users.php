<div class=" table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Change Role to</th>
                <th>Change Role to</th>
                <th>Delete</th>


            </tr>
        </thead>
        <tbody>
            <?php
            if(!isLoggedInAsAdmin()){
                redirect('index.php');
            }
            $select_users_query = "select * from users";
            $select_users_results = mysqli_query($connection, $select_users_query);
            while ($user = mysqli_fetch_assoc($select_users_results)) {
                $user_id = $user['user_id'];
                $username = $user['username'];
                $user_firstname = $user['user_firstname'];
                $user_lastname = $user['user_lastname'];
                $user_email = $user['user_email'];
                $user_role = $user['user_role'];
                $user_image = $user['user_image'];
                $user_date = $user['user_date'];

                // <td><img width='100px' src='../images/{$user_image}'</td>

                echo "<tr>
                                    <td>{$user_id}</td>
                                    <td>{$username}</td>
                                    <td>{$user_firstname}</td>
                                    <td>{$user_lastname}</td>
                                    <td>{$user_email}</td>
                                    <td>{$user_role}</td>
                                    <td>{$user_date}</td>
                                    <td><a class='btn btn-warning' href='users.php?source=edit_user&edit={$user_id}'>Edit</a></td>
                                    <td><a class='btn btn-warning' href='users.php?admin={$user_id}'>Admin</a></td>
                                    <td><a class='btn btn-danger' href='users.php?subscriber={$user_id}'>Subscriber</a></td>
                                    <td><a class='btn btn-danger' href='users.php?delete={$user_id}'>Delete</a></td>
                                </tr>"
            ?>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>