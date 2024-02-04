@extends('admin.layouts.app')
@section('style')
    
@endsection
@section('content')

<div class="content-wrapper">  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Print Shop</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Print Shop</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            @if(!empty($getRecordUser))
            
            @endif
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $getRecordUser->count()}}</h3>

                <p>Admin Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('admin/admin/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $getRecordProduct->count()}}</h3>

                <p>Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list-outline"></i>
              </div>
              <a href="{{url('admin/product/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $getCategory->count()}}</h3>

                <p>Category</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list-outline"></i>
              </div>
              <a href="{{url('admin/category/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $getSubCategory->count()}}</h3>

                <p>SubCategory</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list-outline"></i>
              </div>
              <a href="{{url('admin/subcategory/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $getBrand->count()}}</h3>

                <p>Brand</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list-outline"></i>
              </div>
              <a href="{{url('admin/brand/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $getColor->count()}}</h3>

                <p>Color</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list-outline"></i>
              </div>
              <a href="{{url('admin/color/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

@endsection

@section('script')
<script src="{{ url('public/assets/dist/js/pages/dashboard3.js')}}"></script>
   
@endsection