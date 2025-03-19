@extends('auth.volunteer.layouts.app')

@section('main-section')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <div class="container-fluid">
        <div class="bg-light rounded p-4 shadow-lg">
            <div class="row">
                <h2 class="text-center text-primary mb-4">Student Registration</h2>
                <form action="{{ route('volunteer.store-student-registration') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="first_name" class="form-label">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="last_name" class="form-label">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="last_name" id="last_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <span class="text-danger" id="email-error"></span>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="phone_number" class="form-label">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                                </div>
                                <span class="text-danger" id="phone_number-error"></span>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="gender" class="form-label">Select Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                        </div>

                        <!-- State -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="state" class="form-label">State</label>
                                <input type="text" name="state" id="state" class="form-control">
                            </div>
                        </div>

                        <!-- Zip Code -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control">
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" id="country" class="form-control">
                            </div>
                        </div>

                        <!-- Emergency Contact Number -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="emergency_contact_number" class="form-label">Emergency Contact</label>
                                <input type="text" name="emergency_contact_number" id="emergency_contact_number"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- Emergency Contact Email -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="emergency_contact_email" class="form-label">Emergency Contact Email</label>
                                <input type="text" name="emergency_contact_email" id="emergency_contact_email"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- Occupation -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" name="occupation" id="occupation" class="form-control">
                            </div>
                        </div>

                        <!-- Annual Income -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="annual_income" class="form-label">Annual Income</label>
                                <input type="text" name="annual_income" id="annual_income" class="form-control">
                            </div>
                        </div>

                        <!-- Profile Picture Upload -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="profile_image" class="form-label">Upload Profile Picture</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                            </div>
                        </div>

                        <!-- Course -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="course" class="form-label">Course</label>
                                <select name="course[]" id="course" class="form-control" multiple>
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Membership -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="membership" class="form-label">Membership</label>
                                <select name="membership[]" id="membership" class="form-control" multiple>
                                    <option value="">Select Membership</option>
                                    @foreach ($memberships as $membership)
                                        <option value="{{ $membership->membership_id }}">{{ $membership->membership_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg px-5">Register Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $("document").ready(function() {
            // Your chart code here...
            $('#email').on('change', function(event) {
                event.preventDefault();
                var email = $('#email').val(); // Fixed the selector here
                $.ajax({
                    url: "{{ route('check-email-availability') }}",
                    method: "POST",
                    data: {
                        email: email
                    }, // No need for redundant 'data: email'
                    success: function(response) {
                        if (response.status) {
                            $('#email-error').text(response.message);
                        } else {
                            $('#email-error').text('');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
            // Your chart code here...
            $('#phone_number').on('change', function(event) {
                event.preventDefault();
                var phone_number = $('#phone_number').val(); // Fixed the selector here
                $.ajax({
                    url: "{{ route('check-phone_number-availability') }}",
                    method: "POST",
                    data: {
                        phone_number: phone_number
                    }, // No need for redundant 'data: email'
                    success: function(response) {
                        if (response.status) {
                            $('#phone_number-error').text(response.message);
                        } else {
                            $('#phone_number-error').text('');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
