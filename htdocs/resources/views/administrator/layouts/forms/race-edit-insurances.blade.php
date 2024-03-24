<div id="edit-race-insurances" class="editRaceSection table-responsive d-none" style="max-height: 35rem;">
        <table class="table table-dark table-hover overflow-hidden" style="height: 20rem;">
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
                @foreach($race->insurances as $insurance)
                    <tr>
                        <td class="align-middle fw-bold"><input class="form-check-input" type="checkbox" name="raceInsurances[]" value="{{$insurance->id}}"></td>
                        <td class="align-middle">
                            <img class="img-thumbnail" src="{{ asset('storage/insurance_logos/' . $insurance->logo) }}" alt="{{ $insurance->name }}">
                        </td>
                        <td class="align-middle">{{$insurance->cif}}</td>
                        <td class="align-middle">{{$insurance->name}}
                            @if ($insurance->active == 0)
                                <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                            @endif
                        </td>
                        <td class="text-center align-middle"><span class="badge rounded-pill bg-badge-purple">{{$insurance->pricePerRace}}$</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>