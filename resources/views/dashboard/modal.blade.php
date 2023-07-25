
        <div class="card-px text-right  ">
          <a href="#" class="btn btn-success er fs-6 px-8 py-4" style="background: #5EC267" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Stade Variete</a>
        </div>
    <div class="modal fade" id="kt_modal_view_users" tabindex="-1" aria-hidden="true">
      
      <div class="modal-dialog mw-1000px">
        <div class="modal-content  p-5">
          <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </div>
          
            <table class="table align-middle table-row-dashed fs-6 gy-4">
              <thead >
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-100px">nom </th>
                  <th class="min-w-100px">phase fin</th>
                  <th class="min-w-100px">sommesTemp</th>
                  <th class="min-w-100px">sommesFroid</th>
                  <th class="min-w-100px">kc</th>
                  <th class="min-w-100px">enracinement</th>
                  <th class="min-w-100px">maxEnraciement</th>
                  <th class="min-w-100px">description</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($collection as $item)
                <tr>
                  <td class="min-w-100px">{{ $item->nom }}</td>
                  <td class="min-w-100px">{{ $item->phaseFin }}</td>
                  <td class="min-w-100px">{{ $item->sommesTemp }}</td>
                  <td class="min-w-100px">{{ $item->sommesTempFroid }}</td>
                  <td class="min-w-100px">{{ $item->Kc }}</td>
                  <td class="min-w-100px">{{ $item->enracinement }}</td>
                  <td class="min-w-100px">{{ $item->maxEnraciement }}</td>
                  <td class="min-w-100px">{{ $item->description }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        
        </div>
      </div>
    </div>
