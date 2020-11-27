<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                                data-toggle="modal" data-target="#add-contact" >إضافةاخبار  جديده</button>
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

                                    <form class="form-horizontal form-material" @submit.prevent="AddPost" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name"  id="name" placeholder="	RSS Link ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>
                                                </div>


                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                    <label for="exampleFormControlSelect1"> اختر القسم التابع له </label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="subCategoryId">
                                                        <option  v-for="subCategory in subCategories" :value="subCategory.id">{{subCategory.name}}</option>
                                                    </select>
                                                </div>
                                                <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.subCategoryId[0] }}</div>

                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                    <label > اختر الوكاله التابع له </label>
                                                    <select class="form-control"  v-model="categoryId">
                                                        <option  v-for="category in categories" :value="category.id">{{category.category}}</option>
                                                    </select>
                                                </div>
                                                <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.categoryId[0] }}</div>

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
                        <h4 class="card-title"> الاقسام الاخباريه   </h4>
                        <h6 class="card-subtitle">رؤية جميع الاقسام الاخباريه</h6>

                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  القسم     </th>
                                <th>  الوكاله الاخباريه     </th>
                                <th>   RSS Link     </th>
                                <th> تعديل   </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="post in posts">

                                <td>
                                    {{post.name||' '}}
                                </td>
                                <td>
                                    {{post.category}}
                                </td>
                                <td>
                                    {{post.rss_link}}
                                </td>



                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditPost(post.id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>

                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeletePost(post.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  القسم     </th>
                                <th>  الوكاله الاخباريه     </th>
                                <th>   RSS Link     </th>

                                <th> تعديل   </th>
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
                                                    <input type="text" class="form-control" v-model="name" placeholder="	RSS Link ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                                </div>


                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                    <label> اختر القسم التابع له </label>
                                                    <select class="form-control"  v-model="subCategoryId">
                                                        <option  v-for="subCategory in subCategories" :value="subCategory.id">{{subCategory.name}}</option>
                                                    </select>
                                                </div>
                                                <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.subCategoryId[0] }}</div>

                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                    <label > اختر الوكاله التابع له </label>
                                                    <select class="form-control"  v-model="categoryId">
                                                        <option  v-for="category in categories" :value="category.id">{{category.category}}</option>
                                                    </select>
                                                </div>
                                                <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.categoryId[0] }}</div>

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
        this.GetPosts()
    },

    data() {
        return {
            categoryId:'',
            subCategoryId:'',
            rssLink:'',
            name:'',
            categories:{},
            subCategories:{},
            posts:{},
            id: '',
            editName:'',
            allErrors:[],
        };
    },
    methods: {
        GetPosts() {
            axios.get('/post/all' ).then(res => {
                this.categories = res.data.categories
                this.subCategories= res.data.subCategories
                this.posts= res.data.posts

            })
        },
        EditPost($id){
            this.allErrors=[];
            axios.get('/post/'+$id+'/edit').then(res => {
                this.name=res.data.rss_link
                this.categoryId=res.data.category_id
                this.subCategoryId=res.data.sub_category_id
                this.id=res.data.id

            })
        },
        AddPost() {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('categoryId', this.categoryId);
            axios.post('/post', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.GetPosts();
                    self.$swal({
                        text:'تم الاضافه بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                }
            )
        },
        DeletePost($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/post/'+$id).then(res => {
                        this.GetPosts()
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
            formData.append('name', this.name);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('categoryId', this.categoryId);
            formData.append('_method',"PUT")
            axios.post('/post/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(res){
                    self.GetPosts();
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function(error){

                self.allErrors = error.response.data.errors
            });
        },




    }
}


</script>
