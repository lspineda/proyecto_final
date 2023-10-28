@extends('include.master')

@section('title','Inventario | Reportes')

@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Reporte de Ventas</h2>
			</div>

			<div class="body">

				<div class="table-responsive">
					<table class="table table-bordered table-condensed">
						<thead>
							<tr>
								<td colspan="11" style="border: none !important;">
									<h3 style="text-align: center;">{{ $company->name }}</h3>
								</td>
							</tr>

							<tr style="border: none !important;">
								<td colspan="11" style="border: none !important;">
									<p style="text-align: center;">{{ $company->address }} <br> {{ $company->phone }}</p>
								</td>
							</tr>

							<tr style="border: none !important;">
								<td colspan="11" style="border: none !important;">
									<p style="text-align: center;font-weight: bold;">Reporte de Ventas desde el {{ date('j M Y',strtotime($start_date)) }} hasta el {{ date('j M Y',strtotime($end_date)) }}</p>
								</td>
							</tr>

							<tr>
								<th>Producto</th>
								<th>Fecha de Venta</th>
								<th>Cliente</th>
								<th>Vendedor</th>
								<th>Precio Unitario de Compra</th>
								<th>Precio Unitario de Venta</th>
								<th>Cantidad</th>
								<th>Descuento</th>
								<th>Total Importe de Compra</th>
								<th>Total Importe de Venta</th>
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
							$total_quantity += $value->sold_quantity;
							$total_buy_price += $value->total_buy_price;
							$total_sold_price += $value->total_sold_price;
							$total_discount += $value->discount_amount;
							?>

							<tr>
								<td>{{ $value->product->name }}</td>
								<td>{{ date("j M Y", strtotime($value->selling_date) ) }}</td>
								<td>{{ $value->customer->name }}</td>
								<td>{{ $value->user->name }}</td>
								<td>{{ $value->buy_price }}</td>
								<td>{{ $value->sold_price }}</td>
								<td>{{ $value->sold_quantity }}</td>
								<td>{{ $value->discount_amount }}</td>
								<td>{{ $value->total_buy_price }}</td>
								<td>{{ $value->total_sold_price }}</td>
							</tr>
							@endforeach

							<tr>
								<th colspan="6" style="text-align: right;">Total =</th>
								<th>{{ round($total_quantity) }}</th>
								<th>{{ round($total_discount) }}</th>
								<th>{{ round($total_buy_price) }}</th>
								<th>{{ round($total_sold_price) }}</th>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection