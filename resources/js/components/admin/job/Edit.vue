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
                        <form class="form-horizontal form-material" @submit.prevent="UpdateJob(id)"  enctype="multipart/form-data">
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


import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    mounted() {
        this.GetJob(this.$route.params.id);
    },

    data() {
        return {
            name: '',
            description:'',
            requirements:'',
            location:'',
            id:'',
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
        GetJob($id){
            axios.get('job/'+$id+'/edit').then(res => {
                this.name=res.data.name
                this.description=res.data.description
                this.salary=res.data.salary
                this.location=res.data.location
                this.experience=res.data.experience
                this.requirements=res.data.requirments
                this.id=res.data.id

            })
        },
        UpdateJob($id){
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('salary', this.salary);
            formData.append('location', this.location);
            formData.append('experience', this.experience);
            formData.append('requirements', this.requirements);
            formData.append('_method',"PUT")
            axios.post('/job/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(res){
                    self.GetJob($id);
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function(error){
                self.allErrors = error.response.data.errors
                console.log(self.allErrors)
            });
        },


    },

}
</script>
