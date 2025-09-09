
<form action="{{ route('worker.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2 class="main-title">My Profile</h2>
    <div class="bg-white card-box border-20">
        <div class="user-avatar-setting d-flex align-items-center mb-30">
            <img id="previewImg"
                src="{{ $profile->profile_picture ? asset($profile->profile_picture) : asset('site/dashboard/avatar_02.jpg') }}"
                class="lazy-img user-img"
                style="width: 100px; height: 100px; object-fit: cover;">
            
            <div class="upload-btn position-relative tran3s ms-4 me-3">
                Upload new photo
                <input type="file" name="profile_picture" id="profile_picture_input" onchange="previewImage(this)">
            </div>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label>Full Name*</label>
            <input type="text" value="{{ $user->name }}" disabled>
        </div>
        <div class="dash-input-wrapper mb-20">
            <label for="category">Select Category</label>
            <select name="category_id" class="form-control" class="nice-select" required>
                <option value="">-- Choose Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->cat_id }}" {{ $profile->category_id == $category->cat_id ? 'selected' : '' }}>
                        {{ $category->cat_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="dash-input-wrapper mb-30">
            <label>Headline</label>
            <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}">
        </div>
        <div class="dash-input-wrapper mb-30">
            <label>Tagline</label>
            <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}">
        </div>
        <div class="dash-input-wrapper mb-30">
            <label>Bio*</label>
            <textarea name="bio">{{ old('bio', $profile->bio) }}</textarea>
        </div>
    </div>

    <div class="bg-white card-box border-20 mt-40">
        <h4>Contact & Availability</h4>
        <div class="dash-input-wrapper mb-20">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}">
        </div>
        <div class="dash-input-wrapper mb-20">
            <label>Experience (years)</label>
            <input type="number" name="experience_years" value="{{ old('experience_years', $profile->experience_years) }}">
        </div>
        <div class="dash-input-wrapper mb-20">
            <label>Working Hours</label>
            <input type="text" name="working_hours" value="{{ old('working_hours', $profile->working_hours) }}">
        </div>
        <div class="dash-input-wrapper mb-20">
            <label>Availability</label>
            <select name="availability" class="nice-select">
                <option value="">Choose Availability...</option>
                <option value="available" {{ $profile->availability == 'available' ? 'selected' : '' }}>Available</option>
                <option value="not_available" {{ $profile->availability == 'not_available' ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>
    </div>

    <div class="bg-white card-box border-20 mt-40">
        <h4>Address & Location</h4>
        <div class="dash-input-wrapper mb-25">
            <label>Address*</label>
            <input type="text" name="address" value="{{ old('address', $profile->address) }}">
        </div>
        <div class="dash-input-wrapper mb-25">
            <label>City*</label>
            <select name="city_id" class="nice-select">
                <option value="">Select City...</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ $profile->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- <div class="bg-white card-box border-20 mt-40">
        <h4>Resume</h4>
        <div class="dash-input-wrapper mb-25">
            <label>Upload Resume</label>
            <input type="file" name="resume">
            @if($profile->resume)
                <a href="{{ asset('storage/' . $profile->resume) }}" target="_blank">View Resume</a>
            @endif
        </div>
    </div> --}}

    <div class="button-group d-inline-flex align-items-center mt-30">
        <button class="dash-btn-two tran3s me-3" type="submit">Save</button>
        <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
    </div>
</form>


<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            document.getElementById('previewImg').src = URL.createObjectURL(file);
        }
    }
</script>