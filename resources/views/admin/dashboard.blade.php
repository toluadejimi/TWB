@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> __('Dashboard')])
@endsection
@section('content')
<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-2">{{ __('Total Orders') }}</h5>
						<h3>{{number_format($total_order)}}</h3>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
							<i class="fi  fi-rs-boxes mt-1"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-2">{{ __('Total Money in Wallet') }}</h5>
						<h3>NGN {{number_format($total_funds_in_wallet, 2)}}</h3>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
							<i class="fi fi-rs-box-alt mt-2"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-2">{{ __('Open Supports') }}</h5>
						<h3>{{number_format($pending_ticket)}}</h3>
					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
							<i class="ni ni-calendar-grid-58"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-2">{{ __('Total Customers') }}</h5>
						<h3>{{number_format($total_user)}}</h3>

					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
							<i class="fi fi-rs-users-alt mt-1"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-2">{{ __('Total Money In') }}</h5>
						<h3>NGN {{number_format($total_in)}}</h3>

					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
							<i class="fi fi-rs-boxes mt-1"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card card-stats">
			<!-- Card body -->
			<div class="card-body">
				<div class="row">
					<div class="col">
						<h5 class="card-title text-uppercase text-muted mb-2">{{ __('Total Money Out') }}</h5>
						<h3>NGN {{number_format($total_out)}}</h3>

					</div>
					<div class="col-auto">
						<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
							<i class="fi fi-rs-boxes mt-1"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




</div>

<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4><i class="fi fi-rs-shopping-cart text-primary"></i> <span class="ml-2">{{ __('Overview Of Sales
						Value') }}</span></h4>
				<div class="card-header-action dropdown">
					<a href="#" data-toggle="dropdown" class="btn btn-neutral btn-sm dropdown-toggle overview-target">{{
						__('Monthly') }}</a>
					<ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
						<li><a href="#" class="dropdown-item overview-list" data-type="Weekly">{{ __('This Week') }}</a>
						</li>
						<li><a href="#" class="dropdown-item overview-list" data-type="Monthly">{{ __('This Month')
								}}</a></li>
						<li><a href="#" class="dropdown-item overview-list" data-type="Yearly">{{ __('This Year') }}</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="card-body">
				<!-- Chart -->
				<div class="chart">
					<canvas id="sales-chart" class="chart-canvas"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="card">
			<div class="card-header card-bottom-min-25">
				<h4><i class="fi  fi-rs-chart-line-up text-primary"></i> <span class="ml-1">{{ __('Statics') }}</span>
				</h4>
			</div>
			<div class="card-body">
				<ul class="list-group list-group-flush list my--3">
					<li class="list-group-item px-0 ml-2">
						<div class="row align-items-center">
							<div class="col ml--2">
								<h4 class="mb-0 text-muted">
									 {{ __('Google Voice') }}
								</h4>
								<h3>{{number_format($gv)}}</h3>

							</div>
						</div>
					</li>
					<li class="list-group-item px-0 ml-2">
						<div class="row align-items-center">
							<div class="col ml--2">
								<h4 class="mb-0 text-muted">
									{{ __('Text Now') }}
								</h4>
								<h3>{{number_format($tn)}}</h3>
							</div>
						</div>
					</li>




					<li class="list-group-item px-0 ml-2">
						<div class="row align-items-center">
							<div class="col ml--2">
								<h4 class="mb-0 text-muted">
									 {{ __('Netflix') }}
								</h4>
								<h3>{{number_format($nf)}}</h3>

							</div>
						</div>
					</li>
					


				</ul>
			</div>
		</div>
	</div>
</div>




<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header border-0">
				<h3 class="mb-0">{{ __('Latest Transactions') }}</h3>
				<form action="" class="card-header-form">
					<div class="input-group">
						<input type="text" name="search" value="{{ $request->search ?? '' }}" class="form-control" placeholder="Search......">
						<select class="form-control" name="type">
							{{-- <option value="email" @if($type == 'email') selected="" @endif>{{ __('User Email') }}</option>
							<option value="invoice_no" @if($type == 'invoice_no') selected="" @endif>{{ __('Invoice No') }}</option>
							 --}}
						</select>
						<div class="input-group-btn">
							<button class="btn btn-neutral btn-icon"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
			<!-- Light table -->
			<div class="table-responsive">
				<table class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
							<th class="col-1">{{ __('Customer') }}</th>
							<th class="col-4">{{ __('Amount') }}</th>
							<th class="col-1">{{ __('Type') }}</th>
							<th class="col-1">{{ __('Status') }}</th>
							<th class="col-1 text-left">{{ __('Date') }}</th>
						</tr>
					</thead>
					@if(count($transactions) != 0)
					<tbody class="list">
						@foreach($transactions ?? [] as $trx)
						<tr>
							<td class="">
									{{ $trx->user->name ?? "name" }}
							</td>

							<td class="">
								{{ number_format($trx->amount, 2) }}
							</td>

							@if($trx->type == "1")
							<td><span class="badge rounded-pill bg-danger text-white ">Debit</span></td>
							@elseif($trx->type == "2")
							<td><span class="badge rounded-pill bg-success text-white">Credit</span></td>
							@else
							<td><span class="badge rounded-pill bg-warning">Pending</span></td>
							@endif

							@if($trx->status == "2")
							<td><span class="badge rounded-pill bg-danger text-white ">Decline</span></td>
							@elseif($trx->status == "1")
							<td><span class="badge rounded-pill bg-success text-white">Successful</span></td>
							@else
							<td><span class="badge rounded-pill bg-warning text-white">Pending</span></td>
							@endif


							
							
							<td class="">
								{{ $trx->created_at->format('d F y H i s') }}
							</td>
						</tr>
						@endforeach
					</tbody>
					@endif
				</table>
				@if(count($transactions) == 0)
				<div class="text-center mt-2">
					<div class="alert  bg-gradient-primary text-white">
						<span class="text-left">{{ __('No Transaction found') }}</span>
					</div>
				</div>
				@endif
			</div>
			<div class="card-footer py-4">
				{{ $transactions->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
			</div>	
		</div>
	</div>
</div>

<input type="hidden" id="static-data" value="{{ route('admin.dashboard.static') }}">
<input type="hidden" id="base_url" value="{{ url('/') }}">
@endsection
@push('js')
<script src="{{ asset('assets/vendor/chart.js/dist/chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/canvas-confetti/confetti.browser.min.js') }}"></script>
@endpush
@push('bottomjs')
<script src="{{ asset('assets/js/pages/admin/dashboard.js') }}"></script>
@endpush