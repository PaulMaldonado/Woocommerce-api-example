<?php
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

use Automattic\WooCommerce\HttpClient\HttpClientException;

$woocommerce = new Client(
    'https://nutremi.com/',
    'ck_c9bc6f0250f826383e65c081d43debb2b6f189ea',
    'cs_c5a77ec2b6da728d999cfefcd2a5ca3e3a35d27e',
    [
        'wp_api' => true,
        'version' => 'wc/v3',
    ]
);


try {
    $orders = $woocommerce->get('orders');
    $products = $woocommerce->get('products');
    $customers = $woocommerce->get('customers');
    $reports = $woocommerce->get('reports');

    $count_orders = count($orders);
    $count_products = count($products);
    $count_customers = count($customers);
    $count_reports = count($reports);
} catch (HttpClientException $e) {
    $e->getMessage();
    $e->getRequest();
    $e->getResponse();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutremi - Woocommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="col-sm-12 col-sm-offset-3 col-md-10 col-md-offset-1">

        <h1 class="page-header mt-4">Dashboard</h1>



        <div class="row placeholders mt-4">

            <div class="col-xs-6 col-sm-3 placeholder">

                <p id="large">

                    <?php echo $count_orders ?>

                </p>

                <hr>

                <span class="text-muted">Total de pedidos</span>

            </div>

            <div class="col-xs-6 col-sm-3 placeholder">

                <p id="large">

                    <?php echo $count_customers ?>

                </p>

                <hr>



                <span class="text-muted">Clientes</span>

            </div>

            <div class="col-xs-6 col-sm-3 placeholder">

                <p id="large">

                    <?php echo $count_products ?>

                </p>

                <hr>

                <span class="text-muted">Todos los productos</span>

            </div>

            <div class="col-xs-6 col-sm-3 placeholder">

                <p id="large">

                    <?php echo $count_reports ?>

                </p>

                <hr>

                <span class="text-muted">Total Ventas</span>

            </div>

        </div>

    </div>



    <div class="container">
        <h2 class="sub-header">Lista de pedidos</h2>
        <div class='table-responsive'>
            <table id='myTable' class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Orden #</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Contacto</th>
                        <th>Fecha de orden</th>
                        <th>Código postal</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Correo electrónico</th>
                        <th>Estatus del pedido</th>
                        <th>Divisa</th>
                        <th>Total</th>
                        <th>Detalle del pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                        echo "<tr>
                            <td>" . $order->id . "</td>
                            <td>" . $order->billing->first_name . $order->billing->last_name . "</td>
                            <td>" . $order->shipping->address_1 . "</td>
                            <td>" . $order->shipping->phone . "</td>
                            <td>" . $order->date_created . "</td>
                            <td>" . $order->billing->postcode . "</td>
                            <td>" . $order->billing->city . "</td>
                            <td>" . $order->billing->state . "</td>
                            <td>" . $order->billing->email . "</td>
                            <td>" . $order->status . "</td>
                            <td>" . $order->currency . "</td>
                            <td>" . $order->total . "</td>
                            <td>
                            <a class='btn btn-primary' href=".$order->id.">Detalle</a></td>
                         </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>