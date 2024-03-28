<p>The following addresses will be used on the checkout page by default.</p>

<div class="row">
    <div class="col-lg-6">
        <div class="card card-dashboard">
            <div class="card-body">
                <h3 class="card-title">Billing Address</h3>
                @include('admin.layouts._message')
                <form action="{{ url('my-account/update_address') }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="phone">Phone <span style="color:red">*</span></label>
                        <input value="{{ old('phone', $getUserInfo->phone) }}" id="phone" type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input value="{{ old('company_name', $getUserInfo->company_name) }}" id="company_name" type="text" name="company_name" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="address_1">Address line 1 <span style="color:red">*</span></label>
                        <input value="{{ old('address_1', $getUserInfo->address_1) }}" id="address_1" type="text" name="address_1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address_2">Address line 2</label>
                        <input value="{{ old('address_2', $getUserInfo->address_2) }}" id="address_2" type="text" name="address_2" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="city">City <span style="color:red">*</span></label>
                        <input value="{{ old('city', $getUserInfo->city) }}" id="city" type="text" name="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State <span style="color:red">*</span></label>
                        <input value="{{ old('state', $getUserInfo->state) }}" id="state" type="text" name="state" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Zip Code <span style="color:red">*</span></label>
                        <input value="{{ old('zip_code', $getUserInfo->zip_code) }}" id="zip_code" type="text" name="zip_code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country <span style="color:red">*</span></label>
                        <input value="{{ old('country', $getUserInfo->country) }}" id="country" type="text" name="country" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea value="{{ old('notes', $getUserInfo->notes) }}" id="notes" type="text" name="notes" class="form-control" >
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                {{-- <a href="#">Edit <i class="icon-edit"></i></a></p> --}}
                
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-dashboard">
            <div class="card-body">
                <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                <p>You have not set up this type of address yet.<br>
                <a href="#">Edit <i class="icon-edit"></i></a></p>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: "{{ url('my-account/address') }}",
            success: function(data) {
                $('#tab-address').tab('show');
                // clean success message and hide it after 3 seconds
                setTimeout(function() {
                    $('.alert-success').remove();
                }, 3000);

            },
            error: function(data) {
                $('#tab-address').tab('show');
            }
        });
    });
</script>
@endSection