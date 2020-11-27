<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
            class="mdi mdi-email"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
        </a>
        <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
            <ul class="list-style-none">
                <li>
                    <div class="border-bottom rounded-top py-3 px-4">
                        <h5 class="font-weight-medium mb-0">الاشعارات  </h5>
                    </div>
                </li>
                <li>
                    <div class="message-center message-body position-relative" style="height:250px;">
                        <!-- Message -->
                        <a href="javascript:void(0)" v-for="test in notifications" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                            <span class="user-img position-relative d-inline-block"> <img :src="test.user.image" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle online"></span> </span>
                            <div class="w-75 d-inline-block v-middle pl-2">
                                <h5 class="message-title mb-0 mt-1">{{test.user.name}}</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">{{test.title}}</span> <span class="font-12 text-nowrap d-block text-muted"> {{test.date_time}}</span> </div>
                        </a>

                    </div>
                </li>
                <li>
                    <router-link class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);" :to="{ name: 'all_notification'}"> <b>مشاهده جميع الاشعارات </b> <i class="fa fa-angle-right"></i> </router-link>
                </li>
            </ul>
        </div>
    </li>
</template>



<script>

export default {

    mounted() {
        this.GetNotification()
        this.LoadNotify();
    },

    data() {
        return {
           notifications:{}
        };
    },
    methods: {
        GetNotification() {
            axios.get('/notification' ).then(res => {
                this.notifications= res.data

            })
        },
        LoadNotify(){
            window.Echo.channel('load-notify')
                .listen('HelpEvent',(e) => {
                    this.notifications.push(e.data);

                });
        },





    }


}
</script>

