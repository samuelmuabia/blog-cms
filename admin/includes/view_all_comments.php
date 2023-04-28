<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post Title</th>
            <th>Comment Author</th>
            <th>Comment Email</th>
            <th>Comment</th>
            <th>Comment Status</th>
            <th>Comment Date</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php
        if(!isLoggedInAsAdmin()){
            redirect('index.php');
        }
        $select_comments_query = "select * from comments";
        $select_comments_results = mysqli_query($connection, $select_comments_query);
        while ($comment = mysqli_fetch_assoc($select_comments_results)) {
            $comment_id = $comment['comment_id'];
            $comment_post_id = $comment['comment_post_id'];
            $comment_author = $comment['comment_author'];
            $comment_content = $comment['comment_content'];
            $comment_email = $comment['comment_email'];
            $comment_date = $comment['comment_date'];
            $comment_status = $comment['comment_status'];

            $search_post_query = "select `post_title` from posts where post_id ={$comment_post_id}";
            $search_post_query_execute = mysqli_query($connection, $search_post_query);
            $search_post_query_results = mysqli_fetch_assoc($search_post_query_execute);
            $comment_post_title = $search_post_query_results['post_title'];

            echo "<tr>
                                    <td>{$comment_id}</td>
                                    <td><a href='../post.php?post_id={$comment_post_id}'>{$comment_post_title}</a> </td>
                                    <td>{$comment_author}</td>
                                    <td>{$comment_email}</td>
                                    <td>{$comment_content}</td>
                                    <td>{$comment_status}</td>
                                    <td>{$comment_date}</td>
                                    <td><a class='btn btn-warning' href='comments.php?source=edit_post&approve={$comment_id}'>Approve</a></td>
                                    <td><a class='btn btn-danger' href='comments.php?disapprove={$comment_id}'>Disapprove</a></td>
                                    <td><a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a></td>
                                </tr>"
        ?>
        <?php
        }
        ?>

    </tbody>
</table>
</div>