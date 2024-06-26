<div id="edit-race-insurances" class="editRaceSection table-responsive d-none" style="max-height: 35rem;">
        <table class="table table-transparent table-hover overflow-hidden" style="height: 20rem;">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Logo</th>
                <th scope="col">CIF</th>
                <th scope="col">Name</th>
                <th scope="col" class="text-center"><button id="sortInsurances" type="button"><i class="bi bi-arrow-down-up"></i></button>Price per Race</th>
                </tr>
            </thead>
            <tbody id="insurances-races-table-body">
                @foreach($insurances as $insurance)
                    @if ($insurance->active != 0)
                        <tr>
                            <td class="align-middle fw-bold"><input class="form-check-input" type="checkbox" name="raceInsurances[]" value="{{$insurance->id}}" 
                                {{ $race->insurances->pluck('id')->contains($insurance->id) ? 'checked' : '' }}>
                            </td>
                            <td class="align-middle">
                                <img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . $insurance->logo) }}" alt="{{ $insurance->name }}">
                            </td>
                            <td class="align-middle">{{$insurance->cif}}</td>
                            <td class="align-middle">{{$insurance->name}}</td>
                            <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">{{$insurance->pricePerRace}}$</span></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
</div>