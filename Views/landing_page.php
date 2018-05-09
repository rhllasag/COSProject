<?php include_once('common/header.php') ?>
<div class="container">
    <h3>Contacts Orchestrator Solution</h3>
    <div style="margin-top: 20px; margin-bottom: 10px">
        <div style="display: inline-flex;">
            <div style="display: table-cell;vertical-align: middle;">
                <label class="network-label">Facebook</label>
                <label class="switch">
                    <input id="facebook_checkbox" type="checkbox" onchange="reloadList()" <?php if($facebook_active) { echo 'checked';} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <div style="display: table-cell;vertical-align: middle;">
                <label class="network-label" style="margin-left: 10px">LinkedIn</label>
                <label class="switch">
                    <input id="linked_in_checkbox" type="checkbox" onchange="reloadList()" <?php if($linked_in_active) { echo 'checked';} ?>>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div style="float: right;margin-top: 4px;">
            <span>Number of contacts on the list: </span><span id="num-contacts"><?= $numContacts  ?></span>
        </div>
    </div>
    <div class="panel" id="contacts_table_holder">
        <?php echo $contacts_table; ?>
    </div>
</div>

<script type="text/javascript">
    function reloadList() {
        var facebook_selected = document.querySelector('#facebook_checkbox:checked') != null;
        var linked_in_selected = document.querySelector('#linked_in_checkbox:checked') != null;

        $.ajax({
            type: "GET",
            url: "getContacts",
            dataType: "json",
            contentType: "application/json;charset=utf-8",
            data: {
                facebook_selected : facebook_selected,
                linked_in_selected : linked_in_selected
            },
            success: function (result) {
                $('#contacts_table_holder').html(result.html);
                $('#num-contacts').html(result.numContacts);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
</body>
</html>