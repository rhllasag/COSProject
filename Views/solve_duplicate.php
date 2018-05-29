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
                         Photo
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                             <div class="radio">
                                 <label>
                                     <input class="checkbox" type="checkbox" value="<?= $user->PhotoUrl?>" name="photourl_<?= $key ?>">
                                     <img src="<?= $user->PhotoUrl?>" width="40px" height="40px" alt="">
                                 </label>
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
                                 <label><input class="checkbox" value="<?= $user->Email ?>" type="checkbox" name="email_<?= $key ?>"><?= $user->Email ?></label>
                             </div>
                         <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Birthday
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" value="<?= $user->Birthday ?>" type="checkbox" name="birthday_<?= $key ?>"><?= $user->Birthday ?></label>
                             </div>
                             <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Company
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" value="<?= $user->Company ?>" name="company_<?= $key ?>"><?= $user->Company ?></label>
                             </div>
                             <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         City
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" value="<?= $user->City ?>" name="city_<?= $key ?>"><?= $user->City ?></label>
                             </div>
                             <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Occupation
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" value="<?= $user->Occupation ?>" name="occupation_<?= $key ?>"><?= $user->Occupation ?></label>
                             </div>
                             <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Source
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" value="<?= $user->Source ?>" name="source_<?= $key ?>"><?= $user->Source ?></label>
                             </div>
                             <?php } ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         Street Address
                     </td>
                     <td>
                         <?php foreach ($repeated->users as $key => $user) {?>
                         <div class="radio">
                             <div class="radio">
                                 <label><input class="checkbox" type="checkbox" value="<?= $user->StreetAddress ?>" name="streetaddress_<?= $key ?>"><?= $user->StreetAddress ?></label>
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