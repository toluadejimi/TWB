@extends('layouts.main.app')
@section('head')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}"/>
@endpush
@include('layouts.main.headersection',[
'title'=> __('Create Plan'),
'buttons'=>[
	[
		'name'=>__('Back'),
		'url'=>route('admin.plan.index'),
	]
]
])
@endsection
@section('content')


<div class="col-lg-6 mt-5">
    <strong>{{ __('ITEM LOG') }}</strong>
    <p>{{ __('Upload Logs') }}</p>
</div>


<div class="row ">
	<div class="col-lg-6 mt-5">
       
        <form method="POST" class="ajaxform_instant_reload" action="{{ route('admin.gv.store') }}">
        	@csrf
        	<div class="card">
            <div class="card-body">
                <div class="from-group row mt-2">
                    <label class="col-lg-12">{{ __('Upload Log') }}</label>
                    <div class="col-lg-12">
                        <input type="file" name="file_upload" required="" class="form-control">
                    </div>
                </div>
            

                 <div class="from-group row mt-3">
                    <div class="col-lg-12">
                       <button type="submit" class="btn btn-neutral submit-button btn-sm float-left"> {{ __('Upload') }}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- <div class="col-lg-6 mt-5">
        <form class="ajaxform_instant_reload" action="{{ route('admin.tn.store') }}">
        	@csrf
        	<div class="card">
            <div class="card-body">
                <div class="from-group row mt-2">
                    <label class="col-lg-12">{{ __('Text Now Log') }}</label>
                    <div class="col-lg-12">
                        <input type="file" name="file_upload" required="" class="form-control">
                    </div>
                </div>
            

                 <div class="from-group row mt-3">
                    <div class="col-lg-12">
                       <button type="submit" class="btn btn-neutral submit-button btn-sm float-left"> {{ __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div class="col-lg-6 mt-5">
        <form class="ajaxform_instant_reload" action="{{ route('admin.nf.store') }}">
        	@csrf
        	<div class="card">
            <div class="card-body">
                <div class="from-group row mt-2">
                    <label class="col-lg-12">{{ __('Netflix Log') }}</label>
                    <div class="col-lg-12">
                        <input type="file" name="file" required="" class="form-control">
                    </div>
                </div>
            

                 <div class="from-group row mt-3">
                    <div class="col-lg-12">
                       <button class="btn btn-neutral submit-button btn-sm float-left"> {{ __('Upload') }}</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div> --}}




</div>
@endsection
@push('js')
<script  src="{{ asset('assets/plugins/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js') }}"></script>
<script  src="{{ asset('assets/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/admin/plan-create.js') }}"></script>
@endpush