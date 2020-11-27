<template>

    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" @submit.prevent="UpdateArticle(id)"  enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group">

                                    <div class="col-md-12 m-b-20">
                                        <label> عنوان المقال  </label>
                                        <input type="text" class="form-control" v-model="title" placeholder=" عنوان المقال  ">
                                        <div v-if="allErrors.title" class="alert-danger form-control">{{ allErrors.title[0] }}</div>
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <label>   نبذه مبسطه    </label>
                                        <textarea type="text" class="form-control" v-model="simpleDescription" placeholder=" نبذه مبسطه   " rows="4"></textarea>
                                        <div v-if="allErrors.simpleDescription" class="alert-danger form-control">{{ allErrors.simpleDescription[0] }}</div>
                                    </div>

                                    <div class="col-md-12 m-b-20">
                                        <label>    المقال     </label>
                                        <ckeditor :editor="editor" v-model="article" :config="editorConfig"></ckeditor>
                                        <div v-if="allErrors.article" class="alert-danger form-control">{{ allErrors.article[0] }}</div>
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
                                            <img :src="showImag" width="50px" height="50px">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect"
                                >Save</button>

                                <button type="button" class="btn btn-default waves-effect"
                                        data-dismiss="modal">Cancel</button>

                            </div>
                        </form>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->

</template>
<script>

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    mounted() {
        this.GetData(this.$route.params.id);


    },
    data() {
        return {
            article: '',
            image:'',
            simpleDescription:'',
            title:'',
            showImag:'',
            allErrors:[],
            id:'',
            subCategory:'',
            subCategoryId:'',
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
               language:'ar'
            }
        };
    },
    methods: {
        GetData($id){
            axios.get('article/'+$id+'/edit').then(res => {
                this.subCategory=res.data.sub
                this.title=res.data.data.title
                this.simpleDescription=res.data.data.simple_description
                this.article=res.data.data.article
                this.showImag=res.data.data.image
                this.subCategoryId=res.data.data.sub_category_id
                this.id=res.data.data.id

            })
        },
        UpdateArticle($id){
            let self = this;
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('simpleDescription', this.simpleDescription);
            formData.append('article', this.article);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('image', this.image);
            formData.append('_method',"PUT")
            axios.post('/article/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.$swal({
                        text:'تم التعديل  بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                    console.log( self.allErrors)
                }
            )

        },
        UploadImage(e){
            this.image = e.target.files[0];

        },


    }

}
</script>
