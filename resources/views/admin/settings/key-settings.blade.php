@extends('layouts.backend')

@section('css_before')

@endsection

@section('js_after')
    
@endsection

@section('content')
    <div class="content">
    <h2 class="content-heading">Stripe & PayPal Keys</h2>
       <div class="block">
           @if(Session::has('message'))
               <div class="alert alert-{{session('message')['type']}}">
                   {{session('message')['text']}}
               </div>
           @endif
            @if (count($errors) > 0)
                <div class = "alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           <div class="block-header block-header-default">
               <h3 class="block-title">Update Stripe Keys</h3>
           </div>
           <div class="block-content">
             <form id="validation-form" action="{{ route('update-settings',$setting->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="form-group row">
                     <div class="col-md-6">
                          <label for="text">Stripe Published Key</label>
                          <input type="text" class="form-control" id="stripe_key" name="stripe_key" value="{{ $setting->stripe_key }}" required>
                     </div>
                     <div class="col-md-6">
                        <label>Stripe Secret Key</label>
                        <input class="form-control" id="stripe_secret_key" name="stripe_secret_key" value="{{ $setting->stripe_secret_key }}" required>
                    </div>
                 </div>
                 <div class="form-group row">
                      <div class="col-md-9">
                        <button type="reset" class="btn btn-alt-danger">Cancel</button></a>
                        <button type="submit" class="btn btn-alt-primary">Update</button>
                      </div>
                  </div>
              </form>
           </div>
           <div class="block-header block-header-default">
               <h3 class="block-title">Update Paypal Keys</h3>
           </div>
           <div class="block-content">
             <form id="validation-form" action="{{ route('update-settings',$setting->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="form-group row">
                     <div class="col-md-6">
                          <label for="text">Paypal Key</label>
                          <input type="text" class="form-control" id="paypal_key" name="paypal_key" value="{{ $setting->paypal_key }}" required>
                     </div>
                     <div class="col-md-6">
                        <label for="text">Paypal Environment</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="paypal_env" name="paypal_env" value="1" {{ $setting->paypal_env ? 'checked' : '' }}>
                            <label class="form-check-label" for="paypal_env">Production</label>
                        </div>
                    </div>
                 </div>
                 <div class="form-group row">
                      <div class="col-md-9">
                        <button type="reset" class="btn btn-alt-danger">Cancel</button></a>
                        <button type="submit" class="btn btn-alt-primary">Update</button>
                      </div>
                  </div>
              </form>
           </div>
       </div>
    </div>
    <div class="content">
    <h2 class="content-heading">SMTP Keys</h2>
       <div class="block">
           <div class="block-header block-header-default">
               <h3 class="block-title">Update SMTP Keys</h3>
           </div>
           <div class="block-content">
             <form id="validation-form" action="{{ route('update-settings',$setting->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="form-group row">
                     <div class="col-md-6">
                          <label for="text">SMTP Host</label>
                          <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="{{ $setting->smtp_host }}" required>
                     </div>
                     <div class="col-md-6">
                        <label>SMTP Port</label>
                        <input class="form-control" id="smtp_port" name="smtp_port" value="{{ $setting->smtp_port }}" required>
                    </div>
                     <div class="col-md-6">
                        <label>SMTP Username</label>
                        <input class="form-control" id="smtp_username" name="smtp_username" value="{{ $setting->smtp_username }}" required>
                    </div>
                     <div class="col-md-6">
                        <label>SMTP Password</label>
                        <input class="form-control" id="smtp_password" name="smtp_password" value="{{ $setting->smtp_password }}" required>
                    </div>
                 </div>
                 <div class="form-group row">
                      <div class="col-md-9">
                        <button type="reset" class="btn btn-alt-danger">Cancel</button></a>
                        <button type="submit" class="btn btn-alt-primary">Update</button>
                      </div>
                  </div>
              </form>
           </div>
       </div>
    </div>
@endsection