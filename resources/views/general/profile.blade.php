@extends('app_layout.app_layout')
@section('content')
<div class="container-fluid">
    <h6 class="my-profile mt-3">My Profile</h6>
    <!-- Top Buttons -->
    <div class="top-buttons">
        <button class="btn-update">Update</button>
    </div>

    <div class="content-wrapper">
        <!-- Left Profile -->
        <div class="profile-section">
            <img src="profile-image.jpg" alt="Profile" class="profile-img">
            <h2 class="name">SengHeang</h2>
            <p class="role">President</p>
            <p class="department">Small/Medium</p>
            <p class="account">Account No : 9</p>
            <button class="btn-upload">Upload</button>
        </div>

        <!-- Right Forms -->
        <div class="forms-section">
            <!-- General Section -->
            <div class="form-card">
                <div class="card-title">General</div>
                <div class="form-grid">
                    <div class="form-row">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" value="Panhaboy@gmail.com">
                    </div>
                    <div class="form-row">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" value="panha">
                    </div>
                    <div class="form-row">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" value="Blue">
                    </div>
                    <div class="form-row">
                        <label>Gender <span class="required">*</span></label>
                        <select>
                            <option>Select Gender</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label>Date of Birth <span class="required">*</span></label>
                        <input type="text" value="24-Nov-2024">
                    </div>
                    <div class="form-row">
                        <label>Phone Number <span class="required">*</span></label>
                        <div class="phone-input">
                            <div class="country-select">
                            
                                <select class="country-list">
                                    <option value="+855">+855</option>
                                    <option value="+1">+1</option>
                                    <option value="+44">+44</option>
                                    <option value="+81">+81</option>
                                    <option value="+86">+86</option>
                                    <!-- Add more country codes as needed -->
                                </select>
                            </div>
                            <input type="text" class="phone-number" placeholder="Phone No.">
                        </div>
                    </div>
                    <div class="form-row">
                        <label>Organization Name <span class="required">*</span></label>
                        <input type="text" value="PH-01">
                    </div>
                    <div class="form-row">
                        <label>Id Card No</label>
                        <input type="text" placeholder="Id Card No">
                    </div>
                    <div class="form-row full-width">
                        <label>Tag</label>
                        <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo">
                    </div>
                </div>
            </div>

            <!-- Communication Section -->
            <div class="form-card">
                <div class="card-title">Communication</div>
                <div class="form-grid">
                    <div class="form-row">
                        <label>Address <span class="required">*</span></label>
                        <input type="text" placeholder="Address">
                    </div>
                    <div class="form-row">
                        <label>Address 2 <span class="required">*</span></label>
                        <input type="text" placeholder="Address 2">
                    </div>
                    <div class="form-row">
                        <label>Country Code <span class="required">*</span></label>
                        <select>
                            <option>Select Country</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label>City/Town <span class="required">*</span></label>
                        <input type="text" placeholder="City/Town">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

</style>
@endsection
