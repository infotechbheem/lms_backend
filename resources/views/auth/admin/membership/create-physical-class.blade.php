@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Membership / Lavel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Courses - Classes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.store-physical-class') }}" id="offlineClassForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Course Title</label>
                                    <input type="text" class="form-control" name="course_title" id="course_title">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Class Title</label>
                                    <input type="text" class="form-control" name="class_title" id="class_title">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Select Class Type</label>
                                    <select name="class_type" id="class_type" class="form-control">
                                        <option value="">---------Select--------</option>
                                        <option value="recurring">Recurring</option>
                                        <option value="onetime">OneTime</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="date">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control" name="end_date" id="date">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Time</label>
                                    <input type="time" class="form-control" name="time" id="time">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Venue</label>
                                    <input type="text" class="form-control" name="venue" id="venue">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Upload Cover Image</label>
                                    <input type="file" class="form-control" name="cover_image" id="cover_image">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Coordinator</label>
                                    <input type="text" class="form-control" name="coordinator" id="coordinator">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Select Fee Type</label>
                                    <select name="fee_type" id="fee_type" class="form-control">
                                        <option value="">---------Select--------</option>
                                        <option value="paid">Paid</option>
                                        <option value="free">Free</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Select Currency</label>
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="">---- Select Currency ----</option>
                                        <option value="USD">USD - United States Dollar</option>
                                        <option value="EUR">EUR - Euro</option>
                                        <option value="GBP">GBP - British Pound Sterling</option>
                                        <option value="AUD">AUD - Australian Dollar</option>
                                        <option value="CAD">CAD - Canadian Dollar</option>
                                        <option value="JPY">JPY - Japanese Yen</option>
                                        <option value="CHF">CHF - Swiss Franc</option>
                                        <option value="CNY">CNY - Chinese Yuan</option>
                                        <option value="INR">INR - Indian Rupee</option>
                                        <option value="MXN">MXN - Mexican Peso</option>
                                        <option value="BRL">BRL - Brazilian Real</option>
                                        <option value="ZAR">ZAR - South African Rand</option>
                                        <option value="RUB">RUB - Russian Ruble</option>
                                        <option value="SGD">SGD - Singapore Dollar</option>
                                        <option value="HKD">HKD - Hong Kong Dollar</option>
                                        <option value="NZD">NZD - New Zealand Dollar</option>
                                        <option value="SEK">SEK - Swedish Krona</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Discounted Price</label>
                                    <input type="number" name="discount_price" id="discount_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Membership</label>
                                    <select name="membership" id="membership" class="form-control">
                                        <option value="">---- Select Membership ----</option>
                                        @foreach ($memberships as $membership)
                                        <option value="{{$membership->membership_id }}">{{ $membership->membership_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="descriptions" id="descriptions" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {

        $("#class_type").change(function() {
            console.log("working");

            var selectedClassType = $(this).val();

            console.log(selectedClassType);

        });
    })

</script>

@endsection
