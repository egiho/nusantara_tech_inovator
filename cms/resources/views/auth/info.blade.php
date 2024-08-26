@extends('layouts.auth', ['title' => 'User Info'])

@section('content')

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="img-logo text-center mt-5">
                <img src="{{ asset('assets/img/company.png') }}" style="width: 120px;">
            </div>
            <div class="card o-hidden border-0 shadow-lg mb-1 mt-3">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h1 class="h5 text-gray-900 mb-3">USER INFO</h1>
                    </div>
                    
                    <form id="user-info-form">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email" disabled>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Birthday</label>
                            <input type="date" id="birthday" name="birthday" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="" disabled>-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">UPDATE INFO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Load user info via AJAX when the page loads
    $.ajax({
        url: '{{ route('api.user.info') }}',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            $('#name').val(response.name);
            $('#email').val(response.email);
            $('#birthday').val(response.birthday);
            $('#gender').val(response.gender);
        }
    });

    // Handle form submission with AJAX
    $('#user-info-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('api.user.update') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                birthday: $('#birthday').val(),
                gender: $('#gender').val()
            },
            dataType: 'json',
            success: function (response) {
                alert('User info updated successfully!');
            },
            error: function (xhr, status, error) {
                alert('Failed to update user info. Please try again.');
            }
        });
    });
});
</script>

@endsection
