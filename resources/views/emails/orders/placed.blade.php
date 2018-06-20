<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title></title>
    <!-- <style> -->
</head>
<body>
<span class="preheader"></span>
<table class="body">
    <tr>
        <td class="center" align="center" valign="top">
            <center data-parsed="">
                <style type="text/css" align="center" class="float-center">
                    body,
                    html,
                    .body {
                        background: #f3f3f3 !important;
                    }
                </style>

                <table align="center" class="container float-center"><tbody><tr><td>

                            <table class="spacer"><tbody><tr><td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td></tr></tbody></table>

                            <table class="row"><tbody><tr>
                                    <th class="small-12 large-12 columns first last"><table><tr><th>
                                                    <h1>Grazie per il tuo ordine</h1>
                                                    <p>Grazie per aver scelto Bloom Factory!</p>

                                                    <table class="spacer"><tbody><tr><td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td></tr></tbody></table>

                                                    <table class="callout"><tr><th class="callout-inner secondary">
                                                                <table class="row"><tbody><tr>
                                                                        <th class="small-12 large-6 columns first"><table><tr><th>
                                                                                        <p>
                                                                                            <strong>Payment Method</strong><br>
                                                                                            Stripe
                                                                                        </p>
                                                                                        <p>
                                                                                            <strong>Email Address</strong><br>
                                                                                            {{ $order->billing_email }}
                                                                                        </p>
                                                                                        <p>
                                                                                            <strong>Order ID</strong><br>
                                                                                            {{ $order->id }}
                                                                                        </p>
                                                                                    </th></tr></table></th>
                                                                        <th class="small-12 large-6 columns last"><table><tr><th>
                                                                                        <p>
                                                                                            <strong>Shipping Address</strong><br>
                                                                                            {{ $order->billing_address }}<br>
                                                                                            {{ $order->billing_city }}<br>
                                                                                            {{ $order->billing_province }} - {{ $order->billing_postcode }}
                                                                                        </p>
                                                                                    </th></tr></table></th>
                                                                    </tr></tbody></table>
                                                            </th><th class="expander"></th></tr></table>

                                                    <h4>Dettagli ordine</h4>

                                                    <table>
                                                        <tr><th>Item</th><th>#</th><th>Price</th></tr>
                                                        <tr><td>Ship's Cannon</td><td>2</td><td>$100</td></tr>
                                                        <tr><td>Ship's Cannon</td><td>2</td><td>$100</td></tr>
                                                        <tr><td>Ship's Cannon</td><td>2</td><td>$100</td></tr>
                                                        <tr>
                                                            <td colspan="2"><b>Subtotal:</b></td>
                                                            <td>€ {{ round($order->billing_total / 100, 2) }}</td>
                                                        </tr>
                                                    </table>

                                                    <hr>

                                                    <h4>What's Next?</h4>

                                                    <p>Our carrier raven will prepare your order for delivery. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi necessitatibus itaque debitis laudantium doloribus quasi nostrum distinctio suscipit, magni soluta eius animi voluptatem qui velit eligendi quam praesentium provident culpa?</p>
                                                </th></tr></table></th>
                                </tr></tbody></table>
                            <table class="row footer text-center"><tbody><tr>
                                    <th class="small-12 large-3 columns first"><table><tr><th>
                                                    <img src="http://placehold.it/170x30" alt="">
                                                </th></tr></table></th>
                                    <th class="small-12 large-3 columns"><table><tr><th>
                                                    <p>
                                                        Call us at 800.555.1923<br>
                                                        Email us at support@discount.boat
                                                    </p>
                                                </th></tr></table></th>
                                    <th class="small-12 large-3 columns last"><table><tr><th>
                                                    <p>
                                                        123 Maple Rd<br>
                                                        Campbell, CA 95112
                                                    </p>
                                                </th></tr></table></th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>

            </center>
        </td>
    </tr>
</table>
<!-- prevent Gmail on iOS font size manipulation -->
<div style="display:none; white-space:nowrap; font:15px courier; line-height:0;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
</body>
</html>