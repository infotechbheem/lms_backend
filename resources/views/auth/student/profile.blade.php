@extends('auth.student.layouts.app')

@section('main-section')
<div class="content-wrapper">

    <div class="row">
        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body">
                    <div class="row align-items-center h-100">
                        <div class="col-md-4">
                            <figure class="avatar mx-auto mb-4 mb-md-0">
                                <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="avatar">
                            </figure>
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-white text-center text-md-left">{{ $student->first_name . ' ' . $student->last_name }}</h3>
                            <p class="text-white text-center text-md-left">{{ $student->email }}</p>
                            <div class="d-flex align-items-center justify-content-between info pt-2">
                                <div>
                                    <p class="text-white fw-bold">Date of Birth</p>
                                    <p class="text-white fw-bold">Gender</p>
                                </div>
                                <div>
                                    <p class="text-white">{{ $student->date_of_birth ?? "Not Available"  }}</p>
                                    <p class="text-white">{{ $student->gender ?? "Not Available" }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body">
                    <div class="row align-items-center h-100">
                        <div class="col">
                            <h4 class="text-white text-center text-md-left">Address</h4>
                            <p class="text-white text-center text-md-left">{{ $student->address ?? "Dummy address" }}</p>

                            <div class="d-flex align-items-center justify-content-between info pt-2">
                                <div>
                                    <p class="text-white fw-bold">City</p>
                                    <p class="text-white fw-bold">State</p>
                                </div>
                                <div>
                                    <p class="text-white">{{ $student->city ?? "Not Available"  }}</p>
                                    <p class="text-white">{{ $student->state ?? "Not Available" }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body">
                    <div class="row align-items-center h-100">
                        <div class="col">
                            <h4 class="text-white text-center text-md-left">Emergency Contact Number</h4>
                            <p class="text-white text-center text-md-left">{{ $student->emergency_contact_phone ?? "Not Available" }}</p>

                            <div class="d-flex align-items-center justify-content-between info pt-2">
                                <div>
                                    <p class="text-white fw-bold">Zip Code</p>
                                    <p class="text-white fw-bold">Country</p>
                                </div>
                                <div>
                                    <p class="text-white">{{ $student->zip_code ?? "Not Available"  }}</p>
                                    <p class="text-white">{{ $student->country ?? "Not Available" }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card profile-card bg-gradient-primary">
                <div class="card-body">
                    <div class="row align-items-center h-100">
                        <div class="col">
                            <h4 class="text-white text-center text-md-left">Emergency Email Id</h4>
                            <p class="text-white text-center text-md-left">{{ $student->emergency_contact_email ?? "Not Available" }}</p>

                            <div class="d-flex align-items-center justify-content-between info pt-2">
                                <div>
                                    <p class="text-white fw-bold">Occupation</p>
                                    <p class="text-white fw-bold">Annual Income</p>
                                </div>
                                <div>
                                    <p class="text-white">{{ $student->occupation ?? "Not Available"  }}</p>
                                    <p class="text-white">{{ $student->annual_income ?? "Not Available" }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card newsletter-card bg-gradient-info">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                        <h2 class="mb-3 text-white">Student Id</h2>
                        <h5>{{ auth()->user()->username }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card newsletter-card bg-gradient-warning">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                        <h5 class="mb-3 text-white">Newsletter</h5>
                        <form action="{{ route('student.subscribe-newslatters') }}" class="form d-flex flex-column align-items-center justify-content-between w-100" method="post">
                            @csrf
                            <div class="form-group mb-2 w-100">
                                <input type="text" class="form-control" name="email" placeholder="email address">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-danger btn-rounded mt-1" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Your Details</h4>
                <form class="forms-sample" action="{{ route('student.update-profile-details') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ $student->first_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $student->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="{{ $student->date_of_birth }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ $student->gender == "male" ? "selected" : "" }}>Male</option>
                                        <option value="female" {{ $student->gender == "female" ? "selected" : "" }}>Female</option>
                                        <option value="other" {{ $student->gender == "ther" ? "selected" : "" }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <input type="text" name="country" id="country" class="form-control" placeholder="Country" value="{{ $student->country }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="occupation" class="col-sm-3 col-form-label">Occupation</label>
                                <div class="col-sm-9">
                                    <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" value="{{ $student->occupation }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="annual_income" class="col-sm-3 col-form-label">Annual Income</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="annual_income" id="annual_income" placeholder="Annual Income" {{ $student->annual_income }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_picture" class="col-sm-3 col-form-label">Profile Picture</label>
                                <div class="col-sm-9">
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $student->last_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Mobile Number" value="{{ $student->phone_number }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $student->city }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ $student->state }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zip_code" class="col-sm-3 col-form-label">Zip Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" value="{{ $student->zip_code }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emergency_contact_number" class="col-sm-3 col-form-label">Emergency Contact Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="emergency_contact_number" id="emergency_contact_number" placeholder="Emergency Contact Number" value="{{ $student->emergency_contact_phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emergency_contact_email" class="col-sm-3 col-form-label">Emergency Contact Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="emergency_contact_email" id="emergency_contact_email" placeholder="Emergency Contact Number" value="{{ $student->emergency_contact_email }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" id="address" class="form-control" placeholder="Address">{{ $student->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
