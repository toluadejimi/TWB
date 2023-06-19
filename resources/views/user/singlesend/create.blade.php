@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=>__('View Logs')])
@endsection
@push('topcss')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')




<div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">{{ __('Latest Transactions') }}</h3>
          <form action="" class="card-header-form">
            <div class="input-group">
              <input type="text" name="search" value="{{ $request->search ?? '' }}" class="form-control"
                placeholder="Search......">
              <select class="form-control" name="type">
                {{-- <option value="email" @if($type=='email' ) selected="" @endif>{{ __('User Email') }}</option>
                <option value="invoice_no" @if($type=='invoice_no' ) selected="" @endif>{{ __('Invoice No') }}</option>
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
            @if(count($solds) != 0)
            <tbody class="list">
              @foreach($solds ?? [] as $trx)
              <tr>
                <td class="">
                  {{ $trx->user->name ?? Auth::user()->name }}
                </td>
  
                <td class="">
                  {{ number_format($trx->amount, 2) }}
                </td>
  
                @if($trx->status == "1")
                <td><span class="badge rounded-pill bg-danger text-white ">Pending</span></td>
                @elseif($trx->status == "0")
                <td><span class="badge rounded-pill bg-success text-white">Sold</span></td>
                @else
                <td><span class="badge rounded-pill bg-warning">Declned</span></td>
                @endif
  

  
                <td class="">
                  {{ $solds->created_at->format('d F y') }}
                </td>
              </tr>
              @endforeach
            </tbody>
            @endif
          </table>
          @if(count($solds) == 0)
          <div class="text-center mt-2">
            <div class="alert  bg-gradient-primary text-white">
              <span class="text-left">{{ __('No Transaction found') }}</span>
            </div>
          </div>
          @endif
        </div>
        <div class="card-footer py-4">
          {{ $solds->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>









@endsection
@push('js')
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/bulk/template.js') }}"></script>

@endpush