<template>
  <input type="file" name="" value="" class="form-control">
</template>
<script>
  export default{
    props:['name'],
    data(){
      return {
        fileSelected:null
      }
    },
    methods:{
      upload(event){

      }
    }
  }
</script>
