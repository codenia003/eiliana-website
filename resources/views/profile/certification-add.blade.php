@extends('profile/layout')
@section('top')
<div class="bg-red">
    <div class="px-5 py-2">
        <div class="align-items-center">
            <span class="border-title profile_text"><i class="fa fa-bars"></i></span>
            <span class="h5 text-white ml-2 profile_text">Certification</span>
            <nav class="navbar navbar-expand-xl navbar-light custom_header">
				<!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
				<button type="button" class="navbar-toggler profile_nav" data-toggle="collapse" data-target="#navbarCollapse1" style="margin-right: -34px;">
				<span class="border-title profile_text"><i class="fa fa-bars"></i></span>
				</button>
				<!-- Collection of nav links, forms, and other content for toggling -->
				<div id="navbarCollapse1" class="collapse navbar-collapse justify-content-start nav_sub">
					<div class="navbar-nav ml-auto">
						<div class="nav-item dropdown">
							<a href="/profile" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-user-o"></i> Primary Information</a>
							<a href="/profile/education" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> Education</a>
							<a href="/profile/certification" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> Certification</a>
							<a href="/profile/professional-experience" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> Professional Experience</a>
							<a href="/profile" class="dropdown-item sub_nav_menu" style="color:white;"><i class="fa fa-sliders"></i> User Settings</a>
						</div>
					</div>
				</div>
			</nav>
            <!-- <span class="h4 text-white float-right font-weight-light">75% <div class="loader"></div></span> -->
        </div>
    </div>
</div>
@stop
@section('profile_content')
<div class="singup-body login-body profile-basic">
    <div class="card">
        <h4 class="card-header text-left">Certification</h4>
        <div class="card-body p-4">
            <form action="{{ url('/profile/registercertification') }}" method="POST" id="certificateForm">
                @csrf
                <div class="certification-1">
                    @forelse ($certificates as $certificate)
                        <div class="certification-3 remove-qual-{{ $certificate->certificate_id }}">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
                            <!-- <button type="button" onclick="ConfirmDelete('{{ $certificate->certificate_id }}','2')" class="btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
                            <input type="hidden" name="certificate_id[]" id="certificate_id" value="{{ $certificate-> certificate_id }}">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Certification Number</label>
                                    <input type="text" name="certificate_no[]" class="form-control" value="{{ $certificate->certificate_no }}" required />
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Certification Name</label>
                                    <input type="text" name="name[]" class="form-control" value="{{ $certificate->name }}" required/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Year of Certification</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select class="form-control" required="" name="from_date[]">
                                                <option value="">From</option>
                                                @for ($i = 1960; $i < 2021; $i++)
                                                <option value="{{ $i }}" {{ ($certificate->from_date==$i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" required="" name="till_date[]">
                                                <option value="">Till</option>
                                                @for ($i = 1960; $i < 2021; $i++)
                                                <option value="{{ $i }}" {{ ($certificate->from_date==$i)? "selected" : "" }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Institute Name</label>
                                    <input type="text" name="institutename[]" class="form-control" value="{{ $certificate->institutename }}" required />
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="certification-3">
                            <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
                            <input type="hidden" name="certificate_id[]" value="0">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Certification Number</label>
                                    <input type="text" name="certificate_no[]" class="form-control" required/>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Certification Name</label>
                                    <input type="text" name="name[]" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>Year of Certification</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select class="form-control" name="from_date[]" required="">
                                                <option value="">From</option>
                                                @for ($i = 1960; $i < 2021; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="till_date[]" required="">
                                                <option value="">Till</option>
                                                @for ($i = 1960; $i < 2021; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
                                    <label>Institute Name</label>
                                    <input type="text" name="institutename[]" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="btn-group mt-3" role="group">
                    <button class="btn btn-md btn-info btn-copy-c" type="button">Add Certification <span class="fa fa-plus"></span></button>
                    <!-- <button class="btn btn-md btn-danger btn-copy-c" type="button"></button> -->
                    <button type="button" class="remove-c btn btn-md btn-info ml-3 rounded-0">Erase Certification <span class="fas fa-times"></span></button>
                </div>
                <div class="form-group text-right mt-5">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" type="submit">
                            <span class="spinner-border spinner-border-sm mr-1 d-none"></span>
                            Next >>>
                        </button>
                        <!-- <button class="btn btn-outline-primary" type="reset">Discard</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="certification-2 d-none">
    <span class="h4 text-left mt-3 mb-4 d-inline-block">Certification</span>
   <!--  <button type="button" class="remove-c btn btn-outline-danger float-right mt-3 rounded-0"><i class="fas fa-times"></i></button> -->
    <input type="hidden" name="certificate_id[]" id="certificate_id" value="0">
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
            <label>Certification Number</label>
            <input type="text" name="certificate_no[]" class="form-control" required/>
        </div>
        <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
        </div>
        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
            <label>Certification Name</label>
            <input type="text" name="name[]" class="form-control" required/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-sm-12 col-md-4 col-lg-4">
            <label>Year of Certification</label>
            <div class="form-row">
                <div class="col">
                    <select class="form-control" required="" name="from_date[]">
                        <option value="">From</option>
                        @for ($i = 1960; $i < 2021; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" required="" name="till_date[]">
                        <option value="">Till</option>
                        @for ($i = 1960; $i < 2021; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-12 col-sm-12 col-md-1 col-lg-1">
        </div>
        <div class="form-group col-12 col-sm-12 col-md-7 col-lg-7">
            <label>Institute Name</label>
            <input type="text" name="institutename[]" class="form-control" required />
        </div>
    </div>
</div>
@stop
