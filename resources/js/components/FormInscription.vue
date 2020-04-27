<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="card text-center border-0 shadow-sm">
          <form @submit="store">
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
              <div class="form-group">
                <input-file name="birth_certificate" description="Acta de nacimiento"/>
              </div>
              <!-- <div class="form-group">
                <label for="">Acta de nacimiento</label>
                <input type="file" name="birth_certificate" class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="">Boleta de grado actual</label>
                <input type="file" name="current_grade_report_card" class="form-control"value="">
              </div>
              <div class="form-group">
                <label for="">Boleta de grado anterior</label>
                <input type="file" name="previous_grade_report_card" class="form-control"value="">
              </div>
              <div class="form-group">
                <label for="">CURP</label>
                <input type="file" name="curp" class="form-control"value="">
              </div>
              <div class="form-group">
                <label for="">Fotografía del estudiante</label>
                <input type="file" name="pic" class="form-control"value="">
              </div> -->
            </div>
            <div class="card-footer text-muted">
              <button class="btn btn-primary">Guardar</button>
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
