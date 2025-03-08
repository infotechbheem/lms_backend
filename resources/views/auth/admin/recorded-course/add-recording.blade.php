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
                    <h1 class="m-0">Recorded Course</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Recorded Courses</li>
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
                <div class="card-header">Add Recorded Course</div>
                <div class="card-body">
                    <form action="{{ route('admin.store-recorded-course') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="course_id">Select Course</label><span class="text-danger">*</span>
                                    <select name="course_id" id="course_id" class="form-control" required>
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- User Engagement -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">User Engagement</label>
                                    <select name="question_answer" id="question_answer" class="form-control">
                                        <option value="">------Select Question Answer Access-------</option>
                                        <option value="Enable">Enable</option>
                                        <option value="Disable">Disable</option>
                                    </select>
                                    <select name="comment_access" id="comment_access" class="form-control">
                                        <option value="">------Select Comment Access-------</option>
                                        <option value="Enable">Enable</option>
                                        <option value="Disable">Disable</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Level and Duration -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="completion_criteria">Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="">Select Level</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advance">Advance</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="thumbnail">Upload Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                </div>
                            </div>

                            <!-- Intro Video -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="intro_video">Upload Intro Video</label><span class="text-danger">*</span>
                                    <input type="file" name="intro_video" id="intro_video" class="form-control" required>
                                </div>
                            </div>

                            <!-- Duration -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="duration">Duration (in minutes)</label>
                                    <input type="number" name="duration" id="duration" class="form-control">
                                </div>
                            </div>

                            <!-- Video Quality -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="video_quality">Video Quality</label>
                                    <select name="video_quality" id="video_quality" class="form-control">
                                        <option value="720p">720p</option>
                                        <option value="1080p">1080p</option>
                                        <option value="4k">4k</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Upload Date -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="upload_date">Upload Date</label>
                                    <input type="date" name="upload_date" id="upload_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="row align-items-center " style="justify-content: space-around; border-bottom: 2px solid black;">
                                    <h4 class="m-0">Add Curriculum under course</h4>
                                    <button type="button" class="btn btn-primary mb-1" id="add-section-btn"><i class="fas fa-plus"></i> Add Section</button>
                                </div>
                            </div>

                            <!-- New Sections will be added here -->
                            <div id="sections-container" class="col-12"></div>

                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-outline-primary mt-4 text-center">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-asset/plugins/jquery/jquery.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin-asset/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        let sectionCounter = 1; // To keep track of sections
        let chapterCounters = {}; // This will hold the chapter count for each section

        // Function to initialize Summernote editor for new textareas
        function initializeSummernote(selector) {
            $(selector).summernote({
                height: 300, // Set the desired height of the editor
                placeholder: 'Write here...', // Optional: Set a placeholder text
                toolbar: [ // Optional: Customize the toolbar
                    ['style', ['bold', 'italic', 'underline', 'clear']]
                    , ['font', ['strikethrough', 'superscript', 'subscript']]
                    , ['para', ['ul', 'ol', 'paragraph']]
                    , ['insert', ['link', 'picture']]
                    , ['view', ['fullscreen', 'codeview', 'help']]
                , ]
            , });
        }

        // Initialize Summernote for the existing textareas
        initializeSummernote('.summernote');

        // Add Section functionality
        $('#add-section-btn').on('click', function() {
            let newSectionHtml = `
                <div class="col-md-12 col-lg-12 col-sm-12 mt-4 p-3 shadow-lg" style="border: 1px solid; border-radius: 5px;" id="section-${sectionCounter}">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="section_title_${sectionCounter}">Add Section title</label>
                                <input type="text" name="section_title_${sectionCounter}" id="section_title_${sectionCounter}" class="form-control" placeholder="Section ${sectionCounter}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-success add-chapter-btn" data-section-id="${sectionCounter}" style="margin-top: 32px">Add Chapter</button>
                                <button type="button" class="btn btn-outline-danger delete-section-btn" data-section-id="${sectionCounter}" style="margin-top: 32px">Delete Section</button>
                            </div>
                        </div>
                    </div>
                    <div class="chapter-container-${sectionCounter}"></div>
                </div>
            `;

            $('#sections-container').append(newSectionHtml);
            chapterCounters[sectionCounter] = 1; // Initialize chapter counter for this section
            sectionCounter++; // Increase the section counter

            // Reinitialize Summernote for any new textarea added dynamically
            initializeSummernote('.summernote');
        });

        // Add Chapter functionality
        $(document).on('click', '.add-chapter-btn', function() {
            const sectionId = $(this).data('section-id');
            const chapterNumber = chapterCounters[sectionId];

            let newChapterHtml = `
                <div class="col-12 shadow-lg p-3 mb-2" style="border: 1px solid; border-radius: 5px;" id="chapter-${sectionId}-${chapterNumber}">
                    <div class="row">
                        <h4>Chapter ${chapterNumber}.</h4>
                        <button type="button" class="btn btn-outline-danger delete-chapter-btn" data-chapter-id="${chapterNumber}" data-section-id="${sectionId}" style="margin-left: 20px;">Delete Chapter</button>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="chapter_title_${sectionId}_${chapterNumber}">Chapter Title</label>
                            <input type="text" name="chapter_title_${sectionId}_${chapterNumber}" id="chapter_title_${sectionId}_${chapterNumber}" class="form-control" placeholder="Chapter ${chapterNumber}">
                        </div>
                    </div>

                    <div class="col">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Compose New Message</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea class="summernote" name="chapter_content_${sectionId}_${chapterNumber}" id="chapter_content_${sectionId}_${chapterNumber}" rows="10" cols="80"></textarea>
                                </div>
                                <div class="row" style="gap:50px">
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fas fa-paperclip"></i> Attachment
                                            <input type="file" name="chapter_materials_${sectionId}_${chapterNumber}">
                                        </div>
                                        <p class="help-block">Max. 32MB</p>
                                    </div>
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fas fa-video mr-"></i> Upload Video Material
                                            <input type="file" name="chapter_video_materials_${sectionId}_${chapterNumber}">
                                        </div>
                                        <p class="help-block">Max. 1 GB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $(`.chapter-container-${sectionId}`).append(newChapterHtml);
            chapterCounters[sectionId]++; // Increment chapter counter for this section

            // Reinitialize Summernote for the newly added chapter
            initializeSummernote('.summernote');
        });

        // Delete Chapter functionality
        $(document).on('click', '.delete-chapter-btn', function() {
            const chapterId = $(this).data('chapter-id');
            const sectionId = $(this).data('section-id');
            $(`#chapter-${sectionId}-${chapterId}`).remove();

            // Re-index the chapters after a chapter is deleted to maintain sequential numbering
            reindexChapters(sectionId);
        });

        // Delete Section functionality
        $(document).on('click', '.delete-section-btn', function() {
            const sectionId = $(this).data('section-id');
            $(`#section-${sectionId}`).remove();

            // Re-index the remaining sections
            reindexSections();
        });

        // Function to reindex chapters after deletion and update placeholders
        function reindexChapters(sectionId) {
            let chapterIndex = 1; // Reset chapter index for re-indexing

            // Loop through each chapter in the section and update its ID, numbering, and placeholder
            $(`.chapter-container-${sectionId}`).children().each(function() {
                // Update the chapter title text
                $(this).find('h4').text(`Chapter ${chapterIndex}`);

                // Update the chapter ID
                $(this).attr('id', `chapter-${sectionId}-${chapterIndex}`);

                // Update delete button data
                $(this).find('.delete-chapter-btn').attr('data-chapter-id', chapterIndex);

                // Re-index the inputs and textarea for the chapters
                $(this).find('[name^="chapter_title"]').attr('name', `chapter_title_${sectionId}_${chapterIndex}`).attr('id', `chapter_title_${sectionId}_${chapterIndex}`).attr('placeholder', `Chapter ${chapterIndex}`);
                $(this).find('[name^="chapter_content"]').attr('name', `chapter_content_${sectionId}_${chapterIndex}`).attr('id', `chapter_content_${sectionId}_${chapterIndex}`);

                chapterIndex++; // Increment the chapter index for the next chapter
            });

            chapterCounters[sectionId] = chapterIndex; // Update the counter for this section
        }

        // Function to reindex sections and update placeholders after deletion
        function reindexSections() {
            let sectionIndex = 1;

            // Loop through each section and update its ID, numbering, and placeholder
            $('#sections-container').children().each(function() {
                // Update the section title
                $(this).find('input[name^="section_title"]').attr('placeholder', `Section ${sectionIndex}`);
                $(this).find('button.add-chapter-btn').attr('data-section-id', sectionIndex);
                $(this).find('button.delete-section-btn').attr('data-section-id', sectionIndex);

                // Update the section ID
                $(this).attr('id', `section-${sectionIndex}`);

                // Re-index the chapters within this section
                reindexChapters(sectionIndex);

                sectionIndex++; // Increment section index for the next section
            });

            sectionCounter = sectionIndex; // Update section counter
        }
    });

</script>


@endsection
