{{-- Add User --}}
<div class="modal fade " style="color: black; padding-right: 15px;" id="addUser" dir="rtl" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">إضافة مستخدم</h4>
                <span id="next_to_title_3461709970779"></span>
                <button type="button" class="btn-close float-left m-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 2 add new -->
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">اسم المستخدم</label>
                        <div class="col-sm-10">
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">كلمة المرور</label>
                        <div class="col-sm-10">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">تأكيد كلمة المرور</label>
                        <div class="col-sm-10">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">المجموعة</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="roleName" required="">
                                <option value="" selected disabled>الرجاء الاختيار</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            {{-- <input type="hidden" name="save" value="add_new_user"> --}}
                            <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-save"></i> إضافة
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- permissionsUser model --}}

<div class="modal fade " id="permissions{{ $user->role_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">الصلاحيات : <b>وكيل تجربة زبون</b></h4>
                <span id="next_to_title_8711709802951"></span>
                <button type="button" class="btn-close float-left m-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <div class="container" dir="rtl">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title">تعديل صلاحيات المستخدم</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label>{{ $user->name }}</label>
                                </div>
                                <div class="col">
                                    <p>وكيل تجربة زبون</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>الرصيد الائتماني</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="max_credit" value="{{ $user->creditBalance }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header bg-dark text-white collapsed-card" style="cursor:pointer;"
                            data-toggle="collapse" data-target="#asd">
                            <h5 class="card-title">asd <i class="fa fa-chevron-down"></i>
                            </h5>
                        </div>
                    </div>
                    {{--             <div class="card-header bg-dark text-white collapsed-card" style="cursor:pointer;"
                                        data-toggle="collapse" data-target="#{{ $permissionType->name }}">
                                        <h5 class="card-title">{{ $permissionType->name }} <i
                                                class="fa fa-chevron-down"></i></h5>
                                    </div> --}}

                    {{--                 <div class="card-body collapse" id="{{ $permissionType->name }}">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" form-name="permissions"
                                                    class="custom-control-input" id="is_agent" checked="">
                                                <label class="custom-control-label" for="is_agent">
                                                    $حثق</label>
                                            </div>
                                        </div> --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- edit model --}}

<div class="modal fade" style="color: black; padding-right: 17px;" id="edit{{ $user->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" dir="rtl" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">تعديل المستخدم <b>موظف تجربة</b></h4>
                <span id="next_to_title_7281709813746"></span>
                <button type="button" class="btn-close float-left m-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 3 Edit user -->
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">اسم المستخدم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username"
                                placeholder="اسم المستخدم لتسجيل الدخول" value="{{ $user->username }}"
                                required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name"
                                placeholder="اسم المستخدم الذي سيتم عرضه" value=" {{ $user->name }}"
                                required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">المجموعة</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="roleName" required="">
                                <option value="{{ $user->roles->first()->name }}" selected disabled>
                                    {{ $user->roles->first()->name }}
                                </option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2 m-auto">
                            {{-- <input type="hidden" name="save" value="edit_user">
                            <input type="hidden" name="id" value="2"> --}}
                            <button type="submit" class="btn btn-warning btn-block m-0"><i class="fa fa-save"></i>
                                حفظ
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- change password --}}
<div class="modal fade" style="color: black;" id="changePassword{{ $user->id }}" dir="rtl"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">إعادة تعيين كلمة المرور : <b>موظف تجربة</b></h4>
                <button type="button" class="btn-close float-left m-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" dir="rtl">
                <!-- 4 reset password -->
                <form method="post" action="{{ route('resetPassword', ['id' => $user->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label class="text-dark" style="cursor: pointer" for="pass_reset_confirm"
                            dir="rtl">إعادة
                            تعيين كلمة المرور</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: nowrap;">اسم المستخدم</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext">موظف تجربة</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: nowrap;">كلمة المرور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="كلمة المرور الجديدة">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: nowrap;">تأكيد كلمة المرور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="تأكيد كلمة المرور">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> تأكيد</button>
                        </div>
                    </div>
                </form>
                <div id="reset_pass_area">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="delete{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;"> حذف الحساب : <b>زبون تجربة</b></h4>
                <span id="next_to_title_6571709816206"></span>
                <button type="button" class="btn-close float-left m-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 6 disable / Enable -->
                <form method="post" action="{{ route('users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <h5 class="text-red">حذف الحساب</h5>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> تأكيد</button>
                        </div>
                    </div>
                </form>
                <div id="dis_user_area">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<!-- state Modal -->
<div class="modal fade" style="color: black; " id="state{{ $user->id }}" dir="rtl" aria-modal="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">تعطيل / تفعيل حساب المستخدم : <b>زبون تجربة</b></h4>
                <span id="next_to_title_6571709816206"></span>
                <button type="button" class="btn-close float-left m-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 6 disable / Enable -->
                <form method="post" action="{{ route('updateUserState', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <h5 class="text-red">تعطيل / تفعيل حساب المستخدم</h5>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="white-space: nowrap;">اسم المستخدم</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext">زبون تجربة</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <div class="form-check form-switch"
                                style="display: flex;justify-content: flex-start;width: 100px;">
                                <input class="form-check-input" type="checkbox" id="user_disabled"
                                    name="user_disabled">
                                @if (!$user->is_disabled)
                                    <label class="form-check-label" for="user_disabled">تعطيل المستخدم</label>
                                @endif
                                @if ($user->is_disabled)
                                    <label class="form-check-label" for="user_disabled">تفعيل المستخدم</label>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> تأكيد</button>
                        </div>
                    </div>
                </form>
                <div id="dis_user_area">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleCheckbox() {
        const checkbox = document.getElementById('user_disabled');
        checkbox.checked = !checkbox.checked;
    }
</script>
