@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">{{ __('聯繫我們') }}</div>
  <div class="card-body">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">您的Email</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">問題主旨</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="主旨">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">問題內容</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
  </div>
  </div>
</div>

@endsection
