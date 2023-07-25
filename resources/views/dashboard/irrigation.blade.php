@push('styles')
    <style>
        .blurtext{
            color: transparent;
            text-shadow: 0 0 5px rgba(0,0,0, 0.5);

        }
    </style>
@endpush

    <x-form.card col='row col-12'>

        <div class="col-lg-4 ">
            <!--begin::Budget-->
            <div class="card h-100 shadow ">
                <div class="card-body">
                    <span class="card-label fs-3 mb-1" style="color:#5EC267;">Les Mesure De Quantification</span>

                    <x-form.form
                        method="post"
                    >

                        <x-form.select
                            name="idquantification" id="idquantification"  label="Quantification" col="col-12" required
                            :bind-with="[\App\Models\Qualifications::all(),['idQT','titre'] ]" />

                        <input type="hidden" name="idculture" id="idculture" value="1">
                        <div class="separator separator-dashed"></div>

                        <x-form.input required col="col-lg-6 col-ms-12" name="mesure" id="mesure" type="number" step="0.1" label="Mesure" />
                        <x-form.input-date required col="col-lg-6 col-ms-12" name="date" id="date" label="date" />

                        <x-form.input col="col-12" name="unite" class="unite"
                                      label="Unite de mesure" />

                        <div class="row mt-5">
                            <div class="col-6">
                                <button type="button" class="btn btn-success saveMesure">Enregistre</button>
                            </div>
                            <div class="col-6">
                                <button type="reset" class="btn btn-warning">Vide</button>
                            </div>
                        </div>

                    </x-form.form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <!--begin::Budget-->
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="card-label fs-3 mb-1" style="color:#5EC267;">Variable Intermédiaire Scientifique</div>
                    <div class="m-10"></div>

                    <div class="fs-6 row mb-4">
                        <div  class="fw-bold col-8 blurtext">Variable 1</div>
                        <div id="idteckAgr" name="idteckAgr" class="d-flex fw-bolder col-4 blurtext">07/97</div>
                    </div>
                    <div class="m-5"></div>
                    <div class="separator separator-dashed"></div>

                    <div class="fs-6 row mb-4">
                        <div  class="fw-bold col-8 blurtext">Variable 1</div>
                        <div id="idteckAgr" name="idteckAgr" class="d-flex fw-bolder col-4 blurtext">ASDWE</div>
                    </div>
                    <div class="m-5"></div>
                    <div class="separator separator-dashed"></div>

                    <div class="fs-6 row mb-4">
                        <div  class="fw-bold col-8 blurtext">Variable 1</div>
                        <div id="idteckAgr" name="idteckAgr" class="d-flex fw-bolder col-4 blurtext">53</div>
                    </div>
                    <div class="m-5"></div>
                    <div class="separator separator-dashed"></div>

                    <div class="fs-6 row mb-4">
                        <div  class="fw-bold col-8 blurtext">Variable 1</div>
                        <div id="idteckAgr" name="idteckAgr" class="d-flex fw-bolder col-4 blurtext">334 CM</div>
                    </div>
                    <div class="m-5"></div>
                    <div class="separator separator-dashed"></div>

                    <div class="fs-6 row mb-4">
                        <div  class="fw-bold col-8 blurtext">Variable 1</div>
                        <div id="idteckAgr" name="idteckAgr" class="d-flex fw-bolder col-4 blurtext">1009.4 $</div>
                    </div>
                    <div class="m-5"></div>
                    <div class="separator separator-dashed"></div>
                    <div class="m-5"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <span class="card-label fs-3 mb-1" style="color:#5EC267;">Variable de l'Irrigation</span>
                    <div class="m-10"></div>

                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fs-3 mb-1 d-block">Besoin en Eau</span>
                        <span class="text-muted mt-1 fw-bold fs-7">50 m³/ha</span>
                    </h3>
                    <div class="m-5"></div><div class="separator separator-dashed"></div>
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fs-3 mb-1 d-block">Fréquence d'Irrigation</span>
                        <span class="text-muted mt-1 fw-bold fs-7">3 fois/semaine</span>
                    </h3>

                    <div class="m-5"></div>
                    <div class="separator separator-dashed"></div>

                    <x-form.select
                        name="idTechSpe" id="idTechSpe" label="techniques specifiques" col="col-12" 
                        required
                        :bind-with="[\App\Models\TechniqueSpecifique::all(),['idTS' ,  'titre'] ]" />

                    <label for="">description</label>
                    <textarea name="" id="desc" class="form-control"  ></textarea>
                </div>
            </div>
        </div>

    </x-form.card>

@push('scripts')

    <script>



        document.addEventListener('DOMContentLoaded' , function (){

            rempleirInputUnite() ;

        })
        $('#idquantification').on('change' , function(){

            rempleirInputUnite() ;


        })


        function rempleirInputUnite(){
            $.ajax({
                url: "{{ route('dashboard.getUnite') }}",
                type: 'post',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'idQ': $('#idquantification').val(),
                },

                success: function ({data}) {

                  
                    $('.unite').val(data.unite) ;

                },
            });
        }


        $(".saveMesure").on('click', function () {
        

            $.ajax({
                url: "{{ route('dashboard.store') }}",
                type: 'post',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'idquantification': $('[name=idquantification]').val(),
                    'mesure': $('[name=mesure]').val(),
                    'date': $('[name=date]').val(),
                    'idculture': localStorage.getItem('idCP')
                },
                success: function (message,errors) {
                    console.log(errors)
                    console.log(message)

                    $('#mesure').val('');
                    $('#date').val('');

                        Swal.fire({
                            title: "complété",
                            text: "les Mesures de qualification a été ajouté avec succès",
                            type: "success",
                            confirmButtonText: 'OK',
                            padding: '2em'
                        });

                },
                error:function(err){
                    console.log(err)
                }
            });
        });

        document.addEventListener('DOMContentLoaded' , function (){

            rempleirInputUnite() ;

        })
        $('#idTechSpe').on('change' , function(){

            rempleirInputUnite2() ;


        })


        function rempleirInputUnite2(){
            $.ajax({
                url: "{{ route('dashboard.storeTS') }}",
                type: 'post',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'idTS': $('#idTechSpe').val(),
                },

                success: function ({data}) {
      

                    $('#desc').val(data.description) ;

                },
            });
        }

    </script>
@endpush
