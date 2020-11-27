<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>

                        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                                data-toggle="modal" data-target="#add-contact"  v-if="user.role==2" >إضافة خبر   جديد</button>

                        <!-- Add Contact Popup Model -->
                        <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">إضافة   جديده  </h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                    </div>

                                    <form class="form-horizontal form-material" @submit.prevent="AddNews" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="title" placeholder="عنوان الخبر  ">
                                                    <div v-if="allErrors.title" class="alert-danger form-control">{{ allErrors.title[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="simpleDescription" placeholder="نبذه عن الخبر  ">
                                                    <div v-if="allErrors.simpleDescription" class="alert-danger form-control">{{ allErrors.simpleDescription[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="link" placeholder="لينك الخبر   ">
                                                    <div v-if="allErrors.link" class="alert-danger form-control">{{ allErrors.link[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label for="exampleFormControlSelect1"> اختر القسم التابع له </label>
                                                        <select class="form-control" id="exampleFormControlSelect1" v-model="subCategoryId">
                                                            <option  v-for="category in subCategory" :value="category.id">{{category.name}}</option>
                                                        </select>
                                                    </div>
                                                    <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.subCategoryId[0] }}</div>

                                                </div>


                                                <div class="col-md-12 m-b-20">
                                                    <label> الصوره   </label>
                                                    <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Image</span>

                                                        <input  type="file" @change="UploadImage" class="upload">
                                                    </div>
                                                </div>
                                                <div v-if="allErrors.image" class="alert-danger form-control">{{ allErrors.image[0] }}</div>



                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info waves-effect"
                                            >Save</button>

                                            <button type="button" class="btn btn-default waves-effect"
                                                    data-dismiss="modal">Cancel</button>

                                        </div>
                                    </form>


                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <h4 class="card-title">  الاخبار   </h4>
                        <h6 class="card-subtitle">رؤية جميع  الاخبار</h6>

                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  عنوان الخبر       </th>
                                <th> تعديل   </th>
                                <th> مشاهدة   </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in news">

                                <td>
                                    {{item.title||' '}}
                                </td>


                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditNews(item.id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>
                                <td>
                                    <router-link  type="button" class="btn btn-warning  m-l-10  m-t-10 mb-2 " :to="{ name: 'showNews',params: { id: item.id }}"> <i class="fa fa-eye"></i> </router-link>
                                </td>

                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteNews(item.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  عنوان الخبر      </th>
                                <th> تعديل   </th>
                                <th> مشاهدة   </th>
                                <th>حذف  </th>

                            </tr>
                            </tfoot>
                        </table>
                        <div id="edit-contact"  class="modal fade in" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" >  تعديل   </h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                    </div>

                                    <form class="form-horizontal form-material" @submit.prevent="UpdatePost(id)"  enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="title" placeholder="عنوان الخبر  ">
                                                    <div v-if="allErrors.title" class="alert-danger form-control">{{ allErrors.title[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="simpleDescription" placeholder="نبذه عن الخبر  ">
                                                    <div v-if="allErrors.simpleDescription" class="alert-danger form-control">{{ allErrors.simpleDescription[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="link" placeholder="لينك الخبر   ">
                                                    <div v-if="allErrors.link" class="alert-danger form-control">{{ allErrors.link[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label for="exampleFormControlSelect1"> اختر القسم التابع له </label>
                                                        <select class="form-control" id="exampleFormControlSelect" v-model="subCategoryId">
                                                            <option  v-for="category in subCategory" :value="category.id">{{category.name}}</option>
                                                        </select>
                                                    </div>
                                                    <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.subCategoryId[0] }}</div>

                                                </div>


                                                <div class="col-md-12 m-b-20">
                                                    <label> الصوره   </label>
                                                    <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Image</span>
                                                        <input  type="file" @change="UploadImage" class="upload">
                                                    </div>
                                                </div>

                                                <img :src="showImage" width="50px" height="50px">

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info waves-effect"
                                            >Save</button>

                                            <button type="button" class="btn btn-default waves-effect"
                                                    data-dismiss="modal">Cancel</button>

                                        </div>
                                    </form>


                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script>

export default {

    mounted() {
        this.GetNews()
    },

    data() {
        return {
            title:'',
            news:{},
            subCategory:{},
            subCategoryId:'',
            simpleDescription:'',
            link:'',
            image:'',
            showImage:'',
            id: '',
            allErrors:[],
            user:''
        };
    },
    methods: {
        GetNews() {
            axios.get('/news' ).then(res => {
                this.news= res.data.news
                this.subCategory= res.data.sub
                this.user= res.data.user
            })
        },
        EditNews($id){
            this.allErrors=[];
            axios.get('/news/'+$id+'/edit').then(res => {
                this.title=res.data.title
                this.subCategoryId=res.data.sub_category_id
                this.simpleDescription=res.data.simple_description
                this.link=res.data.news_link
                this.id=res.data.id
                this.showImage=res.data.image

            })
        },
        AddNews() {
            let self = this;
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('simpleDescription', this.simpleDescription);
            formData.append('link', this.link);
            formData.append('image', this.image);
            formData.append('subCategoryId', this.subCategoryId);
            axios.post('/news', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.GetNews();
                    self.$swal({
                        text:'تم الاضافه بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                }
            )
        },
        DeleteNews($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/news/'+$id).then(res => {
                        this.GetNews()
                    })
                    this.$swal(
                        'تم الحذف بنجاح ',
                    )
                }
            });

        },
        UpdatePost($id) {
            let self = this;
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('simpleDescription', this.simpleDescription);
            formData.append('link', this.link);
            formData.append('image', this.image);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('_method',"PUT")
            axios.post('/news/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(res){
                    self.GetNews();
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function(error){

                self.allErrors = error.response.data.errors
            });
        },
        UploadImage(e){
            this.image = e.target.files[0];

        },




    }
}


</script>
