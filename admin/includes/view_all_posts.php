<?php
include('delete_modal.php');
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'publish':
                $update_query = "UPDATE posts SET post_status = 'published' where post_id = {$postValueId}";
                $update_query_execute = mysqli_query($connection, $update_query);
                break;
            case 'draft':
                $update_query = "UPDATE posts SET post_status = 'draft' where post_id = {$postValueId}";
                $update_query_execute = mysqli_query($connection, $update_query);
                break;
            case 'delete':
                $delete_query = "DELETE From posts where post_id = {$postValueId}";
                $delete_query_execute = mysqli_query($connection, $delete_query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
                $select_post_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }

                $insert_post_query = "INSERT INTO `posts` ( `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ( {$post_category_id}, '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}',  '{$post_status}')";

                $insert_post_query_execute = mysqli_query($connection, $insert_post_query);
                break;
        }
    }
}

?>

<form action="" method="post">

    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-select mb-2" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>

        </div>
        <div class="col-xs-4 mb-2">
            <input type="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
    </table>
    <div class="table-responsive">
        <table class="table table-hover my-0 table-bordered align-middle">

            <thead>
                <tr>
                    <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Count</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_posts_query = "select * from posts order by post_id DESC";
                $select_posts_results = mysqli_query($connection, $select_posts_query);
                while ($post = mysqli_fetch_assoc($select_posts_results)) {
                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_status = $post['post_status'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_tags = $post['post_tags'];
                    $comment_count = "Select * from comments where comment_post_id = {$post_id}";
                    $comment_count_execute = mysqli_query($connection, $comment_count);
                    $post_comment = mysqli_num_rows($comment_count_execute);
                    $post_views_count = $post['post_views_count'];
                    $post_category_id = $post['post_category_id'];
                    $search_category_query = "select `cat_title` from categories where cat_id ={$post_category_id}";
                    $search_category_query_execute = mysqli_query($connection, $search_category_query);
                    $search_category_query_results = mysqli_fetch_assoc($search_category_query_execute);
                    $post_category_title = $search_category_query_results['cat_title'];

                    echo "<tr>
                        <td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value='{$post_id}'></td>
                            <td>{$post_id}</td>
                            <td>{$post_title}</td>
                            <td>{$post_author}</td>
                            <td>{$post_status}</td>
                            <td>{$post_category_title}</td>
                            <td><img width='100px' src='../images/{$post_image}'</td>
                            <td>{$post_tags}</td>
                            <td><a href='comments.php?source=post_comment&post_id={$post_id}'>{$post_comment}</a></td>
                            <td>{$post_date}</td>
                            <td><a href='posts.php?reset={$post_id}'>{$post_views_count}</td>
                            <td><a class='btn btn-primary' href='../post.php?post_id={$post_id}'>View <br> Post</a></td>
                            <td><a class='btn btn-warning' href='posts.php?source=edit_post&edit={$post_id}'>Edit</a></td>
                            <td><a onClick=\"javascript: return confirm('are you sure want to delete ?'); \" class='btn btn-danger' href='posts.php?delete={$post_id}'>Delete</a></td>
                        </tr>"
                ?>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</form>

<!-- Modal Html -->
<!--   <td><a  rel='{$post_id}' href='javascript:void(0)'class='delete_link btn btn-danger' class='delete_link' >
                            Delete
                            </a></td> -->
<!-- Modal Script -->
<!-- <script>
    $(document).ready(function() {
        $(".delete_link").on('click', function() {
            var id = $(this).attr("rel");
            var deleteURL = "posts.php?delete=" + id + " ";
            // alert(deleteURL);
            $(".modal_delete_link").attr("href", deleteURL);
            $("#myModal").modal('show');
        });
    });
</script> -->