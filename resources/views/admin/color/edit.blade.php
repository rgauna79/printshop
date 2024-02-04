@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit color</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Data</h3>
                      </div>
                      <form action="" method="post">
                        {{ @csrf_field() }}
                        <div class="card-body">
                          <div class="form-group">
                            <label>Color Name <span style="color:red">*</span></label>
                            <input type="text" 
                                class="form-control" 
                                required value="{{ old('name', $getRecord->name)}}" 
                                placeholder="Category name" 
                                name="name">
                          </div>
                          <div class="form-group">
                            <label>Code <span style="color:red">*</span></label>
                            <input type="color" 
                                class="form-control" 
                                required value="{{ old('code', $getRecord->code)}}" 
                                placeholder="color code" 
                                name="code">
                            <div style="color:red">{{ $errors->first('code') }}</div>
                          </div>
                          <div class="form-group">
                            <label >Status <span style="color:red">*</span></label>
                            <select class="form-control" name="status" required>
                                <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">inactive</option>
                            </select>
                          </div>

                          <hr>
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@endsection
