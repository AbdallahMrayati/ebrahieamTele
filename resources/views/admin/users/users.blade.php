@extends('layouts.admin')

@section('title', 'جميع المستخدمين')


@section('content')
    <section class="content my-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            حسابات المستخدمين
                            <span id="add_new_btn">
                                <a href="#addUser" data-bs-toggle="modal" class="btn btn-warning text-dark float-right"
                                    id="add_new_user_btn">
                                    <i class="fas fa-plus"></i>إضافة مستخدم
                                </a>
                            </span>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="users_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المستخدم</th>
                                        <th>الاسم</th>
                                        <th>المجموعة</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td> {{ $user->username }} </td>
                                            <td> {{ $user->name }} </td>
                                            <td>{{ $user->role->name }}</td>
                                            <td>

                                                <a href="#edit{{ $user->id }}" data-bs-toggle="modal"
                                                    class="btn btn-xs btn-warning" title="تعديل"
                                                    onclick="senddata('main','todo=admin_users&amp;btn=edit&amp;id=3')">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <a href="#changePassword{{ $user->id }}" data-bs-toggle="modal"
                                                    class="btn btn-xs btn-warning" title="إعادة تعيين كلمة المرور"
                                                    for-user="u-3"
                                                    onclick="senddata('main','todo=admin_users&amp;btn=reset_password&amp;id=3')">
                                                    <i class="fas fa-key"></i>
                                                </a>
                                                <!-- 2 group 2 -->
                                                <a href="#permissions{{ $user->role_id }}" data-bs-toggle="modal"
                                                    class="btn btn-success btn-xs" title="الصلاحيات"> <i
                                                        class="fa fa-user-lock"></i> </a>
                                                @if ($user->role_id == 2)
                                                    <button class="btn btn-info btn-xs"
                                                        onclick="senddata('main','todo=admin_users&amp;btn=prices&amp;id=3')"
                                                        title="الأسعار"><i class="fa fa-money-bill-alt"></i> </button>
                                                @endif
                                                <a href="#delete{{ $user->id }}" data-bs-toggle="modal"
                                                    class="btn btn-xs btn-danger" title="حذف" for-user="u-3"
                                                    onclick="senddata('main','todo=admin_users&amp;btn=delete&amp;id=3')">
                                                    <i class="fas fa-user-times"></i>
                                                </a>
                                                <a href="#state{{ $user->id }}" data-bs-toggle="modal"
                                                    class="btn btn-xs btn-danger" title="تعطيل / تفعيل" for-user="u-3"
                                                    onclick="senddata('main','todo=admin_users&amp;btn=disable&amp;id=3')">
                                                    <i class="fas fa-user-slash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('admin.users.actionUser')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CONTENT END -->
                </div>
            </div>
        </div>
    </section>
@endsection
