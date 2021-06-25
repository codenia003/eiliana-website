<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Eiliana invoice</title>
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}"> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/invoice.css') }}">
	</head>

	<body>
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
									Invoice #: {{ $campaigns->invoice_no }}<br />
									Created: {{ \Carbon\Carbon::parse($campaigns->created_at)->format('j F Y') }}<br />
									Due: {{ \Carbon\Carbon::parse($campaigns->invoice_due_date)->format('d/m/Y') }}
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

					<td>{{ $campaigns->invoice_amount }}</td>
				</tr>

				<tr class="heading">
					<td>Total</td>

					<td>Price</td>
				</tr>

				<!-- <tr class="item">
					<td>Website design</td>

					<td>$300.00</td>
				</tr>

				<tr class="item">
					<td>Hosting (3 months)</td>

					<td>$75.00</td>
				</tr>

				<tr class="item last">
					<td>Domain name (1 year)</td>

					<td>$10.00</td>
				</tr> -->

				<tr class="total">
					<td></td>

					<td>Total: ${{ $campaigns->invoice_amount }}</td>
				</tr>
			</table>
		</div>
	</body>
</html>