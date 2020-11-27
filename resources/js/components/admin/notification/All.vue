<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="Delete()">  <i class="fa fa-trash"></i> حذف جميع الاشعارات   </button>
                        <h4 class="card-title">   الاشعارات  </h4>
                        <h6 class="card-subtitle">رؤية جميع  الاشعارات</h6>

                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th>  تفاصيل المستخدم       </th>
                                <th>  الوقت     </th>
                                <th>الموقع   </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in notifications">

                                <td>
                                    {{item.user.name||' '}}<br>
                                    {{item.user.phone||' '}}<br>
                                    {{item.user.email||' '}}<br>
                                </td>

                                <td>
                                    {{item.date_time}}
                                </td>



                                <td class="center">
                                    <div id="map"></div>
                                 {{item.lat}} :  Latitude    <br>
                                    {{item.long}} : Longitude<br>
                                    <a :href="'https://maps.google.com/?q='+item.lat+','+item.long" target="_blank"> لينك الموقع </a>
                                </td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>  تفاصيل المستخدم       </th>
                                <th>  الموقع    </th>
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
// In this example, we center the map, and add a marker, using a LatLng object
// literal instead of a google.maps.LatLng object. LatLng object literals are
// a convenient way to add a LatLng coordinate and, in most cases, can be used
// in place of a google.maps.LatLng object.
let map;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });
}
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
            axios.get('/notification/all' ).then(res => {
                this.notifications= res.data

            })
        },
        LoadNotify(){
            window.Echo.channel('load-notify')
                .listen('HelpEvent',(e) => {
                    this.notifications.push(e.data);

                });
        },
        Delete(){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.get('/notification/delete').then(res => {
                        this.GetNotification()
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
