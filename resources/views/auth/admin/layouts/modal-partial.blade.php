<!-- Store Course Modal -->
<div class="modal fade" id="createNewCourse" tabindex="-1" role="dialog" aria-labelledby="createNewCourseLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewCourseLabel">Create Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.store-course') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Course Title</label>
                                <input type="text" class="form-control" name="course_title" id="course_title">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Time</label>
                                <input type="time" class="form-control" name="time" id="time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Upload Cover Image</label>
                                <input type="file" class="form-control" name="cover_image" id="cover_image">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Select Fee Type</label>
                                <select name="fee_type" id="fee_type" class="form-control">
                                    <option value="">---------Select--------</option>
                                    <option value="paid">Paid</option>
                                    <option value="free">Free</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Discounted Price</label>
                                <input type="number" name="discount_price" id="discount_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
