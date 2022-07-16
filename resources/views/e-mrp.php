
<!DOCTYPE html>
<html>
<head>
    <title>E-MRP-SDI</title>
</head>
<style lang="css">
    *, ::after, ::before {
        box-sizing: border-box;
    }
    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        margin-bottom: 0.5rem;
        font-weight: 300;
        line-height: 1;
    }
    body {
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-size: 0.6rem;
        font-weight: 200;
        line-height: 1;
        color: #212529;
        text-align: left;
        background-color: #fff;
    }
    ul.no-bullets {
        list-style-type: none; /* Remove bullets */
        padding: 0; /* Remove padding */
        margin: 0; /* Remove margins */ 
    }
    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }

    .col {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }

    .col-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .col-5 {
        -ms-flex: 0 0 45.83333333333333%;
        flex: 0 0 45.83333333333333%;
        max-width: 45.83333333333333%;
    }

    .col-6 {
        -ms-flex: 0 0 54.16666666666667%;
        flex: 0 0 54.16666666666667%;
        max-width: 54.16666666666667%;
    }

    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 10px;
        padding-left: 10px;
    }

    .mt-5 {
        margin-top: 3rem!important;
    }

    .mt-3 {
        margin-top: 1rem!important;
    }

    .mt-2 {
        margin-top: 0.5rem!important;
    }

    .table-bordered {
        border: 0.5px solid #dee2e6;
    }
    
    .table {
        width: 100%;
        margin-bottom: 0.5rem;
        color: #212529;
    }
    
    .table-bordered {
        border: 0.5px solid #dee2e6;
    }
    
    .table-bordered td, .table-bordered th {
        border: 0.5px solid #dee2e6;
    }

    .p-2 {
        padding: 0.5rem!important;
    }

    .pt-2 {
        padding-top: 0.5rem!important;
    }

    .pl-2 {
        padding-left: 0.5rem!important;
    }

    .pr-2 {
        padding-left: 0.5rem!important;
    }

    .px-0 {
        padding-left: 0px!important;
        padding-right: 0px!important;
    }

    .mr-2 {
        margin-right: 0.5rem!important;
    }

    .border-dark {
        border-color: #343a40!important;
    }

    .border {
        border: 1px solid #dee2e6!important;
    }

    .text-center {
        text-align: center;
    }
</style>
<body class="px-10">
    <h3><?php echo $data[0]['supplier']; ?></h3>
    <table class="table table-bordered mt-3">
        <tr>
            <th scope="col" class="px-6 py-3">No.</th>
            <th scope="col" class="px-6 py-3">
                Barang
            </th>
            <th scope="col" class="px-6 py-3"></th>
            <?php 
            date_default_timezone_set('Asia/Jakarta');
            for ($i=1; $i <= 12; $i++) { 
                $month = date('M', mktime(0, 0, 0, $i, 10)); 
            ?>
            <th
                scope="col"
                class="px-6 py-3"
            >
                <?php echo $month; ?>
            </th>
            <?php } ?>
        </tr>
        <?php $num = 1; ?>
        <?php foreach ($data as $key => $val) { ?>
        <tr>
            <td><?= $num ?></td>
            <td><?= $val['material'] ?></td>
            <td
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
            >
                <ul class="no-bullets">
                    <li class="text-green-300">
                        Rencana Produksi
                    </li>
                    <li class="text-red-400">
                        Rencana Po
                    </li>
                    <li class="text-red-300">Qty Po</li>
                    <li class="text-purple-300">
                        Outstanding Po
                    </li>
                    <li class="text-yellow-300">
                        Actual Kedatangan
                    </li>
                    <li class="text-blue-300">Stock</li>
                    <li class="text-gray-300">
                        Standar Stock
                    </li>
                </ul>
            </td>
            <?php foreach ($val['month'] as $key => $month) { ?>
            <td>
                <ul class="no-bullets">
                    <li class="text-green-300">
                        <?= $month['production'] ?>
                    </li>
                    <li class="text-red-300">
                        <?= $month['rencana_po'] ?>
                    </li>
                    <li class="text-red-300">
                        <?= $month['qty_po'] ?>
                    </li>
                    <li class="text-purple-300">
                        <?= $month['outstanding'] ?>
                    </li>
                    <li class="text-yellow-300">
                        <?= $month['incoming'] ?>
                    </li>
                    <li class="text-blue-300">
                        <?= $month['stock'] ?>
                    </li>
                    <li class="text-gray-300">
                        <?= $month['standar_stock'] ?>
                    </li>
                </ul>
            </td>
            <?php } ?>
        </tr>
        <?php $num++; ?>
        <?php } ?>
    </table>
  
</body>
</html>