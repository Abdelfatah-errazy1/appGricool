@extends('layout.master')
@section('page_title' , trans('pages/clients.index_page_title'))


@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush
@section('content')

    <div class="col-md-12">
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_6_1" aria-expanded="true">
                <!--begin::Icon-->
                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                    <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                            <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon toggle-off svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Icon-->
                <!--begin::Title-->
                <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Execution Technique</h4>
                <!--end::Title-->
            </div>
            <!--end::Heading-->
            <!--begin::Body-->
            <div id="kt_job_6_1" class="fs-6 ms-1 collapse show" style="">
                <x-form.form method="post">
                    <x-form.card col="col-12 row" title="ExecutionTechnique">


                        <x-form.select col="col-4" required name="techniqueagricole" label="Technique Agricole"
                        :bind-with="[\App\Models\TechniqueAgricole::all(),['idTA' ,  'titre']]" />

                        <x-form.select col="col-4" required name="techniquespecifique" label="Technique Specifique"/>

                        <x-form.select col="col-4" required name="modetechnique" label="Mode Technique"/>
 
                        <x-form.input col="col-4" value="John" required name="culture" readonly  label="culture"/>
 
                        <x-form.input col="col-4" required type="number" min='0' step="0.5"  name="quantification" label="quantification"/>

                        <div class="col-4">
                            <label for="" class="form-label">Select date and time</label>
                            <input class="form-control form-control-solid" name="date"  placeholder="Pick date & time" id="dateEx"/>
                        </div>

                        <x-form.text-area col="col-12" name="observation" label="observation" />
                            <div class="col-12 mt-5">
                                <div class="mt-2">
                                    <button type="button" id="save-data" class="app-button  btn btn-primary">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                    </x-form.card>

                </x-form.form>

                <div class="card mt-5">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table id="kt_datatable_example_1" class="table table-row-bordered table-striped gy-7 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                    <th>techniquespecifique</th>
                                    <th>modetechnique</th>
                                   
                                    <th>quantification</th>
                                    <th>date</th>
                                    <th>observation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>

            </div>
            <!--end::Content-->
            <!--begin::Separator-->
            <div class="separator separator-dashed"></div>
            <!--end::Separator-->
        </div>

    </div>
@endsection


