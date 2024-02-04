@extends('admin.layouts.app')
@section('style')
<link rel="stylesheet" href="{{ url('public/assets/plugins/summernote/summernote-bs4.min.css') }}">

@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit product</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  @include('admin.layouts._message')
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Data</h3>
                      </div>
                      <form action="" method="post" enctype="multipart/form-data">
                        {{ @csrf_field() }}
                        <div class="card-body">

                          <div class="row">

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Title <span style="color:red">*</span></label>
                                <input type="text" 
                                    class="form-control" 
                                    required value="{{ old('title', $product->title)}}" 
                                    placeholder="Title" 
                                    name="title">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>SKU <span style="color:red">*</span></label>
                                <input type="text" 
                                    class="form-control" 
                                    required value="{{ old('sku', $product->sku)}}" 
                                    placeholder="SKU" 
                                    name="sku">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Category <span style="color:red">*</span></label>
                                <select name="category_id" id="ChangeCategory" class="form-control" required>
                                  <option value="">Select</option>
                                  @foreach($getCategory as $category)
                                    <option {{ ($product->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Sub Category <span style="color:red">*</span></label>
                                <select name="sub_category_id" id="getSubCategory" class="form-control" required>
                                  <option value="">Select</option>
                                  @foreach($getSubCategory as $subcategory)
                                    <option {{ ($product->sub_category_id == $subcategory->id) ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                  @endforeach
                                  
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Brand<span style="color:red">*</span></label>
                                <select name="brand_id" class="form-control">
                                  <option value="">Select</option>
                                  @foreach($getBrand as $brand)
                                    <option {{ ($product->brand_id == $brand->id) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Color<span style="color:red">*</span></label>
                                @foreach($getColor as $color)
                                    @php
                                      $checked = '';    
                                    @endphp
                                    @foreach($product->getColor as $pcolor)
                                      @if($pcolor->color_id == $color->id)
                                        @php
                                          $checked = 'checked';
                                        @endphp
                                      @endif
                                    @endforeach
                                  <div>
                                    <label for="">
                                      <input {{ $checked }} type="checkbox" name="color_id[]" value="{{ $color->id }}"> {{ $color->name }}
                                    </label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>

                          


                          <hr>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Price ($)<span style="color:red">*</span></label>
                                <input type="text" 
                                    class="form-control"
                                    required
                                    value="{{ !empty($product->price) ? $product->price : ''  }}" 
                                    placeholder="Price" 
                                    name="price">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Old Price ($)<span style="color:red">*</span></label>
                                <input type="text" 
                                    class="form-control"
                                    required
                                    value="{{ !empty($product->old_price) ? $product->old_price : ''  }}" 
                                    placeholder="old price" 
                                    name="old_price">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Size<span style="color:red">*</span></label>
                                <div>
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Name</th>
                                        <th>Price ($)</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="AppendSize">
                                      @php
                                        $i_s = 1;   
                                      @endphp
                                      @foreach ($product->getSize as $size)
                                        <tr id="DeleteSize{{ $i_s }}">
                                          <td>
                                            <input type="text" value="{{ $size->name }}" name="size[{{ $i_s }}][name]" placeholder="Name"  class="form-control">
                                          </td>
                                          <td>
                                            <input type="text" value="{{ $size->price }}" name="size[{{ $i_s }}][price]" placeholder="Price" class="form-control">
                                          </td>
                                          <td style="width: 100px;">
                                            <button type="button" id="{{ $i_s }}" name="" class="btn btn-danger btn-sm DeleteSize">Delete</button>
                                          </td>
                                        </tr>
                                        @php
                                          $i_s++;   
                                        @endphp
                                      @endforeach
                                        <tr>
                                          <td>
                                            <input type="text" name="size[100][name]" placeholder="Name"  class="form-control">
                                          </td>
                                          <td>
                                            <input type="text" name="size[100][price]" placeholder="Price" class="form-control">
                                          </td>
                                          <td style="width: 100px;">
                                            <button type="button" id="" name="" class="btn btn-primary btn-sm AddSize">Add</button>
                                          </td>
                                        </tr>
                                    </tbody>
                                  </table>
                              </div>
                            </div>
                          </div>
                        </div>

                        <hr>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Image <span style="color:red"></span></label>
                              <input type="file" 
                                    name="image[]" 
                                    class="form-control" 
                                    multiple 
                                    style="padding: 5px;"
                                    accept="image/*">
                            </div>
                          </div>
                        </div>
                        @if (!empty($product->getImage->count()))
                            <div class="row" id="sortable">
                             @foreach($product->getImage as $image)
                             @if(!empty($image->getImageUrl()))
                              <div class="col-md-4 text-center sortable_image" id="{{ $image->id }}">
                                <img src="{{ $image->getImageUrl()}}" style="height:200px;width:100%;"alt="">
                                <a href="{{ url('admin/product/image_delete/'.$image->id)}}" 
                                  class="btn btn-danger mt-1"
                                  onclick="return confirm('Are you sure you want to delete the image?');">Delete</a>
                              </div>
                              @endif
                              @endforeach
                            </div>
                        @endif
                        <hr>



                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Short description <span style="color:red">*</span></label>
                                <textarea name="short_description" class="form-control" placeholder="Short Description">{{ $product->short_description }}</textarea>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Description <span style="color:red">*</span></label>
                                <textarea name="description" class="form-control editor" placeholder="Description">{{ $product->description }}</textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Additional Information<span style="color:red">*</span></label>
                                <textarea name="additional_information" class="form-control editor" placeholder="Additional Information">{{ $product->additional_information }}</textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Shipping and Return<span style="color:red">*</span></label>
                                <textarea name="shipping_returns" class="form-control editor" placeholder="Shipping and returns">{{ $product->shipping_returns }}</textarea>
                              </div>
                            </div>
                          </div>

                          <hr />

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label >Status <span style="color:red">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ ( $product->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                    <option {{ ( $product->status == 1) ? 'selected' : '' }} value="1">inactive</option>
                                </select>
                              </div>
                            </div>
                          </div>


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
  
<script src="https://cdn.tiny.cloud/1/k3u42da20lqu6qu1gf4yq0s95mv5mk1u81zu5nelqibb4t91/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('public/sortable/jquery-ui.js')}}"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
      $( "#sortable" ).sortable({
        update : function(event, ui) {
          var photo_id = new Array;
          $('.sortable_image').each(function () {
            var id = $(this).attr('id');
            photo_id.push(id)
          });
          
          $.ajax({
            type: "POST",
            url: "{{ url('admin/product_image_sortable') }}",
            data: {
              "photo_id" : photo_id,
              "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
              $('#getSub').html(data.html);
            },
            error: function (data) {

            }
          });

        }
      });
    });
    // $('.editor').summernote({
    //   height: 200
    // });
    tinymce.init({
    selector: '.editor',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });

    var i = 101;
    $('body').delegate('.AddSize', 'click', function() {
      var html = '<tr id="DeleteSize'+i+'" >\n\
                    <td>\n\
                      <input type="text" name="size['+i+'][name]" placeholder="Name"  class="form-control">\n\
                    </td>\n\
                    <td>\n\
                      <input type="text" name="size['+i+'][price]" placeholder="Price" class="form-control">\n\
                    </td>\n\
                    <td>\n\
                      <button type="button" id="'+i+'" name="" class="btn btn-danger btn-sm DeleteSize">Delete</button>\n\
                    </td>\n\
                </tr>';
      i++;
      $('#AppendSize').append(html);
    });

    $('body').delegate('.DeleteSize', 'click', function() {
      var id = $(this).attr('id');
      $('#DeleteSize'+id).remove();
    });

    $('body').delegate('#ChangeCategory', 'change', function(e) {
      var id = $(this).val();

      $.ajax({
        type: "POST",
        url: "{{ url('admin/get_sub_category') }}",
        data : {
          "id" : id,
          "_token": "{{ csrf_token() }}",
        },
        dataType: "json",
        success: function(data) {
          $('#getSubCategory').html(data.html);
        },
        error: function(data) {

        }
      });
    });
  </script>
@endsection
