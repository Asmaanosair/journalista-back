@extends('admin.layouts.adminLayout')
@section('content')
<div class="profile ">


    <div class="card col-md-6 col-10  ">
        <form action="{{route('admin.update.profile' , Auth::user()->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-center ">
                <img class="card-img-top my-image" src="{{ $image }}" alt="Card image cap">
            </div>
            <div class="d-flex justify-content-center " style="margin-left:-10% ;margin-top:30px;margin-bottom:20px">
                <input type="file" name="image">
            </div>
            <!-- <div class="card-body">
                <h5 class="card-title">تغيير الصفحة الشخصية </h5>

            </div> -->
            <ul class="list-group list-group-flush">

                <li class="list-group-item"><span>الاسم : </span> <input type="text" class="margin_right" name="name" value="{{$profile->name}}"></li>


                <li class="list-group-item"><span>البريد الالكترونى : </span> <input type="text" class="margin_right" name="email" value="{{$profile->email}}"></li>



                <li class="list-group-item"><span>الجنسية : </span> <input type="text" class="margin_right" name="nationality" value="{{$profile->nationality}}"></li>



                <li class="list-group-item"><span>رقم الموبايل : </span> <input type="text" class="margin_right" name="phone_number" value="{{$profile->phone_number}}"></li>

                @if(auth()->user()->is_organization())
                <li class="list-group-item"><span>اسم المنظمة : </span> <input type="text" class="margin_right" name="org_name" value="{{$profile->organization->name}}"></li>
                <li class="list-group-item"><span>نشاط المنظمة : </span> <input type="text" class="margin_right" name="activity" value="{{$profile->organization->activity}}"></li>
                @endif


                <li class="list-group-item"><span>تغيير كلمة المرور : </span> <input minlength="8" type="text" class="margin_right" name="password" placeholder="كلمة المرور ..."></li>


            </ul>

            <div class="card-body">
                <input type="submit" class="card-link form-control" value="تحديث">
            </div>

        </form>

    </div>

</div>

@stop
