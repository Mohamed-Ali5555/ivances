
@extends('layouts.master')
@section('content')



<h4 class="editp">Edit your product</h4>
<div class="container">
    <div class="row">
        <div class="container1 col-md-6">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form enctype="multipart/form-data" method="post" action="{{route('sections.update')}}" >
        @csrf


        <input type="hidden" value="{{$edit->id}}" name="section_id">



        <div class="form-group">
            <label >description</label>
            <input value="{{$edit->description}}" type="text" class="form-control" name="description">
        </div>

        <div class="form-group">
            <label >section_name</label>
            <textarea  name="section_name" class="form-control" >{{$edit->section_name}}</textarea>
        </div>




        <input type="submit" class="btn btn-primary" value="save products">
    </form>

  
</div>
        
    </div>
</div>
@endsection
