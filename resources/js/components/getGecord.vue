<template>
<div>
<button type="button" v-on:click="getLocation" class="btn btn-primary">取得目前位置經緯度(誤差值1000公尺內)</button>

</div>
</template>
<script>
export default {
  data() {
      return {
      map: null
    };
  },
  methods:{
    getLocation() {//取得 經緯度
        if (navigator.geolocation) {//
        navigator.geolocation.getCurrentPosition(showPosition);//有拿到位置就呼叫 showPosition 函式
        } else {
        const m= document.getElementById("msg");
        m.innerHTML = "您的瀏覽器不支援 顯示地理位置 API ，請使用其它瀏覽器開啟 這個網址";
        }
        function showPosition(position) {
        const lo= document.getElementById("longitude");
        const la= document.getElementById("latitude");
        lo.value =position.coords.latitude.toFixed(6);
        la.value=position.coords.longitude.toFixed(6);
        }
    }
  }
}
</script>