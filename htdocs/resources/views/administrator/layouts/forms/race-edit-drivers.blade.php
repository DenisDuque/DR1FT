<div id="edit-race-drivers" class="editRaceSection d-none table-responsive" style="max-height: 35rem;">
    <button id="load-dorsals" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i>Load Dorsal Numbers</button>
    <table class="table table-dark table-hover overflow-hidden mt-2">
        <thead>
            <tr>
                <th scope="col" class="py-3 text-center">#</th>
                <th scope="col" class="py-3">Dorsal</th>
                <th scope="col" class="py-3">NºFederation</th>
                <th scope="col" class="py-3">Name</th>
                <th scope="col" class="py-3">Email</th>
            </tr>
        </thead>
        <tbody id="drivers-races-table-body">
            @foreach($race->drivers as $driver)
                <tr>
                    <td class="py-3 text-center align-middle fw-bold">{{$driver->id}}</td>
                    <td class="py-3 text-center align-middle">{{$driver->dorsal ? $driver->dorsal : 'NO'}}</td>
                    <td class="py-3 align-middle">{{$driver->federationNumber}}</td>
                    <td class="py-3 align-middle">{{$driver->name}}</td>
                    <td class="py-3 align-middle">{{$driver->email}}</td>
                </tr>
            @endforeach   
        </tbody>
    </table>                     
</div>