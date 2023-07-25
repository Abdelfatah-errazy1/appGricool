<x-form.card col='row col-12'>
 
    <x-form.select
     name="fermeSelect"  label="Ferme" col="col-12 col-md-4"
  :bind-with="[\App\Models\Ferme::all(),['idF' ,  'nomDomaine'] ]" />

  <x-form.select
   name="parcelleSelect"  label="parcelle" col="col-12 col-md-4"
  :bind-with="[\App\Models\Parcelle::all(),['idp' ,  'codification'] ]" />

  <x-form.select 
  name="cultureSelect"  label="culture" col="col-12 col-md-4"
  :bind-with="[$varietes,['idV' ,  'nomCommercial'] ]" /> 

  <div class="col-lg-6 col-xxl-4">
    <!--begin::Budget-->
    <div class="card h-100 shadow mt-5">
      <div class="card-body p-9 row">
        <div class="fs-2hx fw-bolder text-center mb-2" style="color:#5EC267">Variete</div>

        <div class="fs-6 mb-2  col-6 d-flex flex-column ">
          <div  class="fw-bold mt-3">Nom Commerciale</div>
          <div id="nomComerciale" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
  
        <div class="fs-6 mb-2  col-6 d-flex flex-column">
          <div class="fw-bold mt-3">Espece</div>
          <div id="espece" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
  
        <div class="fs-6 mb-2  col-6 d-flex flex-column">
          <div class="fw-bold mt-3">Appelation Arrab</div>
          <div id="appelation" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
  
        <div class="fs-6 mb-2  col-6 d-flex flex-column">
          <div class="fw-bold mt-3">Precocite</div>
          <div id="precocite" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >resistance</div>
        </div>
        
        
        <div class="fs-6 mb-2  col-6 d-flex flex-column">
          <div class="fw-bold mt-3">Resistance</div>
          <div id="resistance" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
        
        
        <div class="fs-6 mb-2  col-6 d-flex flex-column">
          <div class="fw-bold mt-3">Comptitivite</div>
          <div id="comptitivite" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
        <div class="fs-6 mb-2  col-12 d-flex flex-column">
          <div class="fw-bold mt-3">Qualite</div>
          <div id="quantite" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
  
  
        <div class="fs-6 mb-2  col-12 d-flex flex-column">
          <div class="fw-bold mt-3">Description</div>
          <div id="description" class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >$6,570</div>
        </div>
  
        <div class="fs-6 d-flex justify-content-end">
         @include('dashboard.modal')
         
        </div>
      </div>
    </div>
    <!--end::Budget-->
  </div>
  <div class="col-lg-6 col-xxl-4">
    <!--begin::Budget-->
    <div class="card h-100 shadow mt-5">
      <div  class="card-body p-9">
        <div class="fs-2hx fw-bolder text-center mb-2" style="color:#5EC267">Stade</div>
      
        <div id="stadeContainer" class="row">

        </div>
        
      </div>
    </div>
    <!--end::Budget-->
  </div>
</x-form.card>
<span name="varietes" data-varietes="{{ $varietes }}" ></span>
<span name="ferme" data-ferme="{{ (\App\Models\Ferme::all()) }}" ></span>
<span name="parcelle" data-parcelle="{{ (\App\Models\Parcelle::all()) }}" ></span>
<span name="cultureParcelle" data-cultureParcelle="{{ (\App\Models\CultureParcelle::all()) }}" ></span>

