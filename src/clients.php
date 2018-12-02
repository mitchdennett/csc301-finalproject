<?php

// Create and include a configuration file with the database connection
include('config.php');

$showSearch = True;

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head.php");?>
</head>

<body class="sidebar-mini">
    <?php include("includes/sidenav.php");?>
    <!-- Main content -->
    <div class="main-panel">
        <!-- Top navbar -->
        <?php include("includes/topnav.php");?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="mb-0" style="float:left;">Clients</h3>
                            <a href="./newClient.php" class="btn btn-success" role="button" aria-disabled="true" style="float:right">
                                <span class="btn-label">
                                    <i class="nc-icon nc-simple-add"></i>
                                </span>
                                New Client

                            </a>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>
    <?php include('includes/jsimports.php'); ?>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                ajax: './api.php?request=clients',
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "serverSide": true,
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                "columnDefs": [{
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function(data, type, row) {
                        return '<button class="btn btn-warning btn-link btn-icon btn-sm edit"><i class="fa fa-edit"></i></button>';
                    },
                    "targets": 5
                }]

            });

            // var table = $('#datatable').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');

                var data = table.row($tr).data();
                window.location.href = "./newClient.php?id=" + data[5];
            });
        });
    </script>
</body>

</html>