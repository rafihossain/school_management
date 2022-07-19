@extends('backend.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

             @if(session()->has('email_faild'))
            <div class="alert alert-danger" style="text-align: center;">
                {{ session()->get('email_faild') }}
            </div>
            @endif

            @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif

            <div class="row">

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">

                        </div>

                        <form action="{{route('school.update-school')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <?php
                            $grade_decode = json_decode($school->number_of_student, true);

                            ?>
                            <input type="hidden" value="{{$school->user_id}}" name="user_id">
                            <input type="hidden" value="{{$school->id}}" name="school_id">
                            <input type="hidden" value="{{$school->email}}" name="school_email">
                            <input type="hidden" value="{{$school->school_logo}}" name="old_school_logo">
                            <input type="hidden" value="{{$school->upload_excel}}" name="old_cover_image">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="schoolname">{{__('admin.school_name')}}</label>
                                    <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="schoolname" name="school_name" value="{{$school->school_name}}">
                                    @error('school_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="schoolname">{{__('admin.address')}}</label>
                                    <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="" name="address">{{$school->school_address}}</textarea>
                                    @error('address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="yearestablished">{{__('admin.year_established')}}</label>
                                    <input type="number" class="form-control @error('year_establish') is-invalid @enderror" id="yearestablished" placeholder="" min="0" name="year_establish" value="{{$school->year_establish}}">
                                    @error('year_establish')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="schoolname">{{__('admin.number_of_student')}}</label>
                                    <?php $i = 1; ?>
                                    @foreach($grade as $grades)
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{$grades->grade}}</span>
                                        </div>

                                        <input type="number" class="form-control" placeholder="" name="number_of_student[]" value="{{$grade_decode[$i]}}">
                                    </div>
                                    <?php $i++; ?>
                                    @endforeach
                                </div>


                                <div class="form-group">
                                    <label for="inchargename">{{__('admin.activity_in_charge_name')}}</label>
                                    <input type="text" class="form-control @error('incharge_name') is-invalid @enderror" id="inchargename" name="incharge_name" placeholder="" value="{{$school->incharge_name}}">
                                    @error('incharge_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="yearestablished">official Email Id (principle)</label>
                                    <input type="email" class="form-control @error('official_email_id') is-invalid @enderror" id="yearestablished" placeholder="official Email Id" min="0" name="official_email_id" value="{{$school->official_email_id}}">
                                    @error('official_email_id')
                                            <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inchargeemail">{{__('admin.in_charge_email')}}</label>
                                    <input type="text" class="form-control @error('incharge_email') is-invalid @enderror" id="inchargeemail" name="incharge_email" placeholder="" value="{{$school->incharge_email}}">
                                    @error('incharge_email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inchargecontact">{{__('admin.in_charge_contact_number')}}</label>
                                    <input type="number" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" id="inchargecontact" placeholder="" min="0" value="{{$school->contact_number}}">
                                    @error('contact_number')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="partnername">Kidspreneurship Representative</label>
                                    <input type="text" class="form-control" id="partnername" name="partner_name" placeholder="" value="{{$school->kidspreneurship_representative}}">
                                </div>
                            </div>

                    </div>

                </div>

                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">{{__('admin.school_logo')}}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="school_logo">
                                        <label class="custom-file-label" for="exampleInputFile">{{__('admin.choose_file')}}</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{__('admin.upload')}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Upload School Cover Pictute</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="school_cover_image">
                                        <label class="custom-file-label" for="exampleInputFile">{{__('admin.choose_file')}}</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{__('admin.upload')}}</span>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Upload Excel </label>
                                <input type="file" name="upload_csv" accept=".csv">
                                <p><a href="{{asset('csv/template/student-information-template.csv')}}" class="text-danger">DOWNLOAD EXCEL FOR FORMAT</a></p>
                            </div>

                            <div class="form-group">
                                <label for="schoolname">{{__('admin.course_start_date')}}</label>
                                <input type="date" class="form-control" id="startdate" name="course_start_date" placeholder="" value="{{$school->course_start_date}}">
                            </div>

                            <div class="form-group">
                                <label for="schoolname">Entrepreneurship Lab </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">No</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Later</label>
                                </div>
                            </div>


                            <?php
                            $weekly_class = json_decode($school->weekly_class_for_grade, true);
                            if ($weekly_class) {
                                //echo '<pre>';
                                //print_r($weekly_class['start_time']);die();
                                for ($i = 0; $i < count($weekly_class['day']); $i++) {
                                    //echo $weekly_class['day'][$i]
                            ?>
                                    <div class="form-group">
                                        <label for="schoolname">Weekly Class for Grade </label>
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <select class="form-control" name="day[]">
                                                    <option value="">--select--</option>
                                                    <option value="1" @if($weekly_class['day'][$i]=='1' ) selected @endif>Saturday</option>
                                                    <option value="2" @if($weekly_class['day'][$i]=='2' ) selected @endif>Sunday</option>
                                                    <option value="3" @if($weekly_class['day'][$i]=='3' ) selected @endif>Monday</option>
                                                    <option value="4" @if($weekly_class['day'][$i]=='4' ) selected @endif>Tuesday</option>
                                                    <option value="5" @if($weekly_class['day'][$i]=='5' ) selected @endif>Wednesday</option>
                                                    <option value="6" @if($weekly_class['day'][$i]=='6' ) selected @endif>Thursday</option>
                                                    <option value="7" @if($weekly_class['day'][$i]=='7' ) selected @endif>Friday</option>
                                                </select>
                                            </div>
                                            <div class="col-3 mb-2">
                                                <input type="time" class="form-control" name="start_time[]" value="<?php echo $weekly_class['start_time'][$i]; ?>">
                                            </div>
                                            <div class="col-3 mb-2">
                                                <input type="time" class="form-control" name="end_time[]" value="<?php echo $weekly_class['end_time'][$i]; ?>">

                                            </div>
                                            <div class="col-4 mb-2">
                                                <input type="text" placeholder="Grade" class="form-control" name="grade[]" value="<?php echo $weekly_class['grade'][$i]; ?>">
                                            </div>
                                            <div class="col-4 mb-2">
                                                <input type="text" placeholder="Sec" class="form-control" name="sec[]" value="<?php echo $weekly_class['sec'][$i]; ?>">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" placeholder="Number of Students " class="form-control" name="number_student_new[]" value="<?php echo $weekly_class['number_student'][$i]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span type="button" class="ms-2 badge badge-info addBtn1"> Add more time</span>
                                            <span class="btn btn-danger btn-sm removeBtn1">Remove</span>
                                        </div>
                                    </div>
                                <?php }
                            } else {
                                for ($i = 0; $i <= 4; $i++) {
                                ?>
                                    <div class="form-group">
                                        <label for="schoolname">Weekly Class for Grade </label>
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <select class="form-control" name="day[]">
                                                    <option value="">--select--</option>
                                                    <option value="1">Saturday</option>
                                                    <option value="2">Sunday</option>
                                                    <option value="3">Monday</option>
                                                    <option value="4">Tuesday</option>
                                                    <option value="5">Wednesday</option>
                                                    <option value="6">Thursday</option>
                                                    <option value="7">Friday</option>
                                                </select>
                                            </div>
                                            <div class="col-3 mb-2">
                                                <input type="time" class="form-control" name="start_time[]" value="">
                                            </div>
                                            <div class="col-3 mb-2">
                                                <input type="time" class="form-control" name="end_time[]" value="">

                                            </div>
                                            <div class="col-4 mb-2">
                                                <input type="text" placeholder="Grade" class="form-control" name="grade[]" value="">
                                            </div>
                                            <div class="col-4 mb-2">
                                                <input type="text" placeholder="Sec" class="form-control" name="sec[]" value="">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" placeholder="Number of Students " class="form-control" name="number_student_new[]" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span type="button" class="ms-2 badge badge-info addBtn1"> Add more time</span>
                                            <span class="btn btn-danger btn-sm removeBtn1">Remove</span>
                                        </div>
                                    </div>

                            <?php }
                            } ?>


                            <div class="form-group">
                                <label for="package">Enquiry Message:</label>
                                <textarea class="form-control" placeholder="Write Enquiry Message"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <label for="package">Remarks – Yearly fee for 320 students paid</label>
                                <label>Renewal Due on June 10, 2023 </label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    $('.section_add_more').multifield({
        section: '.row_check_new',
        btnAdd: '.addBtn1',
        btnRemove: '.removeBtn1'
    });
</script>

@endsection