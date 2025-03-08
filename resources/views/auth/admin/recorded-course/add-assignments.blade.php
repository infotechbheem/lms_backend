@extends('auth.admin.layouts.app')

@section('main-content')

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.css') }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Assignments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Assignments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus dignissimos quo quos commodi minus laudantium repellat voluptas porro sunt nemo, illo inventore exercitationem neque voluptate a placeat nobis. Molestiae, error.</p>
            </div>
        </div>
    </section>
</div>


<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {

    });

</script>


@endsection
