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
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Actions</td>
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>