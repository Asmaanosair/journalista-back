<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                                data-toggle="modal" data-target="#add-contact" >إضافةاقسام  جديده</button>
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

                                    <form class="form-horizontal form-material" @submit.prevent="AddCategory" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name"  id="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>



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
                                <th>  الاسم    </th>
                                <th> تعديل   </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories">

                                <td>
                                    {{category.name}}
                                </td>



                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditCategory(category.id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>

                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteCategory(category.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  الاسم    </th>

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

                                    <form class="form-horizontal form-material" @submit.prevent="UpdateCategory(id)"  enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


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
        this.GetCategories()
    },

    data() {
        return {
            users: '',
            name:'',
            categories:{},
            id: '',
            editName:'',
            allErrors:[],


        };
    },
    methods: {
        GetCategories() {
            axios.get('/sub_category/all' ).then(res => {
                this.categories = res.data
            })
        },
        EditCategory($id){
            this.allErrors=[];
            axios.get('/sub_category/'+$id+'/edit').then(res => {
                this.name=res.data[0].name
                this.id=res.data[0].id
            })
        },
        AddCategory() {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            axios.post('/sub_category', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.GetCategories();
                    self.$swal({
                        text:'تم الاضافه بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                }
            )
        },
        DeleteCategory($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/sub_category/'+$id).then(res => {
                        this.GetCategories()
                    })
                    this.$swal(
                        'تم الحذف بنجاح ',
                    )
                }
            });

        },
        UpdateCategory($id) {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('_method',"PUT")
            axios.post('/sub_category/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(res){
                    self.GetCategories();
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
