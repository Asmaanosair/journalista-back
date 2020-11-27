<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                                data-toggle="modal" data-target="#add-contact" >إضافة منظمة  جديده</button>
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

                                    <form class="form-horizontal form-material" @submit.prevent="AddOrganization" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="activity" placeholder="النشاط ">
                                                    <div v-if="allErrors.activity" class="alert-danger form-control">{{ allErrors.activity[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="email" placeholder="الايميل  ">
                                                    <div v-if="allErrors.email" class="alert-danger form-control">{{ allErrors.email[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="phone" placeholder="رقم الجوال   ">
                                                    <div v-if="allErrors.phone" class="alert-danger form-control">{{ allErrors.phone[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="card" placeholder="رقم السجل  التجارى   ">
                                                    <div v-if="allErrors.card" class="alert-danger form-control">{{ allErrors.card[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="nationality" placeholder="الدوله    ">
                                                    <div v-if="allErrors.nationality" class="alert-danger form-control">{{ allErrors.nationality[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="password" placeholder="كلمة المرور    ">
                                                    <div v-if="allErrors.password" class="alert-danger form-control">{{ allErrors.password[0] }}</div>

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
                        <h4 class="card-title"> المنظمات الاخباريه   </h4>
                        <h6 class="card-subtitle">رؤية جميع المنظمات الاخباريه</h6>

                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  الاسم      </th>
                                <th>  النشاط   </th>
                                <th>  المقالات والاخبار    </th>
                                <th> تعديل   </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="organization in organizations">

                                <td>
                                    {{organization.name||' '}}
                                </td>

                                <td>
                                    {{organization.activity}}
                                </td>
                            <td>
                                <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 " :to="{ name: 'article',params: { id: organization.id }}"> <i class="fa fa-archive"></i> المقالات</router-link>
                                <router-link  type="button" class="btn btn-info   m-l-10  m-t-10 mb-2 " :to="{ name: 'news',params: { id: organization.id }}"> <i class="fa fa-newspaper"></i> الاخبار</router-link>
                            </td>
                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditOrganization(organization.user_id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>

                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeletePost(organization.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  الاسم      </th>
                                <th>  النشاط   </th>
                                <th>  المقالات والاخبار    </th>
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
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="activity" placeholder="النشاط ">
                                                    <div v-if="allErrors.activity" class="alert-danger form-control">{{ allErrors.activity[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="email" placeholder="الايميل  ">
                                                    <div v-if="allErrors.email" class="alert-danger form-control">{{ allErrors.email[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="phone" placeholder="رقم الجوال   ">
                                                    <div v-if="allErrors.phone" class="alert-danger form-control">{{ allErrors.phone[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="card" placeholder="رقم السجل  التجارى   ">
                                                    <div v-if="allErrors.card" class="alert-danger form-control">{{ allErrors.card[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="nationality" placeholder="الدوله    ">
                                                    <div v-if="allErrors.nationality" class="alert-danger form-control">{{ allErrors.nationality[0] }}</div>

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
        this.GetOrganizations()
    },

    data() {
        return {
            nationality:'',
            activity:'',
            email:'',
            card:'',
            name:'',
            phone:'',
            password:'',
            organizations:{},
            id: '',
            allErrors:[],
        };
    },
    methods: {
        GetOrganizations() {
            axios.get('/organization/all' ).then(res => {
                this.organizations= res.data
                console.log(res.data)
            })
        },
        EditOrganization($id){
            this.allErrors=[];
            axios.get('/organization/'+$id+'/edit').then(res => {
                this.name=res.data.name
                this.nationality=res.data.user.nationality
                this.card=res.data.user.card_number
                this.phone=res.data.user.phone_number
                this.id=res.data.user_id
                this.activity=res.data.activity
                this.email=res.data.user.email
                console.log(res.data)
            })
        },
        AddOrganization() {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('nationality', this.nationality);
            formData.append('card', this.card);
            formData.append('phone', this.phone);
            formData.append('activity', this.activity);
            formData.append('email', this.email);
            formData.append('password', this.password);
            axios.post('/organization', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.GetOrganizations();
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
                    axios.delete('/organization/'+$id).then(res => {
                        this.GetOrganizations()
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
            formData.append('nationality', this.nationality);
            formData.append('card', this.card);
            formData.append('phone', this.phone);
            formData.append('activity', this.activity);
            formData.append('email', this.email)
            formData.append('_method',"PUT")
            axios.post('/organization/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(res){
                    self.GetOrganizations();
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
