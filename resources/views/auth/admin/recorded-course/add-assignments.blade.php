@extends('auth.admin.layouts.app')

@section('main-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .content-wrapper {
        background-color: #F0EBF8;
        padding-bottom: 50px
    }

    .add-assigment-section-mains {
        margin-top: 30px;
        padding: 0px 50px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 15px;
    }

    .assigment-title-decription-new-section {
        width: 100%;
    }

    .assigment-title-decription {
        width: 100%;
        background-color: white;
        border-top: 10px solid #673AB7;
        border-left: 7px solid #4285F4;
        border-radius: 5px;
        padding: 30px;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    }

    .assigment-title input {
        width: 100%;
        padding: 10px 0px;
        border: none;
        border-bottom: 2px solid #E0E0E0;
        outline: none;
        transition: border-bottom 0.3s ease;
    }

    #assignment-title-1 {
        font-size: 40px;
    }

    .assigment-title input:focus {
        border-bottom: 2px solid #673AB7;

    }

    .assigment-title-decription-controller {
        width: 50px;
        border-radius: 7px;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        background-color: white;
        min-height: 280px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .assigment-title-decription-controller i {
        color: #4e4e4e;
        font-size: 17px;
        font-weight: bold;
    }

    .controller-icon {
        width: 25px;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .new-section {
        margin-top: 20px;
        background-color: #ffffff;
        border-left: 6px solid #4285F4;
        border-radius: 8px;
        padding: 20px;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
        border-top: 0;
    }

    .section-heading {
        color: #673AB7;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .assigment-title {
        display: flex;
        gap: 20px;
        align-items: center;
        justify-content: space-between;
    }

    .multiple-choice {
        border: 1px solid rgb(215, 215, 215);
        padding-right: 10px;
        width: 30%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .multiple-choice button {
        border: none;
        padding: 10px;
        background-color: transparent;
        color: #4e4e4e;
    }

    .multiple-chopice-option {
        margin-top: 20px;
        gap: 10px !important;
    }

    .multiple-chopice-option i {
        font-size: 20px !important;
        color: #949494 !important;
    }

    .multiple-chopice-option input::placeholder {
        color: black !important;
    }

    .multiple-chopice-option input {
        border: none;
    }

    .multiple-chopice-option input:hover {
        border-bottom: 2px solid #E0E0E0;
    }

    .multiple-chopice-option input:focus {
        border-bottom: 2px solid #673AB7;

    }

    .multiple-chopice-option-add {
        display: flex;
        align-items: center;
        gap: 10px !important;
        margin-top: 20px;
    }

    .multiple-chopice-option-add p {
        padding: 0;
        margin: 0;
        cursor: pointer;
    }

    .multiple-chopice-option-add i {
        font-size: 20px !important;
        color: #949494 !important;
    }

    .multiple-chopice-option-add h5 {
        margin: 0;
        padding: 0;
        color: #4285F4;
        font-size: 14px;
        cursor: pointer;
    }

    .assigment-title button i {
        font-size: 20px;
        color: rgb(75, 75, 75);
        padding-right: 10px;
    }

    .assigment-title i {
        font-size: 15px;
        color: rgb(75, 75, 75);
    }

    .newSectionInput {
        width: 70% !important;
        background-color: #F8F9FA;
        padding: 13px !important;
    }

    .newSectionInput::placeholder {
        font-size: 17px;
    }

    .modal-dialog-end {
        position: fixed;
        top: 13px;
        right: 10%;
        height: 95vh;
        width: 250px;
        margin: 0;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }

    .modal.show .modal-dialog-end {
        transform: translateX(0);
    }

    .modal-content {
        border-radius: 10px;
        height: 100%;
    }

    .modal-body {
        overflow-y: auto;
        border-radius: 10px;
    }

    .delete-option {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
    }

    .delete-option :hover {
        background-color: #ebeced;
        cursor: pointer;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 100px;
    }

    .delete-option i {
        font-size: 15px;
        color: rgb(91, 91, 91) !important;

    }

    .new-section-bottom {
        margin-top: 25px;
        padding: 20px 10px;
        border-top: 1px solid rgb(214, 214, 214);
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 30px;
    }

    .new-section-bottom .toggle-switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
        margin: 0;
        padding: 0;
    }

    .new-section-bottom .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .new-section-bottom .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        border-radius: 20px;
        transition: 0.4s;
    }

    .new-section-bottom .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        border-radius: 50%;
        transition: 0.4s;
    }

    .new-section-bottom input:checked+.slider {
        background-color: #673AB7;
    }

    .new-section-bottom input:checked+.slider:before {
        transform: translateX(14px);
    }

    .new-section-bottom span {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        padding: 0;
    }

    .modal-body {
        padding: 0;

    }

    .list-group .list-group-item {
        border: none;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 17px 25px;
        border-top: 1px solid rgb(190, 190, 190);
        transition: all 0.3s ease;
    }

    .list-group .list-group-item:hover {
        background-color: rgb(234, 234, 234);
        cursor: pointer;
    }

    .list-group .list-group-item i {
        font-size: 17px;
    }

    .assigment-title-decription-controller {
        position: sticky;
        top: 20%;
    }

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Assignment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Assignment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <div class="add-assigment-section-mains">
        <div class="assigment-title-decription-new-section">
            <div class="assigment-title-decription ">
                <div class="assigment-title w-25">
                    <select name="course" id="course" class="form-control">
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id }}">{{ $course->course_title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="assigment-title">
                    <input type="text" id="assignment-title-1" name="assignment_title" placeholder="Assignment title" required>
                </div>
                <div class="assigment-title">
                    <input type="number" id="passing-percentage" name="passing_percentage" placeholder="Passing Percentage" required>
                </div>
                <div class="assigment-title">
                    <input type="number" id="retake-allowed" name="retake_allowed" placeholder="How many times retake allowed?" required>
                </div>
            </div>
            {{-- multiple-choice section --}}
            <div class="assigment-title-decription new-section" id="hidden-section">
                <div class="assigment-title d-flex align-items-center">
                    <input class="newSectionInput" type="text" name="new-assignment-title" placeholder="Question" required>
                    <i class="fa-regular fa-image"></i>
                    <div class="multiple-choice" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        <button type="button">
                            <i class="far fa-dot-circle"></i>
                            Multiple Choise
                        </button>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>

                </div>
                <div class="assigment-title multiple-chopice-option">
                    <i class="fa-regular fa-circle"></i>
                    <input type="text" name="new-assignment-description" placeholder="Option 1" required>
                </div>
                <div class="multiple-chopice-option-add">
                    <i class="fa-regular fa-circle"></i>
                    <p class="multiple-chopice-option-add">Add Option</p>
                    <span>or</span>
                    <h5 class="add-other">Add " Other"</h5>
                </div>

                <div class="new-section-bottom">
                    <a href="#" class="delete-section" title="Delete section">
                        <i class="fa-solid fa-trash" style="color: rgb(141, 141, 141);"></i>
                    </a>
                    <span>Required
                        <label class="toggle-switch">
                            <input type="checkbox" id="toggle-btn">
                            <span class="slider round"></span>
                        </label>
                    </span>
                </div>

            </div>
        </div>
        <div class="assigment-title-decription-controller">
            <div class="controller-icon">
                <a href="" title="Add question"><i class="fa-solid fa-circle-plus"></i> </a>
            </div>
            <div class="controller-icon">
                <a href="" title="Import question"> <i class="fa-regular fa-file"></i></a>
            </div>
            <div class="controller-icon">
                <a href="" title="Add title and description"><i class="fa-solid fa-t"></i> </a>
            </div>
            <div class="controller-icon">
                <a href="" title="Add image"><i class="fa-regular fa-file-image"></i> </a>
            </div>
            <div class="controller-icon">
                <a href="" title="Add video"> <i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="controller-icon">
                <a href="" title="Add section"> <i class="fa-solid fa-puzzle-piece"></i></a>
            </div>
        </div>
    </div>

