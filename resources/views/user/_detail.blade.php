<div class="alert alert-success" style="display:none"></div>
<form id="form_profile" action="" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6">
            <label for="first_name">First Name <span style="color:red">*</span></label>
            <input value="{{ old('first_name', !empty($getUser->first_name) ? $getUser->first_name : '') }}"
                id="first_name" name="first_name" type="text" class="form-control" required>
        </div><!-- End .col-sm-6 -->

        <div class="col-sm-6">
            <label for="last_name">Last Name <span style="color:red">*</span></label>
            <input value="{{ old('last_name', !empty($getUser->last_name) ? $getUser->last_name : '') }}" id="last_name"
                name="last_name" type="text" class="form-control" required>
        </div><!-- End .col-sm-6 -->
    </div><!-- End .row -->

    <label for="name">Display Name <span style="color:red">*</span></label>
    <input value="{{ old('name', !empty($getUser->name) ? $getUser->name : '') }}" id="name_display" name="name"
        type="text" class="form-control" required>
    <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

    <label for="email">Email address <span style="color:red">*</span></label>
    <input value="{{ old('email', !empty($getUser->email) ? $getUser->email : '') }}" id="email_address" name="email"
        type="email" class="form-control" required>

    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="change_password" name="change_password">
        <label class="custom-control-label" for="change_password">Change password?</label>
    </div>

    <div id="password_box">
        <div class="alert alert-danger" style="display:none"></div>
        <label for="current_password">Current password (leave blank to leave unchanged)</label>
        <input id="current_password" name="current_password" type="password" class="form-control">
        <label for="new_password">New password (leave blank to leave unchanged)</label>
        <input id="new_password" name="new_password" type="password" class="form-control">

        <label for="confirm_password">Confirm new password</label>
        <input id="confirm_password" name="confirm_password" type="password" class="form-control">
        <div id="message" class="mb-4"></div>
    </div>

    <button type="submit" class="btn btn-outline-primary-2">
        <span>SAVE CHANGES</span>
        <i class="icon-long-arrow-right"></i>
    </button>
</form>

<script type="text/javascript">
    
    $('body').delegate('#form_profile','submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{ url('my-account/update_profile') }}",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data.success === true) {
                    $('.alert-success').show();
                    $('.alert-success').html(data.message);
                    //clean success message and hide it after 3 seconds
                    setTimeout(function() {
                        $('.alert-success').hide();
                    }, 3000);
                    
                }
                else if (data.success === false) {
                    $('.alert-danger').show();
                    $('.alert-danger').html(data.message);
                    //clean success message and hide it after 3 seconds
                    setTimeout(function() {
                        $('.alert-danger').hide();
                    }, 3000);
            }
            },
            error: function(data) {
                
                
            }
        });
    });

    

    $(document).ready(function() {
        $('#password_box').hide();

        $('#confirm_password').on('keyup', function() {
            if ($('#new_password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });

        $('#change_password').on('change', function() {
            if ($(this).is(':checked')) {
                $('#password_box').show();
                // add required attribute to current password and new password
                $('#current_password').prop('required', true);
                $('#new_password').prop('required', true);
                $('#confirm_password').prop('required', true);
            } else {
                $('#password_box').hide();
                // clean content of current password and new password
                $('#current_password').val('');
                $('#new_password').val('');
                $('#confirm_password').val('');
                $('#message').html('');
                $('#current_password').prop('required', false);
                $('#new_password').prop('required', false);
                $('#confirm_password').prop('required', false);
            }
        });
    });
</script>