<?php if(!empty($contacts)) { ?>
    <table class="table table-striped">
        <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Actions</td>
        <td>Source</td>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr id="contact-row-<?= $contact->Guid ?>">
                    <td>
                        <?= $contact->Guid ?>
                    </td>
                    <td>
                        <?= $contact->GivenName ?>
                    </td>
                    <td>
                        <?= $contact->Email ?>
                    </td>
                    <td>
                        <a href="details.php?id=<?= $contact->Guid ?>" class="btn btn-primary">Details</a>
                    </td>
                    <td>
                        <?= $contact->Source ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <h3 id="contacts-feedback" style="background-color: #fafafa; padding: 10px; color: #aaa;">No contacts found</h3>
<?php }?>