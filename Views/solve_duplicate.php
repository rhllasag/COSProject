 <?php include_once('common/header.php') ?>
 <div class="container">
     <form action="solve.php" method="POST">
         <input type="hidden" value="<?= $repeated_field ?>" name="repeated_field">
         <input type="hidden" value="<?= $k ?>" name="repeated_field_key">
         <h3>Solve duplicate</h3>
         <div class="panel" id="solve_duplicate_content">
             <table class="table table-bordered">
                 <tr>
                     <td>
                         Name
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                             <div class="radio">
                                 <label><input class="radio" type="radio" value="<?= $user->GivenName ?> <?= $user->Surname ?>" name="name" <?php if($key == 0){ echo "checked"; } ?> ><?= $user->GivenName ?> <?= $user->Surname ?></label>
                             </div>
                         <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Email
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" name="email_<?= $key ?>"><?= $user->Email ?></label>
                             </div>
                         <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Phone
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" name="phone_<?= $key ?>"><?= $user->Phone ?></label>
                             </div>
                             <?php } ?>
                     </td>
                 </tr>
             </table>
         </div>
         <div style="padding-bottom: 20px;">
             <a class="btn btn-primary" href="duplicate.php">Go back</a>
             <button class="btn btn-success" type="submit" style="float: right">Save</button>
         </div>
     </form>
 </div>
 </body>
 </html>