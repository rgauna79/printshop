@include('admin.layouts._message')
<form action="{{ url('my-account/update_profile') }}" method="POST">
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

<script>
    $(document).ready(function() {
        var message = "{{ session('success_update_profile') }}" || "{{ session('error_password') }}"

        if (message) {
            $('#tab-dashboard').removeClass('active');
            $('#tab-account').tab('show');
            //clean success message and hide it after 3 seconds
            setTimeout(function() {
                $('.alert-success').remove();
            }, 3000);
        }

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
            } else {
                $('#password_box').hide();
                // clean content of current password and new password
                $('#current_password').val('');
                $('#new_password').val('');
                $('#confirm_password').val('');
                $('#message').html('');
            }
        });
    });
</script>
