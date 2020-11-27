@extends('admin.layouts.adminLayout')
@section('content')
<div class="profile text-center">

    @if(session()->has('success') )
    <div class="alert alert-success">
        {{ session()->get('success')   }}
    </div>
    @endif
    <div class="card col-md-5 col-8   text-center">
        <div class="d-flex justify-content-center">
            <img class="card-img-top my-image" src="{{$image }}"  alt="Card image cap">
        </div>
        <div class="card-body">
            <h2 class="card-title">المعلومات الشخصية</h2>

        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><span>الاسم : </span>{{$profile->name}}</li>

            <li class="list-group-item"><span>الايميل : </span>{{$profile->email}}</li>

            <li class="list-group-item"><span>الجنسية : </span>{{$profile->nationality}}</li>

            <li class="list-group-item"><span>رقم الموبايل : </span>{{$profile->phone_number}}</li>
            @if(auth()->user()->is_organization())
            <li class="list-group-item"><span>اسم المنظمة : </span>{{$profile->organization->name}}</li>
            <li class="list-group-item"><span>نشاط المنظمة : </span>{{$profile->organization->activity}}</li>
            @endif

        </ul>
        <div class="card-body">
            <a class="btn btn-success" href="{{route('admin.edit.profile',Auth::user()->id)}}" class="card-link">تعديل الصفحة الشخصية</a>

        </div>
    </div>

</div>

@stop
