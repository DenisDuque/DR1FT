<div id="edit-race-sponsors" class="editRaceSection d-none table-responsive" style="max-height: 35rem;">
    <table class="table table-dark table-hover overflow-hidden mt-2">
        <thead>
            <tr>
                <th scope="col" class="py-3 text-center">#</th>
                <th scope="col" class="py-3">Logo</th>
                <th scope="col" class="py-3">CIF</th>
                <th scope="col" class="py-3">Name</th>
                <th scope="col" class="py-3 text-center">Main Sponsor</th>
            </tr>
        </thead>
        <tbody id="sponsors-races-table-body">
            @foreach($race->sponsors as $sponsor)
                <tr>
                    <td class="py-3 text-center align-middle fw-bold"><input class="form-check-input" type="checkbox" role="switch" name="raceSponsors[]" value="{{$sponsor->id}}"></td>
                    <!-- <td>{{$sponsor->logo}}</td> -->
                    <td class="py-3 align-middle"><i class="bi bi-image"></i></td>
                    <td class="py-3 align-middle">{{$sponsor->cif}}</td>
                    <td class="py-3 align-middle">{{$sponsor->name}}
                        @if ($sponsor->active == 0)
                            <span class="badge rounded-pill bg-badge-disabled">Disabled</span>
                        @endif
                    </td>
                    <td class="py-3 text-center align-middle fw-bold"><input class="form-check-input" type="checkbox" role="switch" name="mainSponsors[]" value="{{$sponsor->id}}"></td>
                </tr>
            @endforeach   
        </tbody>
    </table>             
</div>