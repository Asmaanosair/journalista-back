<template>
<div class="container-fluid">

    <div class="row">
        <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"> <i class="fas fa-users"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">عدد الصحفين </h3>
                            <h6 class="card-subtitle text-white op-5"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">{{users}}  </h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
         <!-- Column -->
        <div class="col-lg-6 col-md-12" >
            <div class="card " style="background:#4cd137  ;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"> <i class="fas fa-building"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">عدد المنظمات </h3>
                            <h6 class="card-subtitle text-white op-5"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">{{organizations}}  </h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->

             <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="card " style=" background: #ff3838;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"> <i class="far fa-clipboard"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">عدد المقالات </h3>
                            <h6 class="card-subtitle text-white op-5"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">{{articles}}  </h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
             <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="card " style="background:#E91E63">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"><i class="fas fa-user-md"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">عدد الوظائف </h3>
                            <h6 class="card-subtitle text-white op-5"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">{{jobs}}  </h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->

             <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="card " style="background:#FF6F00">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"><i class="fas fa-file-pdf"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">عدد طلبات الوظائف </h3>
                            <h6 class="card-subtitle text-white op-5"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">{{$jobApplications}}  </h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->

             <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="card" style="background:#2653b3">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"><i class="far fa-newspaper"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">عدد الاخبار </h3>
                            <h6 class="card-subtitle text-white op-5"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">{{news}}  </h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->

        <!-- Column -->
        <div class="col-lg-6 col-md-12">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"><i class="icon-cloud-download"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">Download count</h3>
                            <h6 class="card-subtitle text-white op-5">March 2020</h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap text-truncate">35487</h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 text-right">
                            <div class="spark-count" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- Row -->

</div>
</template>
<script>

export default {

    mounted() {
        this.GetData()
    },

    data() {
        return {
            users: '',
            organizations:'',
            articles:'',
            news:'',
            jobs:'',
            jobApplications:''


        };
    },
    methods: {
        GetData() {
            axios.get('/showData' ).then(res => {
                this.users = res.data.users
                this.organizations = res.data.organizations
                this.articles = res.data.articles
                this.news = res.data.news,
                this.jobs = res.data.jobs,
                this.jobApplications = res.data.job_applications
            })
        },




    }
}


</script>
