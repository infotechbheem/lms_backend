@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Membership / Level</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Membership</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    Create Membership / Level
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store-membership') }}" id="membership-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Membership Name Field -->
                            <div class="col-md-4 col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Name of Label / Membership</label><span class="text-danger">*</span>
                                    <input type="text" name="membership_name" id="membership_name" class="form-control">
                                    @error('membership_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Upload Cover Image Field -->
                            <div class="col-md-4 col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Upload Cover Image</label><span class="text-danger">*</span>
                                    <input type="file" name="cover_image" id="cover_image" class="form-control">
                                    @error('cover_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Plan Field -->
                            <div class="col-md-4 col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Plan</label><span class="text-danger">*</span>
                                    <select name="plan" id="plan" class="form-control">
                                        <option value="">---- Select Plan ------</option>
                                        <option value="free">Free</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                    @error('plan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Currency Field -->
                            <div class="col-md-4 col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="currency">Currency</label><span class="text-danger">*</span>
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
                                    @error('currency')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Description</label><span class="text-danger">*</span>
                                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Selling Price Field -->
                            <div class="col-md-4 col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Selling Price</label><span class="text-danger">*</span>
                                    <input type="text" name="selling_price" id="selling_price" class="form-control">
                                    @error('selling_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Discounted Price Field -->
                            <div class="col-md-4 col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="">Discounted Price</label><span class="text-danger">*</span>
                                    <input type="text" name="discount_price" id="discount_price" class="form-control">
                                    @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>

@endsection
