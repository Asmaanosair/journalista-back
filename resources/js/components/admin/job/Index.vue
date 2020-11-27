<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <router-link v-if="user.role==2"  :to="{name:'createJob'}" type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                        >إضافة وظيفة   جديد</router-link>
                        <!-- Add Contact Popup Model -->

                        <h4 class="card-title">  الوظائف   </h4>
                        <h6 class="card-subtitle">رؤية جميع الوظائف </h6>

                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  عنوان الوظائف       </th>
                                <th> تعديل   </th>
                                <th> مشاهدة   </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="article in articles">

                                <td>
                                    {{article.name||' '}}
                                </td>


                                <td>
                                    <router-link  type="button" class="btn btn-success  m-l-10  m-t-10 mb-2 " :to="{ name: 'editJob',params: { id: article.id }}"> <i class="fa fa-edit"></i> </router-link>
                                </td>

                                <td>
                                    <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 " :to="{ name: 'showJob',params: { id: article.id }}"> <i class="fa fa-eye"></i> </router-link>
                                </td>


                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteJob(article.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  عنوان      </th>
                                <th> تعديل   </th>
                                <th> مشاهدة   </th>
                                <th>حذف  </th>

                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script>

export default {

    mounted() {
        this.GetJobs()
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
            articles:{},
            id: '',
            allErrors:[],
            user:''
        };
    },
    methods: {
        GetJobs() {
            axios.get('/job' ).then(res => {
                this.articles= res.data.data
                this.user= res.data.user
            })
        },
        DeleteJob($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/job/'+$id).then(res => {
                        this.GetJobs()
                    })
                    this.$swal(
                        'تم الحذف بنجاح ',
                    )
                }
            });

        },

    }
}


</script>
