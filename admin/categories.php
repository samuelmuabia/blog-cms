<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Categories</h1>

		<!-- Page Heading -->
		<div class="row">

			<div class="col col-xs-6">
				<?php
				insertCategories();
				?>
				<form action="" method="post">
					<div class="form-group">
						<label for="addcategory" class="form-label">Add Category</label>
						<input type="text" name="category_title" class="form-control" id="addcategory">
					</div>
					<div class="form-group">
						<input class="btn btn-primary mt-3" type="submit" value="Add Category" name="category_submit">

					</div>
				</form>
				<?php
				if (isset($_GET['edit'])) {
					showUpdateCategoriesInputField();
				}
				?>
			</div>
			<?php
			deleteCategories();
			?>
			<div class="col col-xs-6">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Category ID</th>
							<th>Category Name</th>
						</tr>
					</thead>
					<?php
					viewAllCategories();
					?>


				</table>
			</div>
		</div>
	</div>



</main>

<?php include('includes/footer.php') ?>