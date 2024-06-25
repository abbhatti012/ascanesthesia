@extends('layouts.backend')

@section('css_before')

@endsection

@section('js_after')
    
@endsection

@section('content')
    <div class="content">
    <h2 class="content-heading">Edit Doctor</h2>
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
               <h3 class="block-title">Edit Doctor</h3>
           </div>
           <div class="block-content">
             <form id="validation-form" action="{{ route('update-doctor',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="form-group row">
                     <div class="col-md-6">
                          <label for="text">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                     </div>
                     <div class="col-md-6">
                            <label for="text">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="{{ $user->designation }}" required>
                     </div>
                     <div class="col-md-6">
                           <label>Biography</label>
                          <textarea class="form-control" id="biography" name="biography" required>{{ $user->designation }}</textarea>
                      </div>
                      <div class="col-md-6">
                          <label for="image">Image</label>
                         <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                     </div>
                     <br><br><br><br>
                     <div class="form-group col-md-6">
                        <label for="image">Preview Image</label>
                     </div>
                     <div class="form-group col-md-6">
                        <a href="{{ asset($user->image) }}" target="_blank"><img width="200" src="{{ asset($user->image) }}" alt=""></a>
                     </div>
                 </div>
                 <div class="form-group row">
                      <div class="col-md-9">
                        <button type="reset" class="btn btn-alt-danger">Cancel</button></a>
                        <button type="submit" class="btn btn-alt-primary">Save</button>
                      </div>
                  </div>
              </form>
           </div>
       </div>
    </div>
@endsection