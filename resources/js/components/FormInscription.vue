<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="card text-center border-0 shadow-sm">
          <form @submit.prevent="store">
            <div class="card-header">
              Documentos Digitales
            </div>
            <div class="card-body">
              <div class="form-group">
                <input type="text"
                       placeholder="Nombre Completo Del Alumno"
                       name="name"
                       class="form-control border-0"
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
              <button class="btn btn-primary btn-block">Guardar</button>
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
        name:''
      }
    },
    created(){
      eventBus.$on('onFileSelected',this.attachToForm);
    },
    methods:{
      store(){
        this.formData.append('name',this.name);
        axios({
          method:'POST',
          url:'/files',
          data:this.formData
        }).then((res) => {
          console.log(res)
        }).catch((err) => {
          console.log(err);
        })
      },

      attachToForm(data){
        this.formData.append(data.name,data.file,data.file.name)
      }
    }
  }
</script>
