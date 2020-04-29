<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-xs-12 col-sm-12">
        <div v-if="downloads.length" class="card border-0 shadow-sm my-4">
          <p class="text-monospace text-bold text-center my-4">{{name}}</p>
          <ul>
            <li v-for="download in downloads">
              <a :href="'/files/'+download.path">Descargar {{download.path.split('/')[0]}}</a>
            </li>
          </ul>
        </div>
        <div v-if="files.length" class="my-4">
          <ul class="list-group">
            <li v-for="(file,index) in files" class="list-group-item d-flex justify-content-between">
              <div class="">
                {{file.name}}
              </div>
              <button type="button" class="close" aria-label="Close" @click="deleteItem(index)">
                <span aria-hidden="true">&times;</span>
              </button>
          </li>
          </ul>
        </div>
        <div class="card text-center border-0 shadow-sm">
          <form @submit.prevent="store" id="form-inscription">
            <div class="card-header">
              Documentos Digitales
            </div>
            <div class="card-body">
              <div class="form-group">
                <input type="text"
                       placeholder="Ingresa El Nombre Completo Del Alumno"
                       name="name"
                       id="name"
                       class="form-control  text-center"
                       v-model="name">
              </div>
              <div class="d-flex justify-content-center flex-wrap">
                <div class="form-group mr-1">
                  <input-file name="birth_certificate" description="Acta de nacimiento"/>
                </div>
                <div class="form-group mr-1">
                  <input-file name="current_grade_report_card" description="Boleta de grado actual"/>
                </div>
                <div class="form-group mr-1">
                  <input-file name="previous_grade_report_card" description="Boleta de grado anterior"/>
                </div>
                <div class="form-group mr-1">
                  <input-file name="curp" description="CURP"/>
                </div>
                <div class="form-group">
                  <input-file name="pic" description="Fotografía del alumno"/>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <button class="btn btn-primary btn-block">
                <template v-if="!load">
                  Subir
                </template>
                <template v-else>
                  Cargando...
                </template>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default{
    data(){
      return {
        selectedFile:null,
        formData:new FormData(),
        name:'',
        files:[],
        downloads:[],
        load:false
      }
    },
    created(){
      eventBus.$on('onFileSelected',this.attachToForm);
    },
    methods:{
      store(){
        this.formData.append('name',this.name);
        this.load = true;
        axios({
          method:'POST',
          url:'/files',
          data:this.formData
        }).then((res) => {
          if(res.data.length){
            this.files = [];
            document.getElementById('form-inscription').reset();
            this.downloads = res.data;

          }
          this.load = false;
        }).catch((err) => {
            this.load = false;
        })
      },

      attachToForm(data){
        this.formData.append(data.name,data.file,data.file.name)
        var file = this.files.find(file=>file.input===data.name)
        var index = this.files.indexOf(file);

        if(index != -1)
          return Vue.set(this.files[index],'name',data.file.name);
        return this.files.push({name:data.file.name,input:data.name})
      },
       deleteItem(index){

        document.getElementById(this.files[index].input).value='';
        this.files.splice(index,1);
      }
    }
  }
</script>
<style media="screen">
  #name::placeholder{
    text-align:center;
  }
</style>
