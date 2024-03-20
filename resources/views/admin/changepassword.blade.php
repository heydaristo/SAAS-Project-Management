@php
    $title = 'Setting';
    $pretitle = 'setting/changepasssword';
@endphp

@extends('admintemplate')
@section('adminbody')
    <div class="col-md">
        <div class="card">
            {{-- old password, new password, confirm password --}}
            <div class="card-header">
                <h4>Please Choose A new Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.password') }}" method="post">
                    @csrf
                    <div class="form-group row mb-0 ">
                        <label for="oldpassword" class="col-md-4 col-form-label text-md-right mt-3">Old Password</label>
                        <div class="col-md-6 mt-3">
                            <input type="password" id="oldpassword" class="form-control" name="oldPassword" required>
                        </div>

                        <label for="newpassword" class="col-md-4 col-form-label text-md-right mt-3">New Password</label>
                        <div class="col-md-6 mt-3">
                            <input type="password" id="newpassword" class="form-control" name="newPassword" required>
                        </div>

                        <label for="confirmpassword" class="col-md-4 col-form-label text-md-right mt-3">Confirm
                            Password</label>
                        <div class="col-md-6 mt-3">
                            <input type="password" id="confirmpassword" class="form-control" name="confirmPassword"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