@push('scripts')
<script src="http://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>


        let table = new DataTable('#kt_datatable_example_1');
        $("#dateEx").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });


        let techniqueagricoleSelect  = $('[name=techniqueagricole]');
        let techniquespecifiqueSelect  = $('[name=techniquespecifique]');
        let modetechniqueSelect  = $('[name=modetechnique]');
        let cultureEl  = $('[name=culture]');
        let quantificationEl  = $('[name=quantification]');
        let dateEl  = $('[name=date]');
        let observationEl  = $('[name=observation]');

        
        
        document.addEventListener('DOMContentLoaded',function () {
            get(techniqueagricoleSelect.val()) ;
            
            sxx(cultureEl.val()) ;

        });

       

















        techniqueagricoleSelect.on('change', function () {
            let idSelectionerAgricol = $(this).val();
            get(idSelectionerAgricol);
        });

        function get(id){
            $.ajax({
                url: "{{ route('getData') }}",
                type: 'post',
                data: {
                    '_token': " {{ csrf_token() }}",
                    'id': id,
                },
                success: function ({modesTechnique , techniqueSpecifique}) {

                    techniquespecifiqueSelect.empty();

                    techniquespecifiqueSelect.append("<option value='' selected disabled> choisire </option>");

                    for (i in techniqueSpecifique) {
                        techniquespecifiqueSelect.append("<option value='" + techniqueSpecifique[i].idTS + "'>" + techniqueSpecifique[i].titre + "</option>");
                    }


                    modetechniqueSelect.empty();

                    modetechniqueSelect.append("<option value='' selected disabled> choisire </option>");

                    for (i in modesTechnique) {
                        modetechniqueSelect.append("<option value='" + modesTechnique[i].idM + "'>" + modesTechnique[i].titre + "</option>");
                    }
                }


            });
        }

        let btnSave = $('#save-data') ;

        btnSave.on('click' , function(){

     
            let = _techniquespecifiqueSelect = techniquespecifiqueSelect.val();
            let = _modetechniqueSelect = modetechniqueSelect.val();
            let = _cultureEl = cultureEl.val();
            let = _quantificationEl = quantificationEl.val();
            let = _dateEl = dateEl.val();
            let = _observationEl = observationEl.val();

            if(_techniquespecifiqueSelect !== null && _modetechniqueSelect !== null && _quantificationEl !== "")
            {


                $.ajax({

                    url: "{{ route('store.ExecutionTechnique') }}",
                    type: 'post',
                    data: {
                        '_token': " {{ csrf_token() }}",
                      
                        'techniquespecifique' : _techniquespecifiqueSelect ,
                        'modetechnique' : _modetechniqueSelect ,
                        'culture' : _cultureEl ,
                        'quantification' : _quantificationEl ,
                        'date' : _dateEl ,
                        'observation' : _observationEl ,
                    },


                    success: function ({errors, data}) {

                        if (errors) {

                            if (errors.hasOwnProperty('techniqueagricole')) {
                                techniqueagricoleSelect.parent().find('.invalid-feedback').text(errors.techniqueagricole[0] ?? '');
                            }
                            if (errors.hasOwnProperty('techniquespecifique')) {
                                techniquespecifiqueSelect.parent().siblings('.invalid-feedback').text(errors.techniquespecifique[0] ?? '');
                            } 
                            if (errors.hasOwnProperty('modetechnique')) {
                                modetechniqueSelect.parent().find('.invalid-feedback').text(errors.modetechnique[0] ?? '');
                            } 
                            if (errors.hasOwnProperty('culture')) {
                                cultureEl.parent().find('.invalid-feedback').text(errors.culture[0] ?? '');
                            }
                            if (errors.hasOwnProperty('quantification')) {
                                quantificationEl.parent().find('.invalid-feedback').text(errors.quantification[0] ?? '');
                            }
                            if (errors.hasOwnProperty('date')) {
                                dateEl.parent().find('.invalid-feedback').text(errors.date[0] ?? '');
                            }
                            if (errors.hasOwnProperty('observation')) {
                                observationEl.parent().find('.invalid-feedback').text(errors.observation[0] ?? '');
                            }

                        } else {

                            table
                            .clear()
                            .draw();

                            
                                 
                            sxx(_cultureEl) ;
                                
                                
                                    Swal.fire({
                                    title: "complété",
                                    text: "Execution Techniqueété ajouté avec succès",
                                    type: "success",
                                    confirmButtonText: 'OK',
                                    padding: '2em'
                                    });


                                techniquespecifiqueSelect.empty();
                                modetechniqueSelect.empty();
                                quantificationEl.val('');
                                dateEl.val('');
                                observationEl.val('');

                                
                            
                        }
                    }
                    ,
                    error: function (error) {

                        console.log(error);
                        Swal.fire({
                            title: "error",
                            text: "error",
                            type: "error",
                            confirmButtonText: 'OK',
                            padding: '2em'
                        });
                    }

                    });

            }else{
                Swal.fire({
                    title: "error",
                    text: "error",
                    type: "error",
                    confirmButtonText: 'OK',
                    padding: '2em'
                });
            }

        });




        function sxx(id){
            $.ajax({
                url: "{{ route('charge.table') }}",
                type: 'post',
                data: {
                    '_token': " {{ csrf_token() }}",
                    'culture' : id ,
                },

                success: function ({errors, data}) {

                    console.log(errors);
                    console.log(data);
    
                    table
                        .clear()
                        .draw();
                    data.forEach(function(item) {



                        
                      
                        let deleteRoute = "{{ url()->current() }}/executionTechnique/delete/" + item["{{ \App\Models\ExecutionTechnique::PK }}"];
                        let addRoute = "{{ url()->current() }}/executionTechnique/ajoute-Charge/" + item["{{ \App\Models\ExecutionTechnique::PK }}"];

                        let trEl = `
                                        <tr>
                                            <td>${item.idTechSpe ?? '<span class="badge badge-info">vide</span>'}</td>
                                            <td>${item.idModeTech ?? '<span class="badge badge-info">vide</span>'}</td>
                                        
                                            <td>${item.quantification ?? '<span class="badge badge-info">vide</span>'}</td>
                                            <td>${item.date ?? '<span class="badge badge-info">vide</span>'}</td>
                                            <td>${item.observation ?? '<span class="badge badge-info">vide</span>'}</td>
                                            <td>
                                                <div class="ms-auto">
                                                    <div class="btn-group dropup">
                                                        <button type="button"
                                                                class="datatable-consult btn btn-light dropdown-toggle dropdown-toggle-split"
                                                                data-bs-toggle="dropdown">
                                                                <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                                                        <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                                        <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                                        <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-top dropdown-menu-lg-end">
                                                            
                                                            <a href="${deleteRoute}" class="dropdown-item">
                                                                Supprimer
                                                            </a>
                                                            <a href="${addRoute}" target="_blank" class='dropdown-item'>
                                                                Ajouter Charge Exection
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        `;
                                        table.row.add($(trEl)).draw();

                                
                    });
                


                },


            });
        }


    </script>
@endpush
