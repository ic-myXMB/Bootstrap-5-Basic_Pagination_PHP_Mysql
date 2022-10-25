<?php 
// Display Errors if needed
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
 // Connection 
 $mysqli = mysqli_connect('localhost', 'db_user', 'db_pass', 'db_name');
 // Character is empty  
 $character_is = ''; 
 // If Get Character 
 if (isset($_GET["character"])) { 
      // Character
      $character_is = $_GET["character"];  
      $character_is = preg_replace('#[^a-z]#i', '', $character_is); 
      // Current Character 
      $current_character = $character_is;
      // Query Select
      $query = "SELECT * FROM `users` WHERE user_name LIKE '$character_is%'"; 
 } else { 
      // Query Select 
      $query = "SELECT * FROM `users` ORDER BY user_id";  
 }
 // Current Character 
 $current_character = $character_is;
 // Result  
 $result = mysqli_query($mysqli, $query);
 ?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
           <title>Tutorial | Create Alphabetic Pagination in Bootstrap 5 with PHP & MYSQLI</title>
           <!-- CSS Files -->
           <!-- Bootstrap -->  
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
           <!-- Font Awesome -->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />              
           <style>
               /* overwrite pagination */
               .pagination {
                     display: -ms-flexbox;
                     flex-wrap: wrap;
                     display: flex;
                     padding-left: 0;
                     list-style: none;
                     border-radius: 0.25rem;
               }
               /* When the browser max 900px else below */
               @media screen and (max-width: 900px) {
                    .page-item:first-child .page-link {
                          border-bottom-left-radius: 0;
                          border-top-left-radius: 0;
                    }
                    .page-item:last-child .page-link {
                          border-top-right-radius: 0;  
                          border-bottom-right-radius: 0;  
                    }
               }
           </style>
      </head>  
      <body>  
           <div class="container mt-5"> 
                <h2 class="mb-3" align="center"><i class="fa-solid fa-code"></i> Tutorial | Create Alphabetic Pagination in Bootstrap 5 with PHP & MYSQLI</h2> 

                <?php
                // Demo Breadcrumb 

                $is_page = 'index.php';

                $is_current_page = ucwords(str_replace("_", " ", (basename($is_page, ".php"))));

                $page = $_SERVER['PHP_SELF'];

                $is_current_dir = ucwords(basename(dirname($page)));

                $is_current_dir_icon = '<i class="fa-solid fa-folder"></i> ';

                $is_current_page_icon = '<i class="fa-solid fa-user"></i> ';

                ?>

                <!-- Breadcrumb -->
                <ol class="breadcrumb mb-4 mt-4 p-2 bg-light rounded-3">
                     <li class="breadcrumb-item"><?php echo $is_current_dir_icon; ?><a href="../<?php echo $is_current_dir; ?>"><?php echo $is_current_dir; ?></a></li>                   
                     <li class="breadcrumb-item active"><?php echo $is_current_page_icon; ?><?php echo $is_current_page; ?></li>
                </ol>

                <!-- Table --> 
                <div class="table-responsive">  
                     <div align="center">  
                     <?php 
                          // Character range
                          $character = range('A', 'Z'); 
                          // Echo
                          echo '<nav aria-label="Pagination">
                          <ul class="pagination justify-content-center my-4">';
                          // For each character as abc
                          foreach ($character as $abc) { 
                                   // If abc equals current character
                                   if ($abc == $current_character) {
                                    // Character link status active  
                                    $character_link_status = ' active" aria-current="page';
                                   } else {
                                    // Character link status empty    
                                    $character_link_status = '';
                                   }
                               // Echo
                               echo '<li class="page-item'.$character_link_status.'"><a class="page-link" href="index.php?character='.$abc.'">'.$abc.'</a></li>';  
                              }
                          // Echo                               
                          echo '
                            </ul>
                         </nav>
                          ';  
                     ?>  
                     </div>  
                     <table class="table table-striped table-bordered">  
                        <thead class="thead-white">
                         <tr>
                               <th width="5%">ID</th>  
                               <th width="85%">User Name</th>  
                               <th width="10%" colspan="2">Operations</th> 
                         </tr>
                         </thead>
                          <?php 
                          // If result is greater than 0
                          if (mysqli_num_rows($result) > 0) {  
                               // While data user equals result
                               while ($data_user = mysqli_fetch_array($result)) {  
                          ?>  
                          <tr>  
                               <td><?php echo $data_user["user_id"]; ?></td>  
                               <td><?php echo $data_user["user_name"]; ?></td>  
                               <td><span class="btn btn-success"><i class="fa-solid fa-edit"></i></span></td>
                               <td><span class="btn btn-danger"><i class="fa-solid fa-trash"></i></span></td>   
                          </tr>  
                          <?php  
                               }  
                          }  
                          else {  
                          ?>  
                          <tr>  
                               <td colspan="3" align="center">Query data was not Found</td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <!-- JS Files -->
           <!-- JQuery -->
           <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
           <!-- Bootstrap -->
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script> 
      </body>  
 </html>
