@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit discount code</h1>
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
                            <label>Discount Code Name <span style="color:red">*</span></label>
                            <input type="text" 
                                class="form-control" 
                                required value="{{ old('name', $getRecord->name)}}" 
                                placeholder="Category name" 
                                name="name">
                          </div>
                          <div class="form-group">
                            <label >Type <span style="color:red">*</span></label>
                            <select class="form-control" name="type" required>
                                <option {{ (old('status', $getRecord->type) == 'Amount') ? 'selected' : '' }} value="Amount">Amount</option>
                                <option {{ (old('status', $getRecord->type) == 'Percent') ? 'selected' : '' }} value="Percent">Percent</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Percent or Amount <span style="color:red">*</span></label>
                            <input type="text" 
                                class="form-control" 
                                required value="{{ old('percent_amount', $getRecord->percent_amount)}}" 
                                placeholder="discount code type" 
                                name="percent_amount">
                          </div>

                          <div class="form-group">
                            <label>Expire Date <span style="color:red">*</span></label>
                            <input type="date" 
                                class="form-control" 
                                required value="{{ old('expire_date', $getRecord->expire_date)}}" 
                                name="expire_date">
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
