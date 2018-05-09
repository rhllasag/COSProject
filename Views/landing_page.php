<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacts Orchestrator Solution</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3>Contacts Orchestrator Solution</h3>
    <div>
        <label style="width: 90px">Facebook</label> <input type="checkbox" checked>
    </div>
    <div>
        <label style="width: 90px">Linkedin</label> <input type="checkbox" checked>
    </div>
    <span>Number of contacts on the list: </span><span id="num-contacts"><?= $numContacts  ?></span>
    <div class="panel">
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
    </div>
</div>
</body>
</html>