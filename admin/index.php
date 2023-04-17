<?php include('includes/header.php') ?>


<?php include('includes/navbar.php') ?>
<?php


$number_of_posts_query = 'SELECT * from posts';
$number_of_posts_query_execute = mysqli_query($connection, $number_of_posts_query);
$number_of_posts = mysqli_num_rows($number_of_posts_query_execute);

$number_of_draft_posts_query = "SELECT * from posts where post_status='draft'";
$number_of_draft_posts_query_execute = mysqli_query($connection, $number_of_draft_posts_query);
$number_of_draft_posts = mysqli_num_rows($number_of_draft_posts_query_execute);

$number_of_publish_posts_query = "SELECT * from posts where post_status='published'";
$number_of_publish_posts_query_execute = mysqli_query($connection, $number_of_publish_posts_query);
$number_of_publish_posts = mysqli_num_rows($number_of_publish_posts_query_execute);


$number_of_comments_query = 'SELECT * from comments';
$number_of_comments_query_execute = mysqli_query($connection, $number_of_comments_query);
$number_of_comments = mysqli_num_rows($number_of_comments_query_execute);

$number_of_approve_comments_query = "SELECT * from comments where comment_status ='approved'";
$number_of_approve_comments_query_execute = mysqli_query($connection, $number_of_approve_comments_query);
$number_of_approve_comments = mysqli_num_rows($number_of_approve_comments_query_execute);

$number_of_disapprove_comments_query = "SELECT * from comments where comment_status ='disapproved'";
$number_of_disapprove_comments_query_execute = mysqli_query($connection, $number_of_disapprove_comments_query);
$number_of_disapprove_comments = mysqli_num_rows($number_of_disapprove_comments_query_execute);



$number_of_users_query = 'SELECT * from users';
$number_of_users_query_execute = mysqli_query($connection, $number_of_users_query);
$number_of_users = mysqli_num_rows($number_of_users_query_execute);

$number_of_admin_users_query = "SELECT * from users where user_role= 'Admin'";
$number_of_admin_users_query_execute = mysqli_query($connection, $number_of_admin_users_query);
$number_of_admin_users = mysqli_num_rows($number_of_admin_users_query_execute);

$number_of_subsriber_users_query = "SELECT * from users where user_role= 'Subscriber'";
$number_of_subsriber_users_query_execute = mysqli_query($connection, $number_of_subsriber_users_query);
$number_of_subsriber_users = mysqli_num_rows($number_of_subsriber_users_query_execute);


$number_of_categories_query = 'SELECT * from categories';
$number_of_categories_query_execute = mysqli_query($connection, $number_of_categories_query);
$number_of_categories = mysqli_num_rows($number_of_categories_query_execute);


