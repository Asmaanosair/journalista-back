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
                            <form class="form-horizontal form-material" @submit.prevent="AddArticle()"  enctype="multipart/form-data">
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
                                            <label>   Topics    </label>
                                            <textarea type="text" class="form-control" v-model="topic" placeholder="Topic " rows="4"></textarea>
                                            <div v-if="allErrors.topic" class="alert-danger form-control">{{ allErrors.topic[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label>   Tags   </label>
                                            <textarea type="text" class="form-control" v-model="tag" placeholder="tag " rows="4"></textarea>
                                            <div v-if="allErrors.tag" class="alert-danger form-control">{{ allErrors.tag[0] }}</div>
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
       this.GetData();
       console.log(this.sub)

    },
    data() {
        return {
            article: '',
            image:'',
            simpleDescription:'',
            title:'',
            topic:'',
            allErrors:[],
            tag:'',
            sizes:'',
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
        GetData(){
            axios.get('article/create').then(res => {
                this.subCategory=res.data
            })
        },
        AddArticle(){
            let self = this;
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('simpleDescription', this.simpleDescription);
            formData.append('article', this.article);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('image', this.image);
            formData.append('topic', this.topic);
            formData.append('tag', this.tag);
            axios.post('/article', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.$swal({
                        text:'تم الاضافه بنجاح   !!!',
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
