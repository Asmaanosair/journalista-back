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
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"> الوظيفه  </h3>
                        <h6 class="card-subtitle">{{article.name}}</h6>
                        <div class="row">

                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title mt-5">وصف مبسط </h4>
                                <p>{{article.description}}</p>

                            </div>
                            <div class="col-12">
                                <h4 class="box-title mt-5"> المتطلبات </h4>

                                   <span v-html="article.requirments" ></span>


                            </div>
                            <div class="col-lg-12 ">
                                <h4 class="box-title mt-5"> الراتب </h4>
                                <p>{{article.salary}}</p>

                            </div>
                            <div class="col-lg-12 col-md-9 col-sm-6">
                                <h4 class="box-title mt-5"> الخبره </h4>
                                <p>{{article.experience}}</p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

    </div>


    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->


</template>
<script>

export default {
    mounted() {
        this.GetArticle(this.$route.params.id);
    },
    data() {
        return {
            article:{},

        };
    },

    methods: {
        GetArticle($id){
            axios.get('job/'+$id+'/edit').then(res => {
                this.article=res.data

            })
        },
    },

}


</script>