?>
<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

    <div class="row">
      <div class="col-xl-12 col-xxl-12 d-flex">

        <div class="w-100">
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Posts</h5>
                    </div>

                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="book"></i>
                      </div>
                    </div>
                  </div>
                  <h1 class="mt-1 mb-3"><?php echo $number_of_posts ?></h1>
                  <div class="mb-0">
                    <span class="text-info">
                      <i class="align-middle" data-feather="arrow-right"></i><a href="posts.php">View Details</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Comments</h5>
                    </div>

                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="message-circle"></i>
                      </div>
                    </div>
                  </div>
                  <h1 class="mt-1 mb-3"><?php echo $number_of_comments ?></h1>
                  <div class="mb-0">
                    <span class="text-info">
                      <i class="align-middle" data-feather="arrow-right"></i><a href="comments.php">View Details</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Users</h5>
                    </div>

                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="user"></i>
                      </div>
                    </div>
                  </div>
                  <h1 class="mt-1 mb-3"><?php echo $number_of_users ?></h1>
                  <div class="mb-0">
                    <span class="text-info">
                      <i class="align-middle" data-feather="arrow-right"></i><a href="users.php">View Details</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">categories</h5>
                    </div>

                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="layers"></i>
                      </div>
                    </div>
                  </div>
                  <h1 class="mt-1 mb-3"><?php echo $number_of_categories ?></h1>
                  <div class="mb-0">
                    <span class="text-info">
                      <i class="align-middle" data-feather="arrow-right"></i><a href="categories.php">View Details</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <script type="text/javascript">
        google.charts.load('current', {
          'packages': ["bar", "corechart", "table"]
        });

        google.charts.setOnLoadCallback(drawPostsChart);

        function drawPostsChart() {
          var postsData = google.visualization.arrayToDataTable([
            ['Posts', 'Total', 'Draft', 'Published'],
            <?php
            echo "[' '," . $number_of_posts . "," . $number_of_draft_posts . "," . $number_of_publish_posts . ",]";

            ?>
          ]);

          var postsOptions = {
            chart: {
              title: 'Posts',
              subtitle: 'Total , Draft and Published Posts',
            }
          };

          var postsChart = new google.charts.Bar(document.getElementById('posts_columnchart_material'));

          postsChart.draw(postsData, google.charts.Bar.convertOptions(postsOptions));
        }

        // Comments Chart
        google.charts.setOnLoadCallback(drawCommentsChart);

        function drawCommentsChart() {
          var commentsData = google.visualization.arrayToDataTable([
            ['Comments ', 'Number'],
            <?php
            echo "['Total Comments =  {$number_of_comments}'," . $number_of_comments . "],";
            echo "['Approved Comments =  {$number_of_approve_comments}'," . $number_of_approve_comments . "],";
            echo "['Pending Comments =  {$number_of_disapprove_comments}'," . $number_of_disapprove_comments . "]";

            ?>

          ]);

          var commentsOptions = {
            title: 'Comments',
            pieHole: 0.5,
          };

          var commentsChart = new google.visualization.PieChart(document.getElementById('comments_donutchart'));
          commentsChart.draw(commentsData, commentsOptions);
        }
        // Users Chart 

        google.charts.setOnLoadCallback(drawUsersChart);

        function drawUsersChart() {
          var usersData = google.visualization.arrayToDataTable([
            ['Users', 'Number of Users'],
            ['Subscriber', <?php echo $number_of_subsriber_users ?>],
            ['Admin', <?php echo $number_of_admin_users ?>]
          ]);

          var options = {
            title: 'Users',
            is3D: true,
          };

          var usersChart = new google.visualization.PieChart(document.getElementById('users_piechart_3d'));
          usersChart.draw(usersData, options);

        }

        // Categories Chart
        google.charts.setOnLoadCallback(drawCategoriesTable);

        function drawCategoriesTable() {
          var categoriesData = new google.visualization.DataTable();
          categoriesData.addColumn('string', 'Category');
          categoriesData.addColumn('string', 'Number of Posts');
          categoriesData.addRows([
            <?php

            while ($category = mysqli_fetch_assoc($number_of_categories_query_execute)) {
              $category_id = $category['cat_id'];
              $category_title = $category['cat_title'];
              $each_category_total_query = "Select * from posts where post_category_id={$category_id}";
              $each_category_total_query_execute = mysqli_query($connection, $each_category_total_query);
              $each_category_total = mysqli_num_rows($each_category_total_query_execute);
              echo "['" . $category_title . "','" . $each_category_total . "'],";
            }

            ?>


          ]);

          var categoriesTable = new google.visualization.Table(document.getElementById('categories_table_div'));

          categoriesTable.draw(categoriesData, {
            showRowNumber: true,
            width: '100%',
            height: '100%'
          });
        }
      </script>
      </script>

      <div class="d-flex col-lg-6 col-md-12 mb-3">
        <div id="posts_columnchart_material" style="width: auto; height: 500px;"></div>
      </div>
      <div class="d-flex col-lg-6 col-md-12 mb-3">
        <div id="comments_donutchart" style="width: auto; height: 500px;"></div>
      </div>
      <div class="d-flex col-lg-6 col-md-12 mb-3">
        <div id="users_piechart_3d" style="width: auto; height: 500px;"></div>
      </div>
      <div class="d-flex col-lg-6 col-md-12 mb-3">
        <div id="categories_table_div" style="width: auto; height: 500px;"></div>
      </div>

      <?php echo $number_of_disapprove_comments ?>

    </div>

  </div>

  <!-- /.container-fluid -->

</main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('1d44af4bb383a0876416', {
    cluster: 'ap2'
  });

  var notificationsChannel = pusher.subscribe('notifications');
  notificationsChannel.bind('new_user', function(notifications) {
    var message = notifications.message;
    toastr.success(`{$message} just registered.`)
    alert(JSON.stringify(notifications.message));
  });
</script>

<?php include('includes/footer.php') ?>