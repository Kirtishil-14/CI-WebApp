<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajax Crud App</title>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>

    <body>

        <div id="response">

        </div>
        <div>
            <table id="carModelList">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                <?php if (!empty($rows)) { ?>
                <?php foreach ($rows as $row) {
                    $data['row'] = $row;
                    $this->load->view('car_model/car_row.php', $data);
                } ?>
                <?php } else { ?>
                <tr>
                    <td>No data found</td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <script>
        $(document).ready(() => {

            $.ajax({
                type: "POST",
                url: '<?php echo base_url() . 'index.php/CarModel/showCreateForm'; ?>',
                data: {},
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('#response').html(response.html);
                }
            });

            $("body").on('submit', '#createCarModel', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() . 'index.php/CarModel/saveModel'; ?>',
                    data: $('#createCarModel').serialize(),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 0) {
                            if (response['name'] != "") {
                                $('.nameError').html(response['name']);
                            } else {
                                $('.nameError').html('');
                            }

                        } else {
                            $('.nameError').html('');

                            $('#carModelList').append(response['row']);
                            $('#name').val('');

                        }
                    }
                });
            })
        });

        function showEditForm(id) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/CarModel/getCarModel/' ?>" + id,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('#response').html(response.html);
                }
            });
        }

        $("body").on('submit', '#editCarModel', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() . 'index.php/CarModel/updateModel'; ?>',
                data: $('#editCarModel').serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response['status'] == 0) {
                        if (response['name'] != "") {
                            $('.nameError').html(response['name']);
                        } else {
                            $('.nameError').html('');
                        }
                    } else {
                        $('.nameError').html('');

                        $('#name').val('');

                        let id = response['row']['id'];
                        $('#row-' + id + " .modelName").html(response['row']['name']);
                        $('#row-' + id + " .modelCreatedAt").html(response['row']['created_at']);
                        $('#row-' + id + " .modelUpdatedAt").html(response['row']['updated_at']);

                    }
                }
            });
        })

        function confirmDeleteModel(id) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/CarModel/deleteModel/' ?>" + id,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response['status'] == 0) {
                        alert('Error');
                    } else {
                        $('#row-' + id).remove();
                    }
                }
            });
        }
        </script>

    </body>

</html>