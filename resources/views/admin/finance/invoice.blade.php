@extends('admin/finance/layout')

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
                            Invoice No: #{{ $invoice_data->contractdetails->orderinvoice->invoice_no }}<br />
                            Invoice date: {{ $invoice_data->contractdetails->orderinvoice->invoice_due_date }}<br />
                        </td>
                        
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                        {{ $invoice_data->projectdetail->companydetails->address }}.<br />
                        @if(!empty($country_name->name))
                           {{ $country_name->name }}
                        @endif
                        </td>

                        <td>
                          {{ $invoice_data->projectdetail->companydetails->full_name }}<br />
                          {{ $invoice_data->projectdetail->companydetails->email }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        @if($invoice_data->contractdetails->model_engagement == '1')
            <tr class="heading">
                <td>Per Hour Rate</td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                <td>{{ $invoice_data->projectdetail->projectCurrency->symbol }}{{ $invoice_data->bid_amount }}</td>
            </tr>

            <tr class="heading">
                <td>No Of Hour Purchase</td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                @foreach($invoice_data->contractdetails->paymentschedule as $paymentschedule)
                <td>{{ $paymentschedule->hours_purchase }}</td>
                @endforeach
            </tr>

        @elseif($invoice_data->contractdetails->model_engagement == '2') 
            <tr class="heading">
                <td>Service Charge Per Month</td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                <td>{{ $invoice_data->projectdetail->projectCurrency->symbol }}{{ $invoice_data->bid_amount }}</td>
            </tr>

            <tr class="heading">
                <td>Contract Duration</td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                <td>{{ $invoice_data->projectdetail->project_duration_max }}</td>
            </tr>

            <tr class="heading">
                <td>Billing Period</td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                <td>0</td>
            </tr>
        @else
            <tr class="heading">
                <td>Service Charge</td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                <td>{{ $invoice_data->projectdetail->projectCurrency->symbol }}{{ $invoice_data->bid_amount }}</td>
            </tr>

            <tr class="heading">
                <td>Milestone No </td>
                <td> </td>
            </tr>

            <tr class="details">
                <td></td>
                @foreach ($invoice_data->projectschedulee->schedulemodulee as $item)
                  <td>{{ $item->milestone_no }}</td>
                @endforeach
            </tr>

        @endif

        <tr class="heading">
            <td colspan="2">Description</td>
        </tr>

        <tr class="details">
            <td colspan="2">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                but also the leap into electronic typesetting, remaining essentially unchanged.</td>
        </tr>

        <tr class="heading">
            <td>GST Amount</td>
            <td> </td>
        </tr>

        <tr class="details">
            <td></td>
            <td>{{ $invoice_data->projectdetail->projectCurrency->symbol }}0</td>
        </tr>

        <!-- <tr class="heading">
            <td>Payment Method</td>
            <td> </td>
        </tr>

        <tr class="details">
            <td></td>
            <td>Razorpay</td>
        </tr> -->

        <tr class="heading">
            <td>Total</td>
            <td></td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Total: {{ $invoice_data->projectdetail->projectCurrency->symbol }}{{ $invoice_data->contractdetails->orderinvoice->invoice_amount }}</td>
        </tr>
    </table>
    <div class="form-group text-right mt-5" style="text-align: left !important;">
        <div class="btn-group" role="group">
            <button class="btn btn-primary" style="font-size: 17px !important;" type="button">
                Send To Customer 
            </button>
        </div>
    </div>
    <!-- <table bg-color="#7f8c8d" style="font-family: 'Montserrat', Arial, sans-serif;color:#7f8c8d" width="100%" bgcolor="#fff" align="center" border="0" cellspacing="0" cellpadding="0">
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
    </table> -->
</div>
@endsection
