<div class="modal" :class="{'is-active' : modalGeneral}">
    <div class="modal-background"></div>
    <div class="modal-content">
         <div class="content">
              <h3 class="text-center">@{{titleModal}}</h3>
              <div class="field">
                   <label class="label">@{{messageModal}}</label>
                   <p class="control" v-if="modalDeparture!=0">
                   <input class="input" placeholder="Departamento" v-model="titleDeparture" readonly
                             v-if="modalDeparture==3">
                  </p>
                  <div v-show="errorTitleDeparture" class="columns text-center">
                      <div class="column text-center text-danger">
                          El nombre del Departamento no puede estar vacio
                      </div>
                  </div>
                  <div class="columns button-content">
                      <div class="column">
                          <a class="button is-success" @click="createDeparture()" v-if="modalDeparture==1">Aceptar</a>
                          <a class="button is-success" @click="destroyDeparture()" v-if="modalDeparture==3">Aceptar</a>
                      </div>
                      <div class="column">
                          <a class="button is-danger" @click="closeModal()">Cancelar</a>
                      </div>
                  </div>
            </div>
       </div>
       <button class="modal-close" @click="closeModal()"></button>
   </div>
</div>