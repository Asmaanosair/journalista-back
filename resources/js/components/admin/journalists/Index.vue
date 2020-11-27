<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <h4 class="card-title"> الصحفين  </h4>
                        <h6 class="card-subtitle">رؤية جميع الصحفين</h6>
                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  الاسم ورقم الجوال  </th>
                                <th>  الجنسيه   </th>
                                <th>    رقم البطاقه النقابيه    </th>
                                <th>اضافه او حظر  </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users">

                                <td>
                                    <li>{{user.name}}</li>
                                    <li>{{user.phone_number}}</li>


                                </td>
                                <td>

                                        <li>{{user.email}}</li>
                                        <li>{{user.nationality}}</li>



                                </td>
                                <td>
                                    {{user.card_number}}



                                </td>

                                <td>
                                    <span v-if="user.status==0" >
                                       <span v-on:click="ChangeStatus(user.id,1)" class="btn btn-success   m-t-10 mb-2"
                                       >   قبول     </span>
                                    <span class="btn btn-danger  m-t-10 mb-2" v-on:click="ChangeStatus(user.id,2)"
                                    >   حظر   </span>
                                    </span>
                                    <span v-else-if="user.status==1">
                                         <span class="btn btn-danger  m-t-10 mb-2" v-on:click="ChangeStatus(user.id,2)"
                                         >   حظر   </span>
                                        <span  class="btn btn-warning   m-t-10 mb-2"
                                        >  تمت الاضافه        </span>
                                    </span>
                                    <span v-else>

                                    <span class="btn btn-dark-info  m-t-10 mb-2" v-on:click="ChangeStatus(user.id,1)"
                                    >  رفع  الحظر   </span>
                                              </span>
                                </td>

                                <td class="center">
                                    <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="Delete(user.id)">  <i class="fa fa-trash"></i>  </button>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  الاسم ورقم الجوال  </th>
                                <th>  الجنسيه   </th>
                                <th>    رقم البطاقه النقابيه    </th>
                                <th>اضافه او حظر  </th>
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
        this.GetUsers()
    },

    data() {
        return {
            users: ''


        };
    },
    methods: {
        GetUsers() {
            axios.get('/journalist' ).then(res => {
                this.users = res.data
            })
        },
        LoadOrders(){
            window.Echo.channel('load-users')
                .listen('OrderEvent', (e) => {
                    this.users.push(e.users);
                    console.log('tets pusher')
                });
        },
        ChangeStatus($id,$status) {
            let self = this;
            axios.get('/journalist/'+ $id+'/'+$status).then(function(res){
                    self.GetUsers();
                    self.$swal({
                        text:res.data,
                        icon: "success",
                    });
                })
        },
        Delete($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.get('/journalist/'+$id).then(res => {
                        this.GetUsers()
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
