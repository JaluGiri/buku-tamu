<?php

include('function.php');

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="library/jstable.css" />

        <script src="library/jstable.min.js" type="text/javascript"></script>

        <link rel="stylesheet" href="admin.css">

        <link rel="stylesheet" href="style.css">

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <title>Vanilla DataTables CRUD Application - Update or Edit Mysql Table Data - 3</title>
    </head>
    <body>

            <span id="success_message"></span>
                    <div class="row">
                        <div class="col col-md-6">
                            <button type="button" name="add_data" id="add_data" class="add">Tambah Data</button>
                        </div>
                    </div>
                        <table id="customer_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo fetch_top_five_data($connect); ?>
                            </tbody>
                        </table>
    </body>
</html>


<div class="modal" id="customer_modal" tabindex="-1">
    <form method="post" id="customer_form">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="modal_title">Tambah Admin</h5>

                    <button type="button" class="btn-close" id="close_modal" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" />
                        <span class="text-danger" id="nama_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" name="password" id="password" class="form-control" />
                        <span class="text-danger" id="password_error"></span>
                    </div>

                <div class="modal-footer">

                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <button type="button" class="btn btn-primary" id="action_button">Add</button>
                </div>

            </div>

        </div>

    </form>

</div>

<div class=" fade show" id="modal_backdrop" style="display:none;"></div>

<script>

var table = new JSTable("#customer_table", {
    serverSide : true,
    deferLoading : <?php echo count_all_data($connect); ?>,
    ajax : "fetch.php"
});

function _(element)
{
    return document.getElementById(element);
}

function open_modal()
{
    _('modal_backdrop').style.display = 'block';
    _('customer_modal').style.display = 'block';
    _('customer_modal').classList.add('show');
}

function close_modal()
{
    _('modal_backdrop').style.display = 'none';
    _('customer_modal').style.display = 'none';
    _('customer_modal').classList.remove('show');
}

function reset_data()
{
    _('customer_form').reset();
    _('action'          ).value     = 'Add'     ;
    _('name_error'      ).innerHTML = ''        ;
    _('password_error'  ).innerHTML = ''        ;
    _('modal_title'     ).innerHTML = 'Add Data';
    _('action_button'   ).innerHTML = 'Add'     ;
}

_('add_data').onclick = function(){
    open_modal();
    reset_data();
}

_('close_modal').onclick = function(){
    close_modal();
}

_('action_button').onclick = function(){

    var form_data = new FormData(_('customer_form'));

    _('action_button').disabled = true;

    fetch('action.php', {

        method:"POST",

        body:form_data

    }).then(function(response){

        return response.json();

    }).then(function(responseData){

        _('action_button').disabled = false;

        if(responseData.success)
        {
            _('success_message').innerHTML = responseData.success;

            close_modal();

            table.update();
        }
        else
        {
            if(responseData.name_error)
            {
                _('name_error').innerHTML = responseData.name_error;
            }
            else
            {
                _('name_error').innerHTML = '';
            }

            if(responseData.password_error)
            {
                _('password_error').innerHTML = responseData.password_error;
            }
            else
            {
                _('password_error').innerHTML = '';
            }

        }

    });

}

function view_data(id)
{
    var form_data = new FormData();

    form_data.append('id', id);

    form_data.append('action', 'view');

    fetch('action.php', {

        method:"POST",

        body:form_data

    }).then(function(response){

        return response.json();

    }).then(function(responseData){

        _('name').value = responseData.name;

        _('password').value = responseData.password;

        _('id').value = id;

        _('action_button').innerHTML = 'View';

        open_modal();

    });
}

function fetch_data(id)
{
    var form_data = new FormData();

    form_data.append('id', id);

    form_data.append('action', 'fetch');

    fetch('action.php', {

        method:"POST",

        body:form_data

    }).then(function(response){

        return response.json();

    }).then(function(responseData){

        _('name').value = responseData.name;

        _('password').value = responseData.password;
        
        _('id').value = id;

        _('action').value = 'Update';

        _('modal_title').innerHTML = 'Edit Data';

        _('action_button').innerHTML = 'Edit';

        open_modal();

    });
}

function delete_data(id)
{
    if(confirm("Are you sure you want to remove it?"))
    {
        var form_data = new FormData();

        form_data.append('id', id);

        form_data.append('action', 'delete');

        fetch('action.php', {

            method:"POST",

            body:form_data

        }).then(function(response){

            return response.json();

        }).then(function(responseData){

            _('success_message').innerHTML = responseData.success;

            table.update();

        });
    }
}

</script>