@extends('auth.admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <style>
        .content {
            padding: 20px;
        }

        content .container-fluid {
            max-width: 900px;
            margin: 20px auto;
        }

        .content .card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            font-weight: bold;
            text-align: center;
        }

        .content .card-body {
            padding: 20px;
        }

        .content h2.text-center {
            margin-bottom: 20px;
            color: #333;
        }

        .content h4 {
            color: #555;
            margin-top: 15px;
        }

        .content label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .content input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border 0.3s ease;
        }

        .content input[type="text"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        #addInputBtn {
            width: 100%;
            padding: 8px 12px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        #addInputBtn:hover {
            background-color: #218838;
        }

        .content .container-fluid {
            max-width: 900px;
            margin: 30px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            padding: 30px;
        }

        .content h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .content .card {
            background-color: #f8f9fa;
            border: none;
            border-radius: 12px;
            padding: 20px;
        }

        .content .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 8px 8px 0 0;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .content .card-body {
            padding: 20px;
        }

        .content .row {
            background-color: #ffffff;
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);

        }

        .content .row h4 {
            font-size: 1.2rem;
            color: #007bff;
            margin-bottom: 10px;
            font-weight: 600;

        }

        .content label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }

        .content input[type="text"] {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            outline: none;
            transition: border 0.3s ease;
        }

        .content input[type="text"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
        }

        .content .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .content .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .content .btn-primary {
            background-color: #007bff;
        }

        .content .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .content .btn-danger {
            background-color: #dc3545;
        }

        .content .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .sub-container {
            margin-left: 50px;
        }
    </style>
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

                        <div class="session-details">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="duration">Session Duration</label>
                                    <input type="text" id="duration" class="form-control" placeholder="e.g., 1 hour">
                                </div>
                                <div class="col-md-3">
                                    <label for="devoteeName">Devotee Name</label>
                                    <input type="text" id="devoteeName" class="form-control" placeholder="Enter name">
                                </div>
                                <div class="col-md-3">
                                    <label for="location">Location</label>
                                    <input type="text" id="location" class="form-control" placeholder="Enter location">
                                </div>
                            </div>
                        </div>

                        <form id="dynamicForm">
                            <div class="rows mt-5">
                                <h4>1. Spiritual Practice & Current State</h4>
                            </div>
                            <div class="row mt-4" id="inputContainers">
                                <div class="col-lg-7">
                                    <label for="">Spiritual Practice & Current State</label>
                                    <input type="text" name="" id="">
                                </div>
                                <div class="col-lg-2 d-flex align-items-end">
                                    <button type="button" id="addInputBtn" class="btn btn-primary">Add New</button>
                                </div>
                            </div>
                            <div class="rows mt-4" id="inputContainer">

                            </div>

                        </form>
                        <div class="session-details mt-5">
                            <div class="rows mt-5">
                                <h4>2. Action Plan & Next Steps</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="practical">Set Practical</label>
                                    <input type="text" id="practical" class="form-control"
                                        placeholder="e.g., Daily meditation">
                                </div>
                                <div class="col-md-4">
                                    <label for="achievableGoals">Achievable Goals</label>
                                    <input type="text" id="achievableGoals" class="form-control"
                                        placeholder="e.g., Complete Gita study">
                                </div>
                                <div class="col-md-4">
                                    <label for="sadhanaGoal">Sadhana Goal</label>
                                    <input type="text" id="sadhanaGoal" class="form-control"
                                        placeholder="e.g., 16 rounds of chanting">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="serviceGoal">Service/Seva Goal</label>
                                    <input type="text" id="serviceGoal" class="form-control"
                                        placeholder="e.g., Volunteer weekly">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="personalImprovement">Personal Improvement Goal</label>
                                    <input type="text" id="personalImprovement" class="form-control"
                                        placeholder="e.g., Better time management">
                                </div>
                            </div>
                        </div>
                        <div class="Additional-Notes mt-5">
                            <div class="rows mt-5">
                                <h4>3. Additional Notes & Observation:</h4>
                            </div>
                            <div class="row">

                                <div class="col-12">

                                    <textarea id="additionalNotes" class="form-control" rows="4" placeholder="Enter any additional details..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="follow-up-plan mt-5">
                            <div class="rows">
                                <h4>4. Follow-Up Plan</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nextCheckIn">Next Check-in Date</label>
                                    <input type="date" id="nextCheckIn" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="keyAreas">Key Areas to Follow Up On</label>
                                    <input type="text" id="keyAreas" class="form-control"
                                        placeholder="Enter key areas">
                                </div>
                                <div class="col-md-6 mt-3 d-flex align-items-center">
                                    <input type="checkbox" id="chattingImprovement" class="me-2">
                                    <label for="chattingImprovement" class="mb-0 mx-1">Chatting Improvement</label>
                                </div>
                                <div class="col-md-6 mt-3 d-flex align-items-center">
                                    <input type="checkbox" id="scriptureConsistency" class="me-2">
                                    <label for="scriptureConsistency" class="mb-0 mx-1">Scripture Reading
                                        Consistency</label>
                                </div>
                                <div class="col-md-6 mt-3 d-flex align-items-center">
                                    <input type="checkbox" id="serviceEngagement" class="me-2">
                                    <label for="serviceEngagement" class="mb-0 mx-1">Service Engagement</label>
                                </div>
                                <div class="col-md-6 mt-3 d-flex align-items-center">
                                    <input type="checkbox" id="familyBalance" class="me-2">
                                    <label for="familyBalance" class="mb-0 mx-1">Family/Spiritual Balance</label>
                                </div>
                                <div class="col-md-6 mt-3 d-flex align-items-center">
                                    <input type="checkbox" id="specificStruggles" class="me-2">
                                    <label for="specificStruggles" class="mb-0 mx-1">Any Other Specific Struggles</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>



    <script>
        document.getElementById('addInputBtn').addEventListener('click', function() {
            const container = document.getElementById('inputContainer');

            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'main-entry mb-3';

            newInputGroup.innerHTML = `
        <div class="row mt-2">
            <div class="col-md-8">
                <h4>Main Spiritual Practice & Current State</h4>
                <label for="">Spiritual Practice & Current State</label>
                <input type="text" name="mainInput" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="button" class="btn btn-danger remove-btn">Remove</button>
                <button type="button" class="btn btn-primary add-sub-btn mx-2">Add Sub</button>
            </div>
        </div>
        <div class="sub-container mt-2"></div>
    `;

            container.appendChild(newInputGroup);

            // Remove Main Entry
            newInputGroup.querySelector('.remove-btn').addEventListener('click', function() {
                container.removeChild(newInputGroup);
            });

            // Add Sub Entry Below the Main Entry
            newInputGroup.querySelector('.add-sub-btn').addEventListener('click', function() {
                const subContainer = newInputGroup.querySelector('.sub-container');

                const subEntry = document.createElement('div');
                subEntry.className = 'row mt-2';

                subEntry.innerHTML = `
            <div class="col-md-8">
                <label for="">Sub Spiritual Practice & Current State</label>
                <input type="text" name="subInput" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-sub-btn">Remove</button>
            </div>
        `;

                subContainer.appendChild(subEntry);

                // Remove Sub Entry
                subEntry.querySelector('.remove-sub-btn').addEventListener('click', function() {
                    subContainer.removeChild(subEntry);
                });
            });
        });
    </script>
@endsection
