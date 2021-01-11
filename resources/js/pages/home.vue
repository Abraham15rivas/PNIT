<template>
<mdb-container>
    <vue-good-table
      :columns="columns"
      :rows="registered"
      :fixed-header="true"
      :search-options="{ enabled: true }"
      @on-row-click="getUser"
      :pagination-options="{
        enabled: true,
        mode: 'pages',
        perPage: 10,
        perPageDropdown: [20, 30, 50],
        dropdownAllowAll: false,
        setCurrentPage: 2,
        nextLabel: 'Sieguiente',
        prevLabel: 'Anterior',
        rowsPerPageLabel: 'Filas por pagina',
        ofLabel: 'de',
        pageLabel: 'Pagina', 
        allLabel: 'Todo',
      }"/>

    <mdb-modal size="lg" :show="modal" @close="modal = false" v-for="(inv, index) in investigador" :key="index">
      <mdb-modal-header>
        <mdb-modal-title>
          {{inv.IDENTIFICADOR}} - {{inv.NOMBRES}} {{inv.APELLIDOS}} 
        </mdb-modal-title>
      </mdb-modal-header>
      <mdb-modal-body>
        <div v-if="inv.PROPUESTA == 'NO'">
            <h2 class="text-center">No registró una propuesta</h2>
        </div>
        <div v-else>       
          <mdb-row class="align-items-center">
            <mdb-col col="2" class="strong">Contacto:</mdb-col>
            <mdb-col col="3" v-if="inv.CELULAR == null" class="red-text">Sin telefono</mdb-col>
            <mdb-col col="3" v-else> <img src="icons/phone.svg"> {{inv.CELULAR}}</mdb-col>      
            <mdb-col col="7"> <span style="font-size: 15px"> <img src="icons/email.svg"> {{inv.CORREO}}</span></mdb-col>
            <hr>
          </mdb-row>
          <hr>
          <mdb-row class="align-items-center" >            
            <mdb-col col="6">
              <span class="strong">Estado:</span> 
              <span v-if="inv.ESTADO">{{inv.ESTADO}}</span> <span v-else class="red-text">Sin Estado</span>
            </mdb-col>      
            <mdb-col col="6">
              <span class="strong">Municipio:</span> 
              <span v-if="inv.MUNICIPIO">{{inv.MUNICIPIO}}</span> <span v-else class="red-text">Sin Estado</span>
            </mdb-col>
          </mdb-row>
          <hr>          
          <mdb-row class="align-items-center">
            <mdb-col col="4"><span class="strong">Especialidad:</span> {{inv.ESPECIALIDAD}}</mdb-col>
            <mdb-col col="4"><span class="strong">Area:</span> {{inv.AREA}}</mdb-col>
            <mdb-col col="4"><span class="strong">Sub area:</span> {{inv.SubArea}}</mdb-col>
          </mdb-row>
          <hr>
          <mdb-row class="align-items-center">
            <mdb-col col="6"><span class="strong">Destino:</span> {{inv.DESTINO}}</mdb-col>
            <mdb-col col="6"><span class="strong">Estatus:</span> {{inv.ESTATUS}}</mdb-col>
          </mdb-row>
          <hr>
          <mdb-row class="align-items-center">
            <mdb-col col="6"><span class="strong">Motor:</span> {{inv.MOTOR}}</mdb-col>
            <mdb-col col="6">
              <span class="strong">Linea:</span> 
              <span v-if="inv.LineInv">{{inv.LineInv}}</span>
              <span v-else class="red-text">Sin línea de investigación</span>
              
            </mdb-col>
          </mdb-row>
          <hr>
          <mdb-row class="align-items-center">
            <mdb-col col="12"><span class="strong">Resumen:</span> {{inv.RESUMEN}}</mdb-col>
          </mdb-row>
        </div>
      </mdb-modal-body>
      <mdb-modal-footer>
        <mdb-btn color="primary" block @click.native="modal = false">Cerrar</mdb-btn>
      </mdb-modal-footer>
    </mdb-modal>
  </mdb-container>
</template>
<script>
  import { mdbContainer, mdbRow, mdbCol, mdbModal, mdbModalHeader, mdbModalTitle, mdbModalBody, mdbModalFooter, mdbBtn } from 'mdbvue';
  export default {
    components: {
      mdbContainer, mdbModal, mdbRow, mdbCol, mdbModalHeader, mdbModalTitle, mdbModalBody, mdbModalFooter, mdbBtn
    },
    data() {
      return {
        registered: {},
        investigador: {},
        modal: false,
        columns: [
          { label: '#', field: 'ID' },
          { label: 'Nombres', field: 'NOMBRES' },
          { label: 'Apellidos', field: 'APELLIDOS' },
          { label: 'Cedula', field: 'IDENTIFICADOR' },
          { label: 'Correo', field: 'CORREO' },
          { label: 'Propuesta', field: 'PROPUESTA' },
          { label: 'Tipo de propuesta', field: 'TIPO DE PROPUESTA' }, 
        ],   
      }
    },
    methods: {
      getRegistered(){
        const url = 'api/registrados'
        axios.get(url)
          .then( res => {
            this.registered = res.data
          })
      },
      getUser(params) {
        this.modal = true;
        let idUser = params.row.ID;
        const url = 'api/investigador/'+idUser;  

        axios.get(url)
          .then(res => {
            this.investigador = res.data
          })
      }
    },
    mounted() {
      this.getRegistered();
    },
  }
</script>
<style scoped>
  .strong{
    font-weight: bold;
  }
</style>