</div>
<!-- Button trigger modal -->

{{-- modal section --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-end">
        <div class="modal-content">
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa-solid fa-grip-lines"></i>Short answer</li>
                    <li class="list-group-item"><i class="fa-solid fa-align-left"></i>Paragraph</li>
                    <li class="list-group-item"> <i class="far fa-dot-circle"></i>Multiple choice</li>
                    <li class="list-group-item"> <i class="far fa-square"></i> Checkboxes</li>
                    <li class="list-group-item"><i class="fas fa-caret-down"></i>
                        Drop-down</li>
                    <li class="list-group-item"><i class="fa-solid fa-arrow-up-from-bracket"></i>File upload</li>
                    <li class="list-group-item"><i class="fa-solid fa-timeline"></i>Linear scale</li>
                    <li class="list-group-item"><i class="fa-solid fa-star-half-stroke"></i>Rating</li>
                    <li class="list-group-item"><i class="fa-solid fa-braille"></i>Multiple choice grid</li>
                    <li class="list-group-item"><i class="fa-solid fa-arrows-to-dot"></i>Tic box grid</li>
                    <li class="list-group-item"><i class="fa-regular fa-clock"></i>Date</li>
                    <li class="list-group-item"><i class="fa-solid fa-table"></i>Time</li>

                </ul>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
@include('auth.admin.layouts.assignment-js')
@endsection
