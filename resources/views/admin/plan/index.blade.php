@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',[
'title'=> __('Plans'),
'buttons'=>[
	[
		'name'=>'<i class="fa fa-plus"></i>&nbsp'.__('Upload Logs'),
		'url'=>route('admin.plan.create'),
	]
]
])
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
									{{ $tGV }}
								</span>
							</div>
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="fi fi-rs-tickets-airline mt-2"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('Google Voice') }}</h5>
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
									{{ $tDGV }}
								</span>
							</div>
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="fi fi-rs-ticket-airline mt-2"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('Domain Gv') }}</h5>
						<p></p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<span class="h2 font-weight-bold mb-0 completed-transfers" id="total-inactive">
									{{ $tTN }}
								</span>
							</div>
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="fi fi-rs-time-forward mt-2"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('TextNow') }}</h5>
						<p></p>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card card-stats">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<span class="h2 font-weight-bold mb-0 completed-transfers" id="total-inactive">
									{{ $tTK }}
								</span>
							</div>
							
							<div class="col-auto">
								<div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
									<i class="fi fi-rs-time-forward mt-2"></i>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-sm">
						</p><h5 class="card-title  text-muted mb-0">{{ __('Talkatone') }}</h5>
						<p></p>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>    
<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header border-0">
				<h3 class="mb-0">{{ __('Available Logs') }}</h3>
				<form action="" class="card-header-form">
					<div class="input-group">
						<input type="text" name="search" value="{{ $request->search ?? '' }}" class="form-control" placeholder="Search......">
						<select class="form-control" name="type">
							{{-- <option value="Text Now" @if($type == 'email') selected="" @endif>{{ __('User Email') }}</option>
							<option value="ticket_no" @if($type == 'ticket_no') selected="" @endif>{{ __('Ticket No') }}</option>
							<option value="subject" @if($type == 'subject') selected="" @endif>{{ __('Subject') }}</option> --}}
						</select>
						<div class="input-group-btn">
							<button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
			<!-- Light table -->
			<div class="table-responsive">
				<table class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
							<th class="col-1">{{ __('Log Data') }}</th>
							<th class="col-6">{{ __('Area Code') }}</th>
							<th class="col-1 text-left">{{ __(' Date Created') }}</th>
						</tr>
					</thead>
					@if(count($item_logs) != 0)
					<tbody class="list">
						@foreach($item_logs ?? [] as $data)
						<tr>
							<td class="text-left">
								{{ $data->data }}
							</td>
						
							<td class="text-left">
								{{ $data->area_code }}
							</td>

							
							
						
							<td class="text-left">
								{{ $data->created_at->format('d F y H i s') }}
							</td>
							
						</tr>
						@endforeach
					</tbody>
					@endif
				</table>
				@if(count($item_logs) == 0)
				<div class="text-center mt-2">
					<div class="alert  bg-gradient-primary text-white">
						<span class="text-left">{{ __('!Opps no support query found') }}</span>
					</div>
				</div>
				@endif
			</div>
			<div class="card-footer py-4">
				{{ $item_logs->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
			</div>	
		</div>
	</div>
</div>









{{-- <div class="row">
	@foreach($plans as $plan)
	<div class="col-md-6 col-lg-3 text-center">
		<div class="card">
			<div class="card-body">
				<h2 class="pricing-green">{{ $plan->title }}</h2>
				<h1>{{ amount_format($plan->price) }}</h1>
				{{ $plan->days == 30 ? 'Per month' : 'Per year' }}
				<br>
				<span href="#!" class="text-muted">{{ __('Active Users') }} ({{ $plan->activeuser_count }})</span>
				<hr>
				@foreach($plan->data ?? [] as $key => $data)
				<div class="mt-2 text-left">
					@if(planData($key,$data)['is_bool'] == true)
					@if(planData($key,$data)['value'] == true)
					<i class="{{ planData($key,$data)['value'] == true ? 'far text-success fa-check-circle' : 'fas text-danger fa-times-circle' }}"></i> 
					@else
					<i class="fas text-danger fa-times-circle"></i> 
					@endif

					@else
					<i class="far text-success fa-check-circle"></i> 
					@endif      
					{{ str_replace('_',' ',planData($key,$data)['title']) }}
				</div>
				@endforeach
				<hr>
				<div class="mt-2">
					<div class="text-center">
						<a class="btn btn-sm  btn-neutral text-left" href="{{ route('admin.plan.edit',$plan->id) }}"  data-icon="fa fa-plus-circle">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</a>
						
						<a class="btn btn-sm btn-primary text-left delete-confirm" href="#" data-action="{{ route('admin.plan.destroy',$plan->id) }}" data-icon="fa fa-plus-circle">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</div>

					
				</div>
			</div>
		</div>
	</div>
	@endforeach

	@if(count($plans) == 0)
		<div class="alert  bg-gradient-primary text-white col-sm-12"><span class="text-left">{{ __('Opps you have not created any plan....') }}</span></div>
	@endif
</div> --}}
@endsection