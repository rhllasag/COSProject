 <?php include_once('common/header.php') ?>
 <div class="container">
     <h3>Duplicate contacts</h3>
     <div style="padding-bottom: 20px;">
         <a class="btn btn-primary" href="index.php">Go back</a>
         <a class="btn btn-success" href="export.php" style="float: right">Export</a>
     </div>
     <div class="panel" id="duplicate_contacts_table_holder">
         <?php if(!empty($duplicates)) { ?>
             <table class="table table-striped">
                 <thead>
                 <td>Duplicate field: duplicate value</td>
                 <td>Number of duplicates</td>
                 <td>Actions</td>
                 </thead>
                 <tbody>
                 <?php foreach ($duplicates as $field_name => $duplicate) { ?>
                    <?php foreach ($duplicate as $repeated_field => $info) { ?>
                        <?php if($info->counter == 0) { continue; }?>
                        <tr id="">
                            <td>
                                <?= $field_name . ': ' . $repeated_field ?>
                            </td>
                            <td>
                                <?= $info->counter ?>
                            </td>
                            <td style="max-width: 100px">
                                <a class="btn btn-success" href="solve_duplicate.php?duplicate_field=<?= $field_name ?>&key=<?= $repeated_field ?>"> Solve</a>
                                <a class="btn btn-default" href="../solve.php?duplicate_field=<?= $field_name ?>&key=<?= $repeated_field ?>&cancel=true"> Cancel</a>
                            </td>
                        </tr>
                    <?php } ?>
                 <?php } ?>
                 </tbody>
             </table>
         <?php } else { ?>
             <h3 id="contacts-feedback" style="background-color: #fafafa; padding: 10px; color: #aaa;">No duplicates found</h3>
         <?php }?>
     </div>
     <div style="padding-bottom: 20px;">
         <a class="btn btn-primary" href="index.php">Go back</a>
         <a class="btn btn-success" href="export.php" style="float: right" >Export</a>
     </div>
 </div>
 </body>
 </html>