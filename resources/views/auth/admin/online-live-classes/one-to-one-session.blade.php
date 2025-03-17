@extends('auth.admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Online Live Classes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">One To One Session</li>
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
                <div class="card-header">
                    <div class="card-title">Create One To One Session</div>
                </div>
                <div class="card-body">
                    <h2 class="text-center">Bhakti Coaching & Counseking Worksheet</h2>
                    <form action="">
                        <div class="row">
                            <h4>Spiritual Practice & Current State</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Spiritual Practice & Current State</label>
                                <input type="text" name="" id="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
