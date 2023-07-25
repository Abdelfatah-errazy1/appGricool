@extends('layout.master')
@section('page_title' , 'Charge Execution')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
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
                <div id="kt_job_6_1" class="fs-6 ms-1 collapse" style="">
    
                    <div class="row g-5 mb-11">
                        <!--end::Col-->
                        <div class="col-lg-4 col-sm-12">
                            <!--end::Label-->
                            <div class="fw-bold fs-7 text-gray-600 mb-1">Observation:</div>
                            <!--end::Label-->
                            <!--end::Col-->
                            <div class="fw-bolder fs-6 text-gray-800">{{ $model['quantification'] }}</div>
                            <!--end::Col-->
                        </div>
                        <!--end::Col-->
                        <!--end::Col-->
                        <div class="col-lg-4 col-sm-12">
                            <!--end::Label-->
                            <div class="fw-bold fs-7 text-gray-600 mb-1">Date:</div>
                            <!--end::Label-->
                            <!--end::Info-->
                            <div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                <span class="pe-2">{{ $model['date'] }}</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Col-->
                        <div class="col-lg-4 col-sm-12">
                            <!--end::Label-->
                            <div class="fw-bold fs-7 text-gray-600 mb-1">Observation:</div>
                            <!--end::Label-->
                            <!--end::Info-->
                            <div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                <span class="pe-2">{{ $model['observation'] }}</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Col-->
                    </div>
    
                </div>
                <!--end::Content-->
                <!--begin::Separator-->
                <div class="separator separator-dashed"></div>
                <!--end::Separator-->
            </div>
    
        </div>
    </div>
</div>

<div class="card mt-5">
    <div class="card-body">


          <x-form.form method="post"  action="{{ route('chargeExec.store') }}">
                    <x-form.card col="col-12 row" title="Charge Execution">
 
                        <x-form.input col="col-4" required type="number" min='0' step="0.5"  name="montant" label="montant"/>

                        <input type="hidden" value="{{ $model['idETS'] }}" name="execId">

                        <x-form.text-area col="col-8" name="observation" label="observation" />

                        <div class="col-12 mt-5">
                            <div class="mt-2">
                                <button type="submit" class="app-button  btn btn-primary">
                                    <span class="indicator-label">Save</span>
                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </x-form.card>

                </x-form.form>


    </div>
</div>


<div class="card mt-5">
    <div class="card-body">
      <div class="table-responsive">
          <table id="kt_datatable_example_2" class="table table-row-bordered table-striped gy-7 gs-7">
              <thead>
                  <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">

                      <th>Montant</th>
                      <th>observation</th>
                      <th>Supprimer</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($charges as $charge)
                    <tr>
                        <td>{{ $charge['montant'] }}</td>
                        <td>{{ $charge['observation'] }}</td>
                        <td><a href="{{ route('deleteCharge' , $charge['idCE']) }}" class="btn btn-sm btn-danger delete-record"> <i class="bi bi-trash-fill"></i> </a></td>
                    </tr>
                @endforeach
           </tbody>
          </table>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script src="http://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#kt_datatable_example_2');

        $('.delete-record').on('click', function(e) {
            var href = $(this).attr('href');
            e.preventDefault();
            Swal.fire({
                    title: 'Es-tu sûr?',
                    text: "Vous ne pourrez pas revenir en arrière",
                    icon: 'warning',

                    showCancelButton: true,
                    cancelButtonText: "cancel",
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Supprimer'
                })
                .then(function(result) {
                    if (result.value) {
                        location.href = href;
                    }
                });
        });
    </script>
@endpush