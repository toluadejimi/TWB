@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> 'Messages log reports'])
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col-12">
		<div class="row d-flex justify-content-between flex-wrap">
			<div class="col">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<span class="h2 font-weight-bold mb-0 total-transfers" id="total-device">
									{{ number_format($total_sold) }}
								</span>
							</div>
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="fi fi-rs-rocket-lunch mt-2"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('Total Logs') }}</h5>
						<p></p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<span class="h2 font-weight-bold mb-0 total-transfers" id="total-active">
									{{ number_format($total_amount, 2)  }}
								</span>
							</div>
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="fi fi-rs-calendar-day mt-2"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('Total Money Spent') }}</h5>
						<p></p>
					</div>
				</div>
			</div>
			{{-- <div class="col">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<span class="h2 font-weight-bold mb-0 completed-transfers" id="total-inactive">
									{{ number_format($last30_messages) }}
								</span>
							</div>
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="ni ni-calendar-grid-58"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('Last 30 days Messages') }}</h5>
						<p></p>
					</div>
				</div>
			</div> --}}
		</div>

		@if(count($solds ?? []) == 0)
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<center>
							<img src="{{ asset('assets/img/404.jpg') }}" height="500">
							<h3 class="text-center">{{ __('!Opps You Have Not Created Any Message Transactions') }}</h3>
						</center>
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="card">			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table class="table col-12">
							<thead>
								<tr>
									<tr>
										<th class="col-1">{{ __('Customer') }}</th>
										<th class="col-1">{{ __('Data') }}</th>
										<th class="col-1">{{ __('Area Code') }}</th>
										<th class="col-4">{{ __('Amount') }}</th>
										<th class="col-1">{{ __('Status') }}</th>
										<th class="col-1">{{ __('Date') }}</th>
									  </tr>
								</tr>
							</thead>
							<tbody class="tbody">
								@foreach($solds ?? [] as $trx)
								<tr>
									<td class="">
									  {{ $trx->user->name ?? Auth::user()->name }}
									</td>
									<td class="">
										{{ $trx->data }}
									</td>
									<td class="">
										{{ $trx->area_code }}
									</td>
					  
									<td class="">
									  {{ number_format($trx->amount, 2) }}
									</td>
					  
									@if($trx->status == "3")
									<td><span class="badge rounded-pill bg-danger text-white ">Decline</span></td>
									@elseif($trx->status == "0")
									<td><span class="badge rounded-pill bg-success text-white">Sold</span></td>
									@else
									<td><span class="badge rounded-pill bg-warning">Pending</span></td>
									@endif
					  
					  
					  
					  
									<td class="">
									  {{ $trx->created_at->format('d F y H i s') }}
									</td>
								  </tr>
								@endforeach
							</tbody>
						</table>
						<div class="d-flex justify-content-center">{{ $solds->links('vendor.pagination.bootstrap-4') }}</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>


@endsection
