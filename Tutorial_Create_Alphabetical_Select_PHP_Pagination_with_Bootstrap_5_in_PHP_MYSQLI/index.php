<?php 
// Display Errors if needed
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
 // Connection 
 $mysqli = mysqli_connect('localhost', 'db_user', 'db_password', 'db_name');
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
 // Result  
 $result = mysqli_query($mysqli, $query);
 // Current Character
 $current_character = $character_is;
 //echo $current_character; 
 // If empty letter
 if (empty($letter)) {
   // Next    
   $next = chr(ord('A') + 0);        
 }
 // If not empty letter
 if (!empty($letter)) {
   // Letter
   $letter = $character_is;
   //echo $letter;
 }
 // If letter equal character is
 if ($letter = $character_is) {
   // Next
   $next = chr(ord($letter) + 1);
 }
 // Previous
 $previous = chr(ord($letter) - 1 );                  
?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
           <title>Tutorial | Create Alphabetic Pagination (Select) in Bootstrap 5 with PHP & MYSQLI</title>
           <!-- CSS Files -->
           <!-- Bootstrap -->  
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
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
                <h2 class="mb-3" align="center"><i class="fa-solid fa-code"></i> Tutorial | Create Alphabetic Pagination (Select) in Bootstrap 5 with PHP & MYSQLI</h2>                  
                <!-- Table --> 
                <div class="table-responsive">  
                     <div align="center">  
                     <?php 
                          // Character range
                          $character = range('A', 'Z'); 
                          // Echo
                          echo '<nav aria-label="Pagination">
                          <ul class="pagination justify-content-center my-4 custom-pagination">';
                          ?>
                          <li class="page-item">
                               <a class="page-link" <?php if ($letter > '@') { echo "href='index.php?character=$previous'"; } ?>>Prev</a>
                          </li>
                         <?php
                          // keep to keep select popup / comment out if using alt below
                          echo '<li class="page-item">
                                 <select class="form-control shadow-none">';
                        /* 
                          // un-comment to disable select popup
                          echo'<li class="page-item">
                                 <select class="form-control shadow-none" disabled="disabled">';  
                        */ 
                                   // Since @ is not really selected so is empty                          
                                   $selected = '';   
                         ?>
                                   <option value="@" onClick="window.location = 'index.php?character=&#64;'"<?php echo $selected ?>>@</option>
                         <?php
                             // For each character as abc
                             foreach ($character as $abc) { 
                                   // If abc equals current character
                                   if ($abc == $current_character) {
                                    // Selected Status Selected
                                    $selected = ' selected';
                                   } else {
                                    // Selected Status Empty
                                    $selected = '';
                                   }
                                   ?>
                                    <option value="<?php echo $abc ?>" onClick="window.location = 'index.php?character=<?php echo $abc ?>'"<?php echo $selected ?>><?php echo $abc ?></option>
                                   <?php
                              }
                              echo '</select>
                              </li>';
                         ?>
                          <li class="page-item">
                               <a  class="page-link" <?php if ($letter < 'Z') { echo "href='index.php?character=$next'"; } ?>>Next</a>
                          </li>
                              <?php
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
 