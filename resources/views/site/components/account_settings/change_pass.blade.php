        <h2 class="main-title">Change Password</h2>

        <div class="bg-white card-box border-20">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('change.password') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="dash-input-wrapper mb-20">
                            <label>Old Password*</label>
                            <input type="password" name="old_password" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dash-input-wrapper mb-20">
                            <label>New Password*</label>
                            <input type="password" name="new_password" required minlength="8">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dash-input-wrapper mb-20">
                            <label>Confirm Password*</label>
                            <input type="password" name="new_password_confirmation" required minlength="8">
                        </div>
                    </div>
                </div>

                <div class="button-group d-inline-flex align-items-center">
                    <button type="submit" class="dash-btn-two tran3s rounded-3">Save & Update</button>
                </div>
            </form>

        </div>
        <!-- /.card-box -->				
    </div>
</div>