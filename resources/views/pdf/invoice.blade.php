<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css">

    <style>
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: left;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #000;
            font-size: 1.6em;
            background: #eee
        }

        .invoice table .unit {
            background: #eee
        }

        .invoice table .total {
            background: #eee;
            color: #000
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

    </style>
</head>

<body>
    <div id="invoice">
        <div class="toolbar hidden-print">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="https://lobianijs.com">
                                <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png"
                                    data-holder-rendered="true" />
                            </a>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="https://lobianijs.com">
                                    Arboshiki
                                </a>
                            </h2>
                            <div>455 Foggy Heights, AZ 85004, US</div>
                            <div>(123) 456-789</div>
                            <div>company@example.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h2 class="to">{{ $invoice_details->billingAddress->billing_name }}</h2>
                            <div class="address">
                                {{ $invoice_details->billingAddress->billing_postal_code }},
                                {{ $invoice_details->billingAddress->billingCity->name }},
                                {{ $invoice_details->billingAddress->billingCountry->name }}
                            </div>
                            <div class="email"><a href="mailto:{{ $invoice_details->billingAddress->billing_email }}">{{ $invoice_details->billingAddress->billing_email }}</a></div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">{{ $invoice_details->invoice_id }}</h1>
                            <div class="date">Date of Invoice: {{ $invoice_details->created_at->format('d-m-Y') }}</div>
                            {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">Name</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice_details->orderDetails as $data)
                            <tr>
                                <td class="no">{{ $loop->index + 1 }}</td>
                                <td class="unit">
                                    {{ $data->orderProducts->name }}</td>
                                <td class="total">
                                    {{ $data->orderProducts->price    }}</td>
                                <td class="qty">
                                    {{ $data->quantity }}</td>
                                <td class="total">
                                    {{ $data->product_quantity * $data->orderProducts->price }}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Subtotal</td>
                                <td>{{ $invoice_details->subtotal }} ৳</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Discount</td>
                                <td>{{ $invoice_details->discount_amount }} ৳</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Total</td>
                                <td>{{ $invoice_details->total }} ৳</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">Thank you!</div>
                    {{-- <div class="notices">
                        <div>NOTICE:</div>
                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances
                            after 30 days.</div>
                    </div> --}}
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('#printInvoice').click(function () {
            Popup($('.invoice')[0].outerHTML);

            function Popup(data) {
                window.print();
                return true;
            }
        });

    </script>
</body>

</html>
