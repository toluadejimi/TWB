@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',[
'title'=> __('Create admin'),
'buttons'=>[
    [
        'name'=>__('Back'),
        'url'=>route('admin.admin.index'),
    ]
]
])
@endsection
@section('content')
<div class="row">
	<div class="col-lg-5 mt-5">
        <strong>{{ __('Create Admin') }}</strong>
        <p>{{ __('add admin profile information') }}</p>
    </div>
    <div class="col-lg-7 mt-5">     
		<div class="card">
			<div class="card-body">
				@if(session()->has('success'))
				<span class='text-primary'>{{session()->get('success')}}</span>
				@endif
				@if(session()->has('error'))
				<span class='text-danger'>{{session()->get('error')}}</span>
				@endif
				<form method="post" action="{{ route('admin.credit') }}" class="ajaxform_instant_reloa">
					@csrf
					<div class="pt-20">
					
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" placeholder="Enter Email" name="email" class="form-control" id="email" value="" autocomplete="off">
							@error('email')
							
							<span class='text-danger'>{{$message}}</span>
							
							
							
							@enderror
						</div>
						<div class="form-group">
							<label for="amount">Amount</label>
							<input type="text" placeholder="Enter amount" name="amount" class="form-control" id=""  value="" autocomplete="off">
							@error('amount')
							
							<span class='text-danger'>{{$message}}</span>
							
							
							
							@enderror
						</div>
						
						<div class="form-group">
                            <label for="action">Action</label>
						<select class='form-control' name="action" id="">
                        <option value="credit">Credit</option>
                        <option value="credit">Debit</option>

                        </select>
							
						</div>

				
						
					</div>
				</div>
				<div class="card-footer">
					<div class="btn-publish">
							<button type="submit" class="btn btn-neutral submit-button"><i class="fa fa-save"></i> {{ __('update Wallet') }}</button>
						</div>
				</div>
			</div>

		</div>
		
	</form>
@endsection