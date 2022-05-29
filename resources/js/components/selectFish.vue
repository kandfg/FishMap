<template>
<div class="input-group mb-3">
  <span class="input-group-text" id="inputGroup-sizing-default">選擇科名</span>
  <select class="form-select" aria-label="Default select example" v-model="selclass" id="selectclass" name="class_id">
          <option :value="cla.id" v-for="(cla, index) in fishdata.data.class" :key="index">{{cla.section_name}}</option>
  </select>
  <span class="input-group-text" id="inputGroup-sizing-default">選擇魚類</span>
  <select class="form-select" aria-label="Default select example" v-model="selfish" id="selectfish" name="fish_id">
      <option :value="cla.id" v-for="(cla, index) in fishdata.data.class[this.selclass-1].fishs" :key="index">{{cla.name}}</option>
  </select>
</div>
</template>
<script>
export default {
  data() {
    return {
      selclass:1,
      selfish:0,
      fishdata: {
        data:{
          class:[
            {
              fishs:[
              "id",
              "name"
              ],
              id:0,
              section_name:''
            },
          ],
        }
      }
    };
  },
  methods:{
    async loadData() {
      await axios
      .get('http://localhost:8000/get-fish')
      .then(response => (this.fishdata = response))
      .catch(function (error) { // 请求失败处理
        console.log(error);
      });
    },
    
  },
  mounted() {
    this.loadData();
  }
}
</script>