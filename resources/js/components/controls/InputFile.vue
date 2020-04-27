<template>
  <div>
      <input type="file"
             :name="name"
             @change="onFileSelected"
             class="form-control"
             ref="inputFile"
             style="display:none">
      <button type="button"
              class="btn btn-outline-secondary"
              @click="$refs.inputFile.click()">
              {{description}}
      </button>
  </div>

</template>
<script>
  export default{
    props:['name','description'],
    data(){
      return {
        fileSelected:null
      }
    },
    methods:{
      onFileSelected(event){
        let obj = new Object();
        obj.file = this.fileSelected = event.target.files[0];
        obj.name = this.name;
        eventBus.$emit('onFileSelected',obj);
      }
    }
  }
</script>
