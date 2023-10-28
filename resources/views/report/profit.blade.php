@extends('include.master')

@section('title','Inventario | Reportes')

@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Reporte de Ganancias</h2>
			</div>

			<div class="body">

				<div class="table-responsive">
					<table class="table table-bordered table-condensed">
						<thead>
							<tr>
								<td colspan="5" style="border: none !important;">
									<h3 style="text-align: center;">{{ $company->name }}</h3>
								</td>
							</tr>

							<tr style="border: none !important;">
								<td colspan="5" style="border: none !important;">
									<p style="text-align: center;">{{ $company->address }} <br> {{ $company->phone }}</p>
								</td>
							</tr>

							<tr style="border: none !important;">
								<td colspan="5" style="border: none !important;">
									<p style="text-align: center;font-weight: bold;">Reporte de Ganancias desde el {{ date('j M Y',strtotime($start_date)) }} hasta el {{ date('j M Y',strtotime($end_date)) }}</p>
								</td>
							</tr>

							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Total Importe de Venta</th>
								<th>Total Importe de Compra</th>
								<th>Ganancia</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$total_quantity = 0;
							$total_buy_price = 0;
							$total_sold_price  = 0;
							$total_discount  = 0;
							?>

							@foreach($data as $value)
							<?php
							$total_quantity += $value->total_quantity;
							$total_buy_price += $value->total_buy_price;
							$total_sold_price += $value->total_sold_price;
							?>

							<tr>
								<td>{{ $value->product->name }}</td>
								<td>{{ $value->total_quantity }}</td>
								<td>{{ $value->total_sold_price }}</td>
								<td>{{ $value->total_buy_price }}</td>
								<td>{{ $value->total_sold_price - $value->total_buy_price }}</td>
							</tr>
							@endforeach

							<tr>
								<th style="text-align: right;">Total =</th>
								<th>{{ round($total_quantity) }}</th>
								<th>{{ round($total_sold_price) }}</th>
								<th>{{ round($total_buy_price) }}</th>
								<th>{{ round($total_sold_price-$total_buy_price) }}</th>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection