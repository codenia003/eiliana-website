@extends('emails/layouts/invoiceTemplate')

@section('content')

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ URL::to('/assets/img/logo.png') }}" style="width: 100%; max-width: 140px" />
                        </td>

                        <td>
                            Invoice #: {{ $data->invoice_no }}<br />
                            Created: {{ \Carbon\Carbon::parse($data->created_at)->format('j F Y') }}<br />
                            <!-- Due: {{ \Carbon\Carbon::parse($campaigns->invoice_due_date)->format('d/m/Y') }} -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Sparksuite, Inc.<br />
                            12345 Sunny Road<br />
                            Sunnyville, CA 12345
                        </td>

                        <td>
                            Acme Corp.<br />
                            John Doe<br />
                            john@example.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr> -->

        <tr class="heading">
            <td>Payment Method</td>
            <td>Check #</td>
        </tr>

        <tr class="details">
            <td>Check</td>
            <td>{{ $data->invoice_amount }}</td>
        </tr>

        <tr class="heading">
            <td>Total</td>
            <td>Price</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Total: ${{ $data->invoice_amount }}</td>
        </tr>
    </table>
    <table bg-color="#7f8c8d" style="font-family: 'Montserrat', Arial, sans-serif;color:#7f8c8d" width="100%" bgcolor="#fff" align="center" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td data-bg="header bg" data-bgcolor="header bg" align="center" bgcolor="#ececec">
                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="600" align="center" bgcolor="#403e3e">
                                    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" data-link-style="text-decoration:none; color:#a2a9af;" data-link-color="Content" data-size="Content" data-color="Content" style="font-family: 'Open Sans', Arial, sans-serif; font-size:15px; color:#a2a9af; line-height:30px;">
                                                <singleline>
                                                    © {{ date('Y') }}. Designed by <a href="https://themeforest.net/user/jyostna" style="font-family: 'Open Sans', Arial, sans-serif; font-size:15px; color:#fec400 ;" data-color="copy right color">Jyostna</a>
                                                </singleline>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

