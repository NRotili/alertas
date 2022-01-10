<div>
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Buscar por fecha de ingreso, Nº exp, Nº nota o fecha de filmación"
                class="form-control">
        </div>

        @if ($files->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fec. Ing.</th>
                            <th>Nº Exp</th>
                            <th>Inicia</th>
                            <th>Nº Nota</th>
                            <th>Fec. Reg.</th>
                            <th>Hora</th>
                            <th>Adj</th>
                            <th>Fec. Sal.</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->datein }}</td>
                                <td>{{ $file->filenumber }}</td>
                                <td>{{ $file->init }}</td>
                                <td>{{ $file->notenumber }}</td>
                                <td>{{ $file->datefilm }}</td>
                                <td>{{ $file->time }}</td>
                                <td>{{ $file->attach }}</td>
                                <td>{{ $file->dateout }}</td>
                                <td width="10px">
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('panel.monitoreo.files.edit', $file) }}"><i
                                            class="fas fa-pen"></i></a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('panel.monitoreo.files.destroy', $file) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" type="submit"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $files->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros.</strong>
            </div>
        @endif

    </div>
</div>