@push('scripts')

  <script>
      
      var fermes=document.getElementById('fermeSelect')
      var parcelles=document.getElementById('parcelleSelect')
      var cultures=document.getElementById('cultureSelect')

      var nomComerciale=document.getElementById('nomComerciale')
      var espece=document.getElementById('espece')
      var appelation=document.getElementById('appelation')
      var quantite=document.getElementById('quantite')
      var precocite=document.getElementById('precocite')
      var resistance=document.getElementById('resistance')
      var comptitivite=document.getElementById('comptitivite')
      var description=document.getElementById('description')

      var stadeContainer=document.getElementById('stadeContainer')
   
      var dataF = JSON.parse(document.getElementsByName('ferme')[0].getAttribute('data-ferme'));
      var dateP = JSON.parse(document.getElementsByName('parcelle')[0].getAttribute('data-parcelle'));
      var dataV = JSON.parse(document.getElementsByName('varietes')[0].getAttribute('data-varietes'));
      var dataCP = JSON.parse(document.getElementsByName('cultureParcelle')[0].getAttribute('data-cultureParcelle'));

      document.addEventListener('DOMContentLoaded', ()=> {
        getFermes()
        getParcelles()
        
        
      });
    

      fermes.onchange=()=> getParcelles()
        
      parcelles.onchange=()=>getVarietes()
      cultures.onchange=()=>desplay()
    

      function  getParcelles(){
          parcelles.innerHTML = '';
          dateP.forEach(parcel => {
              if (parcel.Ferme==fermes.value) {
                  const option = document.createElement('option');
                  option.value = parcel.idp;
                  option.text = parcel.codification;
                  parcelles.appendChild(option);
              }
          });
          getVarietes()
      }
      function  getFermes(){
          fermes.innerHTML = '';
          dataF.forEach(fer => {
                  const option = document.createElement('option');
                  option.value = fer.idF;
                  option.text = fer.nomDomaine;
                  fermes.appendChild(option);
              
          });
      }
      function  getVarietes(){
        cultures.innerHTML = '';
        
          const varPar=  dataCP.filter((ele)=>ele.parcelleId==parcelles.value ).map(ele=>ele.varieteID)
        
          dataV.forEach(v => {
            if(varPar.includes(v.idV)){
                const option = document.createElement('option');
                  option.value = v.idV;
                  option.text = v.nomCommercial;
                  cultures.appendChild(option);
            }
                
          });
          desplay()
      }
      function  desplay(){
          var variete=dataV.find(ele=>ele.idV==cultures.value)
          if(variete){
            getIdCulture()
            localStorage.setItem('vart', variete.nomCommercial);

            nomComerciale.innerHTML= variete.nomCommercial 
            espece.innerHTML= variete.espece
            appelation.innerHTML= variete.appelationAr
            quantite.innerHTML= variete.quantite
            precocite.innerHTML= variete.precocite
            resistance.innerHTML= variete.resistance
            comptitivite.innerHTML= variete.competitivite
            description.innerHTML= variete.description
            getStade(variete.idV)
          }else{
            nomComerciale.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            espece.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            appelation.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            quantite.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            precocite.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            resistance.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            comptitivite.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            description.innerHTML= '<span class="badge text-center badge-danger ">vide</span>'
            getStade(0)
          }

       function getIdCulture(){
        var idCP=dataCP.find(ele=>ele.parcelleId==parcelles.value && ele.varieteID==cultures.value)
        localStorage.setItem('idCP', idCP.id);

       }
        
        
        
      }


      function getStade(id){
        switch (id) {
          case 1:
          
          stadeContainer.innerHTML =  `
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Nom </div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >Germination</div>
                </div> 
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Espece</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >blé</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Phase Fin</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >premières pousses vertes</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Description</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >premières pousses vertes</div>
                </div> 
                
                
                           `      
                break;
          case 2:
          
          stadeContainer.innerHTML =  `
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Nom </div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >Émergence</div>
                </div> 
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Espece</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >blé</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Phase Fin</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >feuilles primaires sont complètement déployées.
</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Description</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >feuilles primaires sont complètement déployées.
</div>
                </div> 
                
                
                           `      
                break;
          case 3:
          
          stadeContainer.innerHTML =  `
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Nom </div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >Tallage</div>
                </div> 
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Espece</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >blé</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Phase Fin</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >formant de nouvelles tiges à partir de la base principale
</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Description</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >formant de nouvelles tiges à partir de la base principale
</div>
                </div> 
                
                
                           `      
                break;
          case 4:
          
          stadeContainer.innerHTML =  `
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Nom </div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >Épiaison</div>
                </div> 
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Espece</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >blé</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Phase Fin</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >formant des fleurs à partir de la tige principale
</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Description</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >formant des fleurs à partir de la tige principale
</div>
                </div> 
                
                
                           `      
                break;
          case 5:
          
          stadeContainer.innerHTML =  `
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Nom </div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >Floraison</div>
                </div> 
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Espece</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >blé</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Phase Fin</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >la formation des grains de blé commenc
</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Description</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >la formation des grains de blé commenc
</div>
                </div> 
                
                
                           `      
                break;
          case 6:
          
          stadeContainer.innerHTML =  `
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Nom </div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >Maturation</div>
                </div> 
                <div class="fs-6 mb-2  col-6 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Espece</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >blé</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Phase Fin</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >les grains ont durci et pris une couleur dorée ou brune</div>
                </div> 
                <div class="fs-6 mb-2  col-12 d-flex flex-column ">
                  <div  class="fw-bold mt-3">Description</div>
                  <div  class="d-flex fw-semibold  border border-secondry p-2 mt-1 rounded-1  bg-body-tertiary" >les grains ont durci et pris une couleur dorée ou brune</div>
                </div> 
                
                
                           `      
                break;
    
                                }
                            }

  </script>
@endpush










