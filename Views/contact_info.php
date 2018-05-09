<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacts Orchestrator Solution - Contact details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <a href="index.php" class="btn btn-primary" style="margin-top: 10px; margin-bottom: 20px">Go back</a>
    <div class="panel">
        <table class="table table-striped">
            <tr>
                <td colspan="2">
                    <img src="<?= $contact->PhotoUrl ?>" style="max-height: 100px; max-width: 100px" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    GUID
                </td>
                <td>
                    <?= $contact->Guid ?>
                </td>
            </tr>
            <tr>
                <td>
                    Given name
                </td>
                <td>
                    <?= $contact->GivenName ?>
                </td>
            </tr>
            <tr>
                <td>
                    Surname
                </td>
                <td>
                    <?= $contact->Surname ?>
                </td>
            </tr>
            <tr>
                <td>
                    Birthday
                </td>
                <td>
                    <?= $contact->Birthday ?>
                </td>
            </tr>
            <tr>
                <td>
                    Phone
                </td>
                <td>
                    <?= $contact->Phone ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?= $contact->Email ?>
                </td>
            </tr>
            <tr>
                <td>
                    Street address
                </td>
                <td>
                    <?= $contact->StreetAddress ?>
                </td>
            </tr>
            <tr>
                <td>
                    City
                </td>
                <td>
                    <?= $contact->City ?>
                </td>
            </tr>
            <tr>
                <td>
                    Occupation
                </td>
                <td>
                    <?= $contact->Occupation ?>
                </td>
            </tr>
            <tr>
                <td>
                    Company
                </td>
                <td>
                    <?= $contact->Company ?>
                </td>
            </tr>
            <tr>
                <td>
                    Source
                </td>
                <td>
                    <?= $contact->Source ?>
                </td>
            </tr>
        </table>
    </div>
    <button class="btn btn-primary">Review contacts</button>
</div>
</body>
</html>