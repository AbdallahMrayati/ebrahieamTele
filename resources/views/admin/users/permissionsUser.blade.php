@extends('layouts.admin')

@section('title', ' الصلاحيات')


@section('content')
    <div class="card my-4">
        <div class="card-header bg-dark text-white text-end">
            <h5 class="card-title">الصلاحيات : <b>وكيل تجربة زبون</b></h5>
        </div>
        <div class="card-body">
            <form action="{{ route('changePermissions', $user->id) }}" method="POST">
                @csrf
                {{-- @method('PUT') --}}
                <div class="container" dir="rtl">
                    <div class="card">
                        <div class="card-header bg-danger text-white text-end">
                            <h5 class="card-title">تعديل صلاحيات المستخدم</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-end">
                                    <label class="text-end">asd</label>
                                </div>
                                <div class="col ">
                                    <p class="text-end">وكيل تجربة زبون</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-end">
                                    <label class="text-end">الرصيد الائتماني</label>
                                </div>
                                <div class="col">
                                    <input type="number" id="max_credit" value="asd" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        @php
                            function getPermissionTypeLabel($permissionType)
                            {
                                switch ($permissionType) {
                                    case 'agents':
                                        return 'وكلاء';
                                    case 'servises':
                                        return 'خدمات';
                                    case 'management':
                                        return 'إدارة';
                                    case 'price':
                                        return 'الأسعار';
                                    default:
                                        return '';
                                }
                            }
                        @endphp
                        @foreach ($permissionTypes as $permissionType)
                            <div class="card-header bg-dark text-white collapsed-card text-end" style="cursor:pointer;"
                                data-toggle="collapse" data-target="#{{ $permissionType }}">
                                <h5 class="card-title">{{ getPermissionTypeLabel($permissionType) }} <i
                                        class="fa fa-chevron-down"></i></h5>
                            </div>
                            <div class="card-body collapse" id="{{ $permissionType }}">
                                @foreach ($permissions as $permission)
                                    @if ($permission->permissionType === $permissionType)
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="custom-control-input" id="permission{{ $permission->id }}"
                                                {{ $user->hasDirectPermission($permission) ? 'checked' : '' }}>
                                            <label class="custom-control-label text-end"
                                                for="permission{{ $permission->id }}">{{ trans('permissions.' . $permission->name) }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        {{-- @foreach ($permissionTypes as $permissionType)
                            <div class="card-header bg-dark text-white collapsed-card text-end" style="cursor:pointer;"
                                data-toggle="collapse" data-target="#{{ $permissionType }}">
                                <h5 class="card-title">{{ getPermissionTypeLabel($permissionType) }} <i
                                        class="fa fa-chevron-down"></i></h5>
                            </div>
                            <div class="card-body collapse" id="{{ $permissionType }}">
                                @foreach ($permissions as $permission)
                                    @if ($permission->permissionType === $permissionType)
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="custom-control-input" id="permission{{ $permission->id }}"
                                                {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                            <label class="custom-control-label text-end"
                                                for="permission{{ $permission->id }}">{{ trans('permissions.' . $permission->name) }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach --}}
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- <div class="card-header bg-dark text-white collapsed-card text-end" style="cursor:pointer;"
                        data-toggle="collapse" data-target="#asd">
                        <h5 class="card-title ">asd <i class="fa fa-chevron-down"></i></h5>
                    </div>
                    <div class="card-body collapse" id="asd">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" form-name="permissions" class="custom-control-input" id="is_agent"
                                checked="">
                            <label class="custom-control-label text-end" for="is_agent">$حثق</label>
                        </div>
                    </div> --}}
