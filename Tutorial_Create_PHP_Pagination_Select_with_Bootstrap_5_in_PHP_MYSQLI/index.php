<?php
// Display Errors if needed
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$mysqli = mysqli_connect('localhost', 'db_user', 'db_password', 'db_name');  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Tutorial |  Create PHP Pagination (Select) with Bootstrap 5 in PHP & MYSQLI</title>
	<!-- CSS Files -->
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <style>
    .custom-pagination select {
         border-radius: 0px;
    }

    .page-item:not(:first-child) .page-link {
    	 /* unset existing -1 px */
         margin-left:  unset;
    }
    </style>	
</head>
<body>
	<div class="container mt-5">
		<center>
			<h2 class="mb-5"><i class="fa-solid fa-code"></i> Tutorial | Create PHP Pagination (Select) with Bootstrap 5 in PHP & MYSQLI</h2>
		</center>
		<!-- Table -->
		<div class="table-responsive">		
		<table class="table table-striped table-bordered">
			<thead class="thead-white">
				<tr>
					<th width="5%">ID</th>
					<th width="75%">Title</th>
					<th width="10%">Author</th>
					<th width="10%" colspan="2">Operations</th>
				</tr>
			</thead>
			<tbody>
				<?php 
                // Limit
				$limit = 10;
                // Page
				$page = isset($_GET['page'])?(int)$_GET['page'] : 1;
                // Start Page
				$start_page = ($page > 1) ? ($page * $limit) - $limit : 0;	
                // Previous
				$previous = $page - 1;
                // Next
				$next = $page + 1;
                // Query Select
				$data_select = "SELECT * FROM `posts`";
                // Data Select Query		
				$data_select_query = mysqli_query($mysqli, $data_select);
                // Total Data
				$total_data = mysqli_num_rows($data_select_query);
                // Total Page
				$total_page = ceil($total_data / $limit);
                // Query Select Data Post
				$data_post_select = "SELECT * FROM `posts` LIMIT $start_page, $total_page";
                // Data Post Query Select Result
				$data_post_result = mysqli_query($mysqli, $data_post_select);
                // Number
				$number = $start_page + 1;
                // While User Data Equals Data User Result
				while($post_data = mysqli_fetch_array($data_post_result)) {
					?>
					<tr>
						<td><?php echo $number++; ?></td>
						<!--
						<td><?php //echo $post_data['post_id']; ?></td>	
						-->			
						<td><?php echo $post_data['post_name']; ?></td>
						<td><?php echo $post_data['post_author']; ?></td>
						<!-- Controls -->
						<td><span class="btn btn-success"><i class="fa-solid fa-edit"></i></span></td>
						<td><span class="btn btn-danger"><i class="fa-solid fa-trash"></i></span></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<!-- Pagination -->
		<nav aria-label="..." class="">
			<ul class="pagination justify-content-center custom-pagination">			
				<li class="page-item">
					<a class="page-link" <?php if($page > 1) { echo "href='index.php?page=$previous'"; } ?>>Prev</a>
				</li>

				<li class="page-item">
                    <select class="form-control shadow-none">
				     <!-- Uncomment to use this instead for disabled -->
				     <!--
                     <select class="form-control shadow-none" disabled="disabled">
                     -->
                                
				        <?php 
				        for($x = 1; $x <= $total_page; $x++) {

					       // If x equals page
                           if ($x == $page) {

                    	     // Current selected page status
                             $selected_page = ' selected';

                            } else {

                    	 // Current selected page status
                         $selected_page = '';                    	

                        }

					    ?> 

                         <option value="<?php echo $x ?>" onClick="window.location = 'index.php?page=<?php echo $x ?>'"<?php echo $selected_page ?>><?php echo $x ?></option>
 
					    <?php
				        }

                        ?>
                    </select>
                </li>											
				<li class="page-item">
					<a  class="page-link" <?php if($page < $total_page) { echo "href='index.php?page=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
	</div>
	</div>
    <!-- JS Files -->
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <!-- Bootstrap --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>