@extends('layouts.backend')

@section('css_before')

@endsection

@section('js_after')
    
@endsection

@section('content')
    <div class="content">
    <h2 class="content-heading">Add Service</h2>
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
               <h3 class="block-title">Add Doctor</h3>
           </div>
           <div class="block-content">
             <form id="validation-form" action="{{ route('update-service',$service->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="form-group row">
                     <div class="col-md-6">
                          <label for="text">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{ $service->title }}" required>
                     </div>
                     <div class="col-md-6">
                        <label>Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $service->description }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="link" value="{{ $service->link }}" required>
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