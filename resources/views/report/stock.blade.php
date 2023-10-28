@extends('include.master')

@section('title','Inventario | Reportes')

@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>Reporte de Ingresos</h2>
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
									<p style="text-align: center;font-weight: bold;">Reporte de Ingresos desde el {{ date('j M Y',strtotime($start_date)) }} hasta el {{ date('j M Y',strtotime($end_date)) }}</p>
								</td>
							</tr>

							<tr>
								<th>Producto</th>
								<th>Categoría</th>
								<th>Fecha</th>
								<th>Ingresado por</th>
								<th>Precio de Compra</th>
								<th>Precio de Venta</th>
								<th>Cantidad en Inventario</th>
								<th>Cantidad Vendida</th>
								<th>Cantidad Actual</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$total_quantity = 0;
							$total_sold_quantiy = 0;
							?>

							@foreach($data as $value)
							<?php
							$total_quantity += $value->stock_quantity;
							$total_sold_quantiy += $value->sold_qty;
							?>

							<tr>
								<td>{{ $value->product->name }}</td>
								<td>{{ $value->category->name }}</td>
								<td>{{ date("j M Y", strtotime($value->created_at) ) }}</td>
								<td>{{ $value->user->name }}</td>
								<td>{{ $value->buying_price }}</td>
								<td>{{ $value->selling_price }}</td>
								<td>{{ $value->stock_quantity }}</td>
								<td>{{ $value->sold_qty }}</td>
								<td>{{ $value->stock_quantity - $value->sold_qty }}</td>
							</tr>
							@endforeach

							<tr>
								<th colspan="6" style="text-align: right;">Total =</th>
								<th>{{ round($total_quantity) }}</th>
								<th>{{ round($total_sold_quantiy) }}</th>
								<th>{{ round($total_quantity-$total_sold_quantiy) }}</th>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection