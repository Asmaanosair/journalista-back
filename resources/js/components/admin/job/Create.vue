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
                            <form class="form-horizontal form-material" @submit.prevent="AddJob()"  enctype="multipart/form-data">
                                <div class="modal-body">

                                    <div class="form-group">

                                        <div class="col-md-12 m-b-20">
                                            <label>  الوظيفة  </label>
                                            <input type="text" class="form-control" v-model="name" placeholder="  الوظيفة  ">
                                            <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label>   نبذه مبسطه    </label>
                                            <textarea type="text" class="form-control" v-model="description" placeholder=" نبذه مبسطه   " rows="4"></textarea>
                                            <div v-if="allErrors.description" class="alert-danger form-control">{{ allErrors.description[0] }}</div>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <label>    المتطلبات     </label>
                                            <ckeditor :editor="editor" v-model="requirements" :config="editorConfig"></ckeditor>

                                            <div v-if="allErrors.requirements" class="alert-danger form-control">{{ allErrors.requirements[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label>   الموقع    </label>
                                            <textarea type="text" class="form-control" v-model="location" placeholder="الموقع " rows="4"></textarea>
                                            <div v-if="allErrors.location" class="alert-danger form-control">{{ allErrors.location[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label>   الخبره   </label>
                                            <textarea type="text" class="form-control" v-model="experience" placeholder="الخبره " rows="4"></textarea>
                                            <div v-if="allErrors.experience" class="alert-danger form-control">{{ allErrors.experience[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label>   الراتب   </label>
                                            <textarea type="text" class="form-control" v-model="salary" placeholder="الراتب " rows="4"></textarea>
                                            <div v-if="allErrors.salary" class="alert-danger form-control">{{ allErrors.salary[0] }}</div>
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


    },
    data() {
        return {
            name: '',
            description:'',
            requirements:'',
            location:'',
            experience:'',
            salary:'',
            allErrors:[],
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
                language:'ar'
            }


        };
    },
    methods: {
        AddJob(){
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('requirements', this.requirements);
            formData.append('location', this.location);
            formData.append('experience', this.experience);
            formData.append('salary', this.salary);
            axios.post('/job', formData, {headers:{'Content-Type': 'multipart/form-data'}})
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
