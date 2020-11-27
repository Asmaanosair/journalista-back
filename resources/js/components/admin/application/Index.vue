<template>
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>


                        <h4 class="card-title">طلبات التوظيف  </h4>
                        <h6 class="card-subtitle">رؤية جميع طلبات التوظيف</h6>
                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  الوظيفه   </th>

                                <th> حالة الطلب   </th>
                                <th>تعديل </th>
                                                            <th> بيانات المتقدم    </th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="order in allOrders">

                                <td> {{order.name || ''}}</td>


                                <td>
                                <span v-if="order.status==0" class="btn btn-orange  m-t-10 mb-2"
                                >  New  </span>
                                    <span v-else-if="order.status==1" class="btn btn-success  m-t-10 mb-2"
                                    >    Shorted List   </span>
                                    <span v-else-if="order.status==2" class="btn btn-danger  m-t-10 mb-2"
                                    >  Contact   </span>
                                    <span v-else class="btn btn-default  m-t-10 mb-2"
                                    > Rejected   </span>

                                </td>

                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditOrder(order.id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>

                                                            <td class="center"> <button type="button" data-toggle="modal" data-target="#showorder"  @click="ShowOrder(order.user_id)" class="btn btn-danger  m-t-10 mb-2 float-right">  <i class="fa fa-eye"></i>  </button></td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  الوظيفه   </th>
                                <th> حالة الطلب   </th>
                                <th>تعديل </th>
                                                            <th>بيانات المتقدم    </th>
                            </tr>
                            </tfoot>
                        </table>
                        <div id="showorder"  class="modal fade in" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" >    تفاصيل المتقدم للطلب      </h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                    </div>


                                    <div class="modal-body">
                                        <h4>      الاسم  : {{order.name}}</h4>
                                        <h4>       البريد الاليكترونى  : {{order.email}}</h4>
                                        <h4>      رقم الجوال    : {{order.phone_number}}</h4>
                                        <h4>      رقم البطاقه النقابيه    : {{order.card_number}}</h4>


                                    </div>

                                    <div class="modal-footer">


                                        <button type="button" class="btn btn-default waves-effect"
                                                data-dismiss="modal">Cancel</button>

                                    </div>



                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div id="edit-contact"  class="modal fade in" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" >  تعديل حالة الطلب    </h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                    </div>

                                    <form class="form-horizontal form-material" @submit.prevent="UpdateOrder(id)"  enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <!--                                            <div class="col-md-12 m-b-20">-->
                                                <!--                                                <input type="text" class="form-control" v-model="note" placeholder="ملحوظه  ">-->
                                                <!--                                            </div>-->
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label for="exampleFormControlSelect1"> اختر الحاله </label>
                                                        <select class="form-control" id="exampleFormControlSelect" v-model="status">

                                                            <option  v-for="(test,index) in allStatus" :value="index">{{test}}</option>

                                                        </select>
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

        this.GetOrders();

    },
    data() {
        return {
            allOrders:{},
            allStatus:['  New  ',
                '  Shorted List ',
                '  Contact '
                ,' Rejected'],
            status:'',
            order:'',
            id:'',
        };
    },
    methods: {
        GetOrders(){
            axios.get('/applications').then(res => {
                this.allOrders=res.data
                console.log(this.allOrders)
            })
        }
        ,
        EditOrder($id){
            axios.get('/application/'+$id+'/edit').then(res => {
                this.status=res.data.status
                this.id=res.data.id

            })

        },
        ShowOrder($id){
            axios.get('/application/'+$id).then(res => {
                this.order=res.data

            })

        },
        UpdateOrder($id) {
            let self = this;
            let formData = new FormData();
            formData.append('status', this.status);
            formData.append('_method',"PUT")
            axios.post('/application/'+$id, formData)
                .then(function(res){
                    self.GetOrders();
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });

                })
        },
    },
}

</script>
