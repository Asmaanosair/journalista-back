<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <router-link v-if="user.role==2"   :to="{name:'createArticle'}" type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                        >إضافة مقال   جديد</router-link>
                        <!-- Add Contact Popup Model -->

                        <h4 class="card-title">  المقالات   </h4>
                        <h6 class="card-subtitle">رؤية جميع المقالات </h6>

                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  عنوان المقال       </th>
                                <th> تعديل   </th>
                                <th> مشاهدة   </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="article in articles">

                                <td>
                                    {{article.title||' '}}
                                </td>


                                <td>
                                    <router-link  type="button" class="btn btn-success  m-l-10  m-t-10 mb-2 " :to="{ name: 'editArticle',params: { id: article.id }}"> <i class="fa fa-edit"></i> المقالات</router-link>
                                </td>

                                <td>
                                    <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 " :to="{ name: 'showArticle',params: { id: article.id }}"> <i class="fa fa-eye"></i> </router-link>
                                </td>


                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeletePost(article.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  عنوان المقال      </th>
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
        this.GetArticles(this.$route.params.id)
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
            user:""
        };
    },
    methods: {
        GetArticles($id) {
            axios.get('/article/'+$id ).then(res => {
                this.articles= res.data.data
                this.user= res.data.user
            })
        },
        DeletePost($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/article/'+$id).then(res => {
                        this.GetArticles()
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
