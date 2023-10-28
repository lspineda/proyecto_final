@extends('include.master')

@section('title','Inventario | Reportes')

@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Reporte de Deudas</h2>
			</div>


			<div class="body">

				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="4" style="border: none !important;">
									<h3 style="text-align: center;">{{ $company->name }}</h3>
								</td>
							</tr>

							<tr style="border: none !important;">
								<td colspan="4" style="border: none !important;">
									<p style="text-align: center;">{{ $company->address }} <br> {{ $company->phone }}</p>
								</td>
							</tr>

							<tr style="border: none !important;">
								<td colspan="4" style="border: none !important;">
									<p style="text-align: center;font-weight: bold;">Reporte de Deudas desde el {{ date('j M Y',strtotime($start_date)) }} hasta el {{ date('j M Y',strtotime($end_date)) }}</p>
								</td>
							</tr>

							<tr>
								<th>Cliente</th>
								<th>Total Importe</th>
								<th>Importe Pagado</th>"
								<th>Pendiente</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$total_amount = 0;
							$total_paid  = 0;
							$total_discount  = 0;
							?>

							@foreach($data as $value)
							<?php
							$total_amount += $value->total_amount;
							$total_paid += $value->paid_amount;
							?>

							<tr>
								<td>{{ $value->customer->name }}</td>
								<td>{{ $value->total_amount }}</td>
								<td>{{ $value->paid_amount }}</td>
								<td>{{ $value->total_amount - $value->paid_amount }}</td>
							</tr>
							@endforeach

							<tr>
								<th style="text-align: right;">Total =</th>
								<th>{{ round($total_amount) }}</th>
								<th>{{ round($total_paid) }}</th>
								<th>{{ round($total_amount-$total_paid) }}</th>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